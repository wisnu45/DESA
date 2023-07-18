<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pindah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('Login') == FALSE) {
			redirect(base_url("Login"));
		}
		$this->load->model('M_pindah');
	}
	public function tampil()
	{
		$data['title'] = "Data Pindah  - Desa Warung Bambu";
		$data['pindah'] = $this->M_pindah->tampil();

		$mutasi = $this->load->view('header', $data);
		$this->load->view('pindah/tampil_pindah');
		$this->load->view('footer');
	}
	public function tampil_pindah2()
	{
		$data['title'] = "Data Pindah  - Desa Warung Bambu";
		$data['pindah'] = $this->M_pindah->tampil();

		$mutasi = $this->load->view('header', $data);
		$this->load->view('pindah/tampil_pindah2');
		$this->load->view('footer');
	}

	public function tambah()
	{
		$data['title'] = "Tambah Pindah  - Desa Warung Bambu";

		$this->load->view('header', $data);
		$this->load->view('pindah/tambah_pindah');
		$this->load->view('footer');
	}

	public function proses_tambah()
	{
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$agama = $this->input->post('agama');
		$pekerjaan = $this->input->post('pekerjaan');
		$alamat = $this->input->post('alamat');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$alasan_pindah = $this->input->post('alasan_pindah');
		$tanggal_pindah = $this->input->post('tanggal_pindah');
		$alamat_tujuan = $this->input->post('alamat_tujuan');
		$jenis_pindah = $this->input->post('jenis_pindah');
		$klasifikasi_pindah = $this->input->post('klasifikasi_pindah');

		$data = array(
			'nik' => $nik,
			'nama' => ucwords($nama),
			'agama' => $agama,
			'pekerjaan' => $pekerjaan,
			'alamat' => ucwords($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'alasan_pindah' => ucwords($alasan_pindah),
			'tanggal_pindah' => $tanggal_pindah,
			'alamat_tujuan' => $alamat_tujuan,
			'jenis_pindah' => $jenis_pindah,
			'klasifikasi_pindah' => $klasifikasi_pindah,
		);
		$this->M_pindah->tambah($data);

		$this->session->set_flashdata('sukses', 'Data dengan NO KK ' . $nik . ' berhasil ditambahkan.');
		redirect(base_url('pindah/tampil'));
	}

	public function edit($nik)
	{
		$data['title'] = "Edit Pindah  - Desa WarungBambu";
		$data['pindah'] = $this->M_pindah->edit($nik);

		$this->load->view('header', $data);
		$this->load->view('pindah/edit_pindah');
		$this->load->view('footer');
	}

	public function proses_edit()
	{
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$agama = $this->input->post('agama');
		$pekerjaan = $this->input->post('pekerjaan');
		$alamat = $this->input->post('alamat');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$alasan_pindah = $this->input->post('alasan_pindah');
		$tanggal_pindah = $this->input->post('tanggal_pindah');
		$alamat_tujuan = $this->input->post('alamat_tujuan');
		$jenis_pindah = $this->input->post('jenis_pindah');
		$klasifikasi_pindah = $this->input->post('klasifikasi_pindah');

		$data = array(
			'nik' => $nik,
			'nama' => ucwords($nama),
			'agama' => $agama,
			'pekerjaan' => $pekerjaan,
			'alamat' => ucwords($alamat),
			'rt' => $rt,
			'rw' => $rw,
			'alasan_pindah' => ucwords($alasan_pindah),
			'tanggal_pindah' => $tanggal_pindah,
			'alamat_tujuan' => $alamat_tujuan,
			'jenis_pindah' => $jenis_pindah,
			'klasifikasi_pindah' => $klasifikasi_pindah,
		);
		$where = array(
			'nik' => $nik,
		);
		$this->M_pindah->proses_edit($where, $data);

		$this->session->set_flashdata('sukses', 'Data dengan NO KK ' . $nik . ' berhasil diedit.');
		redirect(base_url('pindah/tampil/' . $nik));
	}

	public function hapus($nik)
	{
		$this->M_pindah->hapus($nik);
		$this->session->set_flashdata('sukses', 'Data dengan NO KK ' . $nik . ' berhasil dihapus.');
		redirect(base_url('pindah/tampil'));
	}

	public function detail($nik)
	{

		$data['title'] = "Detail Pindah  - Desa Warung Bambu";
		$this->load->model('M_pindah');

		$detail = $this->M_pindah->detail($nik);
		$data['detail'] = $detail;
		$this->load->view('header', $data);
		$this->load->view('pindah/detail_pindah', $data);
		$this->load->view('footer');
	}
}