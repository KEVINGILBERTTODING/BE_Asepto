<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller{
	public function __construct() 
	{  
		parent::__construct();
		check_login();
		$this->load->model('admin/Feedback_Model');
		$this->load->library('form_validation'); 
		$this->load->helper('url','form');
	} 

	public function index(){
		$data['title']  = 'Feedback';
		$user = $this->db->query('select * from karyawan where nama = "'.$_SESSION['nama'].'"')->row();
		$data['dataFeedback']=$this->Feedback_Model->getDataFeedbackKaryawan($user->karyawan_id);
		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_karyawan/header', $data);
		$this->load->view('karyawan/feedback',$data);
		$this->load->view('theme_karyawan/footer', $data);
	} 
}
