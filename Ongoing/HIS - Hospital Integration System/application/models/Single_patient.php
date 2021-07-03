<?php

Class Single_Patient extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Read data using username and password
    public function getpatient($data) {
        $query = $this->db->get_where('patients', array('ID' => $data));
        $result = $query->result();
    
        $patientSex = '';
        if($result[0]->sex === 'male'){
            $patientSex = 'კაცი';
        } else {
            $patientSex = 'ქალი';
        }

        return array(
            'patient_fullName' => $result[0]->name . ' ' . $result[0]->lastname,
            'patient_ID' => $result[0]->idnumber,
            'patient_birthdate' => $result[0]->birthdate,
            'patient_sex' => $patientSex,
            'patient_phoneNumber' => $result[0]->phonenumber,
            'patient_email' => $result[0]->email
        );
       
    }


}

?>