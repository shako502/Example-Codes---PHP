<?php


Class Search_patients extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function mainSearch($keyword){

        $results = array();

        $this->db->select('id, name, lastname, idnumber');
        $this->db->from('patients');

        $keywords_array = explode(" ", $keyword);
        $keywords_count = count($keywords_array);

        if(!empty($keyword)){
            
            for($i=0; $i < $keywords_count; $i++){
                $this->db->group_start();
                $this->db->like('name', $keywords_array[$i]);
                $this->db->or_like('lastname', $keywords_array[$i]);
                $this->db->or_like('idnumber', $keywords_array[$i]);
                $this->db->group_end();
            }

            $query = $this->db->order_by('id', 'DESC')->limit(4)->get();

            $results['Status'] = 'True';
            $results['Query'] = $query->result_array();
        } else {

            $results['Status'] = 'False';

        }

        return $results;

    }

}

?>