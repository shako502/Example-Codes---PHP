<?php

Class User_Session extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
    }

    // Read data using username and password
    public function userInfo() {
        if(isset($this->session->userdata['logged_in'])){
            $userdata = $this->session->userdata('logged_in');
            $result = array(
                'firstname' => $userdata['firstname'],
                'lastname' => $userdata['lastname']
            );
        } else {
            $result = array(
               'Status' => 'Error'
            );
        }

        return $result;
       
    }


}

?>