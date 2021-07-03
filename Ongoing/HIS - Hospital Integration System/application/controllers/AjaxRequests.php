<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxRequests extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model('search_patients');
        $this->load->model('patient_handler');
    }

    public function index(){
        echo 'page';
    }

	function patientRegister() {

        if($this->input->post('check-patient-unknown') !== ''){
            $data = array(
                'unknownPatient' => 1,
                'unknownCommentary' => $this->input->post('patient-unknown-commentary')
            );
        }

        if(empty($this->input->post('check-patient-placement')) ){
            $patientSection = 'ambulatory'; 
        } else {
            $patientSection = 'stationary';
        }

        $uniquePatID = $this->patient_handler->uniqueID();

        $data = array( 
            'idnumber' => $this->input->post('patient-idnumber'),
            'UniquePatID' => $uniquePatID['result'],
            'name' => $this->input->post('patient-name'),
            'lastname' => $this->input->post('patient-lastname'),
            'birthdate' => date("Y-m-d", strtotime(str_replace('-', '/', $this->input->post('patient-birthdate') )) ),
            'sex' => $this->input->post('patient-sex'),
            'phonenumber' => $this->input->post('patient-phonenumber'),
            'email' => $this->input->post('patient-email'),
            'leggalAddress' => $this->input->post('patient-address'),
            'section' => $patientSection
        );

        $this->db->insert('patients', $data);
        
        $newPatientID = $this->db->insert_id();

        $rows = $this->db->affected_rows();

        if($rows != 1){

            echo json_encode(array(
                'Connection' => 'Success',
                'Status' => 'Failed',
                'Message' => 'Database Not Updated'
            ));
        } else {

            if($this->input->post('patient-add-info-checker') == 'true'){
                $addData = array(
                    'patient_id' => $newPatientID,
                    'state' => $this->input->post('patient-state'),
                    'region' => $this->input->post('patient-region'),
                    'city' => $this->input->post('patient-city'),
                    'physicalAddress' => $this->input->post('patient-physical-adress'),
                    'r_status' => $this->input->post('patient-relationship-status'),
                    'relative' => $this->input->post('patient-relative'),
                    'education' => $this->input->post('patient-education'),
                    'w_status' => $this->input->post('patient-work-status'),
                    'comment' => $this->input->post('patient-operator-note') 
                );

                $this->db->insert('patientMeta', $addData);
                $addDataRows = $this->db->affected_rows();

                if($addDataRows != 1){
                    
                    echo json_encode(array(
                        'Connection' => 'Success',
                        'Status' => 'Failed',
                        'Message' => 'Meta Database Not Updated, but Patient Placed'
                    ));

                } else {

                    echo json_encode(array(
                        'Connection' => 'Success',
                        'Status' => 'Success',
                        'Message' => 'Patient Saved',
                        //'Data' => $data,
                        //'AdditionalData' => $addData
                        'rowID' => $newPatientID
                    ));
                    
                }

            } else {
                echo json_encode(array(
                    'Connection' => 'Success',
                    'Status' => 'Success',
                    'Message' => 'Patient Saved',
                    'rowID' => $newPatientID,
                    'checkDT' => $uniquePatID
                ));
            }
            
        }
    }
    


    public function dataTables_lastPatients() {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'id',
            1=>'name',
            2=>'lastname',
            3=>'idnumber',
            4=>'birthdate',
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        
        $employees = $this->db->order_by('id', 'DESC')
                                ->limit(10)
                                ->get("patients");
        $data = array();
        foreach($employees->result() as $rows)
        {

            $data[]= array(
                $rows->UniquePatID,
                $rows->name,
                $rows->lastname,
                $rows->idnumber,
                $rows->birthdate,
            );     
        }
        $total_employees = $this->totalEmployees();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalEmployees()
    {
        $query = $this->db->select("COUNT(*) as num")->get("patients");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function checkIDnumber() {

        $idnumber = $this->input->post("idnumber");
        $query = $this->db->get_where('patients', array('idnumber' => $idnumber));
        
        if($query->num_rows() == 1){

            $data = array();

            foreach($query->result() as $row){
                $data[]= array(
                    'Status' => 'Found',
                    'ID' => $row->ID,
                    'FirstName' => $row->name,
                    'LastName' =>  $row->lastname
                );
            }
            
        } else {
            $data[] = array(
                'Status' => 'Go'
            );
        }

        echo json_encode($data);
        exit();
    
    }

    
    public function patientSearch(){
        $keyword = $this->input->post('mainsearchKeyword');

        $result = $this->search_patients->mainSearch($keyword);

        $data = array();

        if($result != false){
            $data = array(
                'Response' => $result
            );
        } else {
            $data = array(
                'Response' => 'False'
            );
        }
        
        echo json_encode($data);
        exit();
    }

    public function searchTests(){
        //$keyword = $this->input->post('query');
        echo json_encode(array(
            'success'
        ));
        exit();
    }


    public function passwordReset(){
        $email = $this->input->post('usermail');

        $query = $this->db->select('id, email, username, firstname, lastname')->from('operators')->where('email', $email)->get();

        if($query->num_rows()){
            $generatedString = $this->randomPassword(15);
            //Get Data From Previous Query
            $result = $query->result(); 
            //Create Temp Data Array 
            $tempdata = array(
                'mainkey' => $result[0]->id,
                'flag' => $generatedString
            );
            //Insert Temp Data In DB
            $this->db->insert('temp', $tempdata);
            //Check If Successfully Inserted
            if($this->db->affected_rows()){
                //Define Email Configs
                $emailData = array();
                $emailData['emailSubject'] = 'პაროლის ცვლილება';
                $emailData['userMail'] = $result[0]->email;
                $emailData['emailBody'] = 'HTML';
                $emailData['HTMLTemplate'] = 'templates/email/password_reset';
                $emailData['HTMLData'] = array(
                    'UserName' => $result[0]->username,
                    'FirstName' => $result[0]->firstname,
                    'LastName' => $result[0]->lastname,
                    'ResetLink' => base_url() . 'UserLogin/passwordReset?token=' . $generatedString
                );

                $emailSendResult = $this->sendMail($emailData);
                
                if($emailSendResult === 'Sent'){
                    $data = array(
                        'Message' => 'Password Changed Email Sent'
                    );
                } else {
                    $data = array(
                        'Message' => $emailSendResult
                    );
                }


            } else {

                $data = array(
                    'Message' => 'DB Error'
                );
            }
        // User Not Found Message
        } else {
            $data = array(
                'Message' => 'Not Found'
            );
        }

        echo json_encode($data);
        exit();
    }


    /**
     * New Password Update
     */
    public function newPassword(){
        $userID = $this->input->post('userID');
        $pass = $this->input->post('newPassword');
        
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $data = array(
            'password' => $hashedPass
        );

        $this->db->where('ID', $userID);
        if($this->db->update('operators', $data)) {
            echo json_encode(array(
                'Message' => 'Changed',
                'Status' => 200
            ));
        } else {
            echo json_encode(array(
                'Message' => 'Error, DB',
                'Status' => 404
            ));
        }
    }

    /**
     * Generate Random Password
     */
    private function randomPassword($l) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $l; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     * Send Email Function
     */
    public function sendMail($userData){
        $this->load->config('email');
        $this->load->library('email');

        $from = 'his-tory@enmedic.ge';
        $to = $userData['userMail'];
        $subject = $userData['emailSubject'];
        $message = $userData['emailBody'];

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        if($message === 'HTML'){
            $this->email->message($this->load->view($userData['HTMLTemplate'], $userData['HTMLData'], true));
            $this->email->set_mailtype('html');
        } else {
            $this->email->message($message);
        }
       
        if ($this->email->send()) {
            return 'Sent';
        } else {
            return $this->email->print_debugger();
        }
    }

}
