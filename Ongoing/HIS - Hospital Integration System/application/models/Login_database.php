<?php

Class Login_Database extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Read data using username and password
    public function login($data) {

        $query = $this->db->get_where('operators', array('username' => $data['username']));
        foreach($query->result() as $row){
            if(password_verify($data['password'], $row->password)){
                return true;
            } else {
                return false;
            }
        }
       
    }

    // Read data from database to show data in admin page
    public function read_user_information($username) {

        $query = $this->db->get_where('operators', array('username' => $username));
        
        if($query->num_rows() == 1){
            return $query->result();
        }
        else {
            return false;
        }
    }

}

?>