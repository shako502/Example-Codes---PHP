<?php


Class Patient_handler extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function uniqueID() {

        $result = '';

        $uniqueIDrow = $this->db->select('UniquePatID')
                            ->order_by('ID', 'desc')
                            ->limit(1)
                            ->get('patients')
                            ->row();

        $uniqueID = $uniqueIDrow->UniquePatID;
        
        if(empty($uniqueID)){
            $result = str_pad('1', 5, '0', STR_PAD_LEFT);
        } else {
            $i = intval($uniqueID);
            $number = $i + 1;
            $result = str_pad($number, 5, '0', STR_PAD_LEFT);
        }

        return array(
            'result' => $result,
            'uniqueid' => $uniqueID,
            'i' => $i,
            'number' => $number
        );

    }

}

?>