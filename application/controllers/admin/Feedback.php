<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Feedback extends CI_Controller{ 
	public function __construct() 
	{   
		parent::__construct();
		check_login();
		$this->load->model('admin/Karyawan_Model');
		$this->load->model('admin/Project_Model');
		$this->load->model('admin/Feedback_Model'); 
		$this->load->library('form_validation');
		$this->load->helper('url','form'); 
	} 
  
	//membuat method function index untuk menampilkan data project
	public function index(){

		$data['title']          = 'Feedback';
		$data['dataFeedback']	= $this->Feedback_Model->getDataFeedback();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/feedback/index',$data);
		$this->load->view('theme_admin/footer', $data);
	} 

	public function tambah(){
		
			$this->form_validation->set_rules('feedback','Masukan Feedback','required');
			$data['jenis']=$this->Feedback_Model->getAllJenis();
			$data['select']=$this->Feedback_Model->pilihNamaProject();
			$data['karyawan']=$this->Feedback_Model->selectIdKaryawan();
			$data['namaKaryawan']=$this->Feedback_Model->getAllNama();
			// $data['nama_project']=$this->Project_Model->selectNamaProject();
			$data['tipe']=$this->Project_Model->selectTipePerusahaan();
			$data['project'] =$this->Feedback_Model->selectIdProject();
			$data['data_project']=$this->Project_Model->getData();
			if($this->form_validation->run() == FALSE){
				$data['title']  = 'Masukan Feedback';
				// $data['project']=$this->Feedback_Model->selectIdProject();
				// get data nama user (untuk tampil di sidebar dan navbar)
				$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
				$this->load->view('theme_admin/header', $data);
				$this->load->view('admin/feedback/tambah',$data);
				$this->load->view('theme_admin/footer', $data);
			}else{
				$id_project = $this->input->post('project_id');
				$id_feedback =$this->Feedback_Model->getId();
				$project =$this->Project_Model->getDataProjectDetail($id_project);
					$data = array(
						'feedback_id' =>$id_feedback,
						'project_id' =>$id_project,
						'karyawan_id' =>$this->input->post('nama_karyawan'),
						'nama_project'=>$project['nama_project'],
                        'feedback'   => $this->input->post('feedback'),
						'admin_id' => $this->session->admin_id
					);	
					$this->db->insert('feedback', $data);

            // // Set message
            $this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

            redirect('admin/feedback/index',$data);
			}
	}

	//function untuk edit feedback hasil kerja oleh karyawan
	public function edit($id){
		// $id = $this->uri->segment(4);
		$this->form_validation->set_rules('feedback','Masukan Feedback','required');
		$data['project']=$this->Feedback_Model->getProjectById($id);
		$data['jenis']=$this->Feedback_Model->getAllJenis();
		$data['select']=$this->Feedback_Model->pilihNamaProject();

		if($this->form_validation->run() == FALSE){
			$data['title']  = 'Edit Feedback';
			$data['data']	= $this->Feedback_Model->detailData($id);
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
			// $data['edit_data'] = $this->Feedback_Model->editFeedback($id);
			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/feedback/edit', $data);
			$this->load->view('theme_admin/footer', $data);
		}else{
			$data = array(
           	'feedback'   => $this->input->post('feedback'),
			   'admin_id' => $this->session->admin_id

			);	

			$this->db->where('feedback_id',$id);
      		$this->db->update('feedback',$data);
			// redirect($_SERVER['HTTP_REFERER']);
			redirect('admin/feedback/index',$data);
			
     	}
			
	}

	//membuat function delete
	public function deleteFeedback($id){
		$this->Feedback_Model->deleteDataFeedback($id);
		redirect(base_url('admin/feedback/index'));
	}
}

