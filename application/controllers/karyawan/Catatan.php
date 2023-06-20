<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Catatan extends CI_Controller{ 
	public function __construct() 
	{   
		parent::__construct();
		check_login();
		$this->load->model('admin/CatatanTambahan_Model'); 
		$this->load->library('form_validation');
		$this->load->helper('url','form'); 
	} 
  
	//membuat method function index untuk menampilkan data project
	public function index(){

		$data['title']          = 'Catatan Tambahan';

		$data['dataCatatan']	= $this->CatatanTambahan_Model->getDataCatatan();
		$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_karyawan/header', $data);
		$this->load->view('karyawan/catatan',$data);
		$this->load->view('theme_karyawan/footer', $data);
	} 

	
	
}

