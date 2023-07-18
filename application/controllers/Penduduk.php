<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('Login') == FALSE) {
			redirect(base_url("Login"));
		}
		$this->load->model('M_penduduk');
		$this->load->library('form_validation');
	}

	public function tampil() {
		$data['title'] = "Data Penduduk - Desa Warung Bambu";
		$data['penduduk'] = $this->M_penduduk->tampil();

		$mutasi = $this->load->view('header', $data);
		$this->load->view('penduduk/tampil_penduduk');
		$this->load->view('footer');
	}

	public function tampil_penduduk() {
		$data['title'] = "Data Penduduk - Desa Warung Bambu";
		$data['penduduk'] = $this->M_penduduk->tampil();

		$mutasi = $this->load->view('header', $data);
		$this->load->view('penduduk/tampil_penduduk2');
		$this->load->view('footer');
	}

	public function tambah() {
		$data['title'] = "Tambah Penduduk - Desa Warung Bambu";

		$this->load->view('header', $data);
		$this->load->view('penduduk/tambah_penduduk');
		$this->load->view('footer');
	}

	public function proses_tambah() {

		$nik = $this->input->post('nik');
		$no_kk = $this->input->post('no_kk');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$agama = $this->input->post('agama');
		$pekerjaan = $this->input->post('pekerjaan');
		$pendidikan = $this->input->post('pendidikan');
		$status_perkawinan = $this->input->post('status_perkawinan');
		$status = $this->input->post('status');
		$golongan_darah = $this->input->post('golongan_darah');
		$kewarganegaraan = $this->input->post('kewarganegaraan');

		$data = array(
			'nik' => $nik,
			'no_kk' => $no_kk,
			'nama' => ucwords($nama),
			'tempat_lahir' => ucwords($tempat_lahir),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' => ucwords($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'agama' => $agama,
			'pekerjaan' => ucwords($pekerjaan),
			'pendidikan' => $pendidikan,
			'status_perkawinan' => $status_perkawinan,
			'status' => $status,
			'golongan_darah' => ucwords($golongan_darah),
			'kewarganegaraan' => $kewarganegaraan,
		);
		$this->M_penduduk->tambah($data);

		$this->session->set_flashdata('sukses', 'Data Dengan NIK ' . $nik . ' berhasil ditambahkan.');
		redirect(base_url('penduduk/tampil'));
	}

	public function edit($nik) {
		$data['title'] = "Edit penduduk - Desa Warung Bambu";
		$data['penduduk'] = $this->M_penduduk->edit($nik);

		$this->load->view('header', $data);
		$this->load->view('penduduk/edit_penduduk');
		$this->load->view('footer');
	}

	public function proses_edit() {
		$nik = $this->input->post('nik');
		$no_kk = $this->input->post('no_kk');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$agama = $this->input->post('agama');
		$pekerjaan = $this->input->post('pekerjaan');
		$pendidikan = $this->input->post('pendidikan');
		$status_perkawinan = $this->input->post('status_perkawinan');
		$status = $this->input->post('status');
		$golongan_darah = $this->input->post('golongan_darah');
		$kewarganegaraan = $this->input->post('kewarganegaraan');

		$data = array(
			'nik' => $nik,
			'no_kk' => $no_kk,
			'nama' => ucwords($nama),
			'tempat_lahir' => ucwords($tempat_lahir),
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'alamat' => ucwords($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'agama' => $agama,
			'pekerjaan' => ucwords($pekerjaan),
			'pendidikan' => $pendidikan,
			'status_perkawinan' => $status_perkawinan,
			'status' => $status,
			'golongan_darah' => ucwords($golongan_darah),
			'kewarganegaraan' => $kewarganegaraan,
		);
		$where = array(
			'nik' => $nik,
		);
		$this->M_penduduk->proses_edit($where, $data);

		$this->session->set_flashdata('sukses', 'Data Dengan NIK ' . $nik . ' berhasil diedit.');
		redirect(base_url('penduduk/tampil/' . $nik));
	}

	public function hapus($nik) {
		$this->M_penduduk->hapus($nik);
		$this->session->set_flashdata('sukses', 'Data Dengan NIK ' . $nik . ' berhasil dihapus.');
		redirect(base_url('penduduk/tampil'));
	}

	public function detail($nik) {

		$data['title'] = "Detail penduduk - Desa Warung Bambu";
		$this->load->model('M_penduduk');
		$detail = $this->M_penduduk->detail($nik);
		$data['detail'] = $detail;
		$this->load->view('header', $data);
		$this->load->view('penduduk/detail_penduduk', $data);
		$this->load->view('footer');
	}
}