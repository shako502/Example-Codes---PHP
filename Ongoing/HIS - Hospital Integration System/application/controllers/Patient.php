<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends HIS_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$jsData['js_patientPage'] = 'patientPage.js';
		$this->load->view('common/header');
		$this->load->view('common/sidebar', $this->sidebar_data());
		$this->load->view('patient');
		$this->load->view('common/footer', $jsData);
		$this->load->view('common/modal.php');
	}

	public function ambulatory(){
	
		$pageData['PatientID'] = $this->input->get('id');
		$jsData['js_registerAmbulatory'] = 'regambulatory.js';

		$this->load->view('common/header');
		$this->load->view('common/sidebar', $this->sidebar_data());
		$this->load->view('registration/ambulatory', $pageData);
		$this->load->view('common/footer', $jsData);
	}
}
