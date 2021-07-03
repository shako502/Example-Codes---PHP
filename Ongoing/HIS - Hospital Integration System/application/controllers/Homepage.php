<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends HIS_Controller {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('common/sidebar', $this->sidebar_data());
		$this->load->view('homepage');
		$this->load->view('common/footer');
	}
}
