<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {

	public function index()
	{
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/calender');
		$this->load->view('admin/templates/footer');
	}
}