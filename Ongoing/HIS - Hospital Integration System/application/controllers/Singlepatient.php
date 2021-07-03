<?php
class Singlepatient extends HIS_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('single_patient');
    }

    public function index(){
        $data = $this->input->get('id', true);
        $patientData = $this->single_patient->getpatient($data);

        $jsData['js_singlepatient'] = 'singlepatient.js';
        $this->load->view('common/header');
        $this->load->view('common/sidebar', $this->sidebar_data());
        $this->load->view('singlepatient/main', $patientData);
        $this->load->view('common/footer', $jsData);
    }
}

?>