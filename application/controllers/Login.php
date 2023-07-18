<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('Login') == TRUE) {
			redirect(base_url());
		}
		$this->load->library('form_validation');
		$this->load->model('M_login');
	}

	public function index() {
		$this->load->view('Login');
	}

	public function auth() {
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() != false) {
			$data_login = array(
				'username' => htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES),
				'password' => md5(htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES)),
			);
			$user = $this->M_login->login($this->security->xss_clean($data_login));
			if ($user->num_rows() > 0) {
				$data = $user->row_array();
				$this->session->set_userdata('Login', TRUE);
				$this->session->set_userdata('username', $data['username']);
				$this->session->set_userdata('nama_petugas', $data['nama_petugas']);
				$this->session->set_userdata('level', $data['level']);
				redirect(base_url());
			} else {
				$this->session->set_flashdata('gagal', 'Username atau password salah!');
				redirect(base_url('Login'));
			}
		}
	}
}
