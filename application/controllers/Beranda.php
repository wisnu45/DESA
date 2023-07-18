<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('Login') == FALSE) {
			redirect(base_url("Login"));
		}
	}
	public function index() {
		$data['title'] = "Desa Warung Bambu";

		$this->load->view('header', $data);
		$this->load->view('Beranda');
		$this->load->view('footer');
	}
}
