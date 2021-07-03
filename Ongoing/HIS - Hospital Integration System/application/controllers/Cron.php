<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    public function clearDB(){
        $this->db->where('timestamp < DATE_SUB(NOW(), INTERVAL 10 MINUTE)');
        $this->db->delete('temp');

        echo $this->db->affected_rows();
    }
}

?>