<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller{
	public function __construct()
	{  
		parent::__construct();
		check_login();
		$this->load->model('admin/Pembayaran_Model');
		$this->load->model('admin/Project_Model');
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}

	//mengambil data dari database
	public function index(){
		$data['title']  = 'Hasil Pembayaran oleh Admin';
		$user   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
		// $data['pembayaran']	= $this->db->query('select * from pembayaran_karyawan where karyawan_id = "'.$user->karyawan_id.'"')->result();
		$data['pembayaran']=$this->Pembayaran_Model->getDataPembayaranKaryawan($user->karyawan_id);
		// $data['RiwayatLelang']=$this->Riwayat_Model->getDataLelang();
		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_karyawan/header', $data);
		$this->load->view('karyawan/pembayaran',$data);
		$this->load->view('theme_karyawan/footer', $data);
	}

	
}
