<?php

//session_start(); //we need to start session in order to access it through CI

Class UserLogin extends CI_Controller {

    public function __construct() {
    parent::__construct();
    // Load form helper library
    $this->load->helper('form');

    $this->load->helper('security');
    // Load form validation library
    $this->load->library('form_validation');
    // Load session library
    //$this->load->library('session');
    // Load database
    $this->load->model('login_database');
    }

    // Show login page
    public function index() {
        $this->load->view('user/login');
    }

    // Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            if(isset($this->session->userdata['logged_in'])){
                redirect('/Homepage');
            } else {
                $this->load->view('user/login');
            }

        } else {
            $remember_status = $this->input->post('remember-me');
            
            $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            );

            $result = $this->login_database->login($data);

            if ($result == TRUE) {
                $username = $this->input->post('username');
                $result = $this->login_database->read_user_information($username);
                
                if ($result != false) {
                    $session_data = array(
                    'username' => $result[0]->username,
                    'email' => $result[0]->email,
                    'firstname' => $result[0]->firstname,
                    'lastname' => $result[0]->lastname,
                    'section' => $result[0]->section,
                    'access'=> $result[0]->access,
                    'remember' => $remember_status,
                    'sTime'=> time()
                    );
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect('/Homepage');
                }

            } else {
                $data = array(
                'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('user/login', $data);
            }
        }
    }

    public function returning_user_login(){

        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            if(isset($this->session->userdata['logged_in'])){
                redirect('/Homepage');
            } else {
                $this->load->view('user/lockscreen');
            }

        } else {
            
            $session_variables = $this->session->userdata('logged_in');

            $data = array(
            'username' => $session_variables['username'],
            'password' => $this->input->post('password'),
            );

            $result = $this->login_database->login($data);

            if ($result == TRUE) {
                    $session_variables['sTime'] = time();
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_variables);
                    redirect('/Homepage');

            } else {
                $data = $session_variables;
                $data['errorMessage'] = 'პაროლი არასწორია';
                $this->load->view('user/lockscreen', $data);
            }
        }

    }

    // Logout from admin page
    public function logout() {

        $userdata = $this->session->all_userdata();

        foreach ($userdata as $key => $value) {
           // if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
           // }
        }

        $this->session->sess_destroy();

        $data['message_display'] = 'თქვენ გამოხვედით სისტემიდან';
        
        $this->load->view('user/login', $data);
    }

    public function logoutWithRemember(){
        $userdata = $this->session->all_userdata();
        $pageData = array(
            'username' => $userdata['logged_in']['username'],
            'firstname' => $userdata['logged_in']['firstname'],
            'lastname' => $userdata['logged_in']['lastname'],
        );
        
        $this->load->view('user/lockscreen', $pageData);
    }

    public function passwordReset(){
        $token = $this->input->get('token');
        $tempQuery = $this->db->select('*')->from('temp')->where('flag', $token)->get();
        
        if($tempQuery->num_rows()){
            $tempRow = $tempQuery->result();
            if( $tempRow[0]->timestamp >= date('Y-m-d H:i:s', strtotime("-10 minutes")) ){
                
                $userID = $tempRow[0]->mainkey;
                $data['UserID'] = $userID;

            } else {

                $data['Error'] = 'თქვენ მოთხოვნას ვადა გაუვიდა'; 

            }
        } else {
            $data['Error'] = 'თქვენ მოთხოვნას ვადა გაუვიდა'; 
        }

        $this->load->view('user/password_reset', $data);
    }

}

?>