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
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/catatan/index',$data);
		$this->load->view('theme_admin/footer', $data);
	} 

	//menampilkan halaman edit data Project
	public function edit($id){

		$this->form_validation->set_rules('catatan','Masukan Catatan Tambahan','required');
		
		if($this->form_validation->run() == FALSE){
			$data['title']  = 'Edit Catatan Tambahan';
			$data['data']	= $this->db->query('select * from catatan_tambahan where catatan_id = "'.$id.'"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/catatan/edit', $data);
			$this->load->view('theme_admin/footer', $data);
		}else{
			$data = array(
            'catatan'         => $this->input->post('catatan'),
			'tanggal_event' =>$this->input->post('tanggal_event')
			);	

			$catatan_id = array('catatan_id' => $id);
			
			$this->db->where($catatan_id);
			$this->db->update('catatan_tambahan', $data);

			redirect('admin/catatan/index',$data);
			
     	}
			
	}

	public function tambah(){
		
			$this->form_validation->set_rules('catatan','Masukan Catatan Tambahan','required');

			
			if($this->form_validation->run() == FALSE){
				$data['title']  = 'Tambah Catatan Tambahan';
				// get data nama user (untuk tampil di sidebar dan navbar)
				$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
				$this->load->view('theme_admin/header', $data);
				$this->load->view('admin/catatan/tambah',$data);
				$this->load->view('theme_admin/footer', $data);
			}else{
				$catatan_id=$this->CatatanTambahan_Model->getId();
					$data = array(
						'catatan_id' =>$catatan_id,
                        'catatan'         => $this->input->post('catatan'),
						'tanggal_event' =>$this->input->post('tanggal_event')
					);	
					$this->db->insert('catatan_tambahan', $data);

            // Set message
            $this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

            redirect('admin/catatan/index',$data);
			}
	}


				
	//membuat function delete
	public function deleteCatatan($id){
		$this->CatatanTambahan_Model->deleteDataCatatan($id);
		redirect(base_url('admin/catatan/index'));
	}

	
}

