<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Karyawan extends CI_Controller{ 
	public function __construct() 
	{   
		parent::__construct();
		check_login();
		$this->load->model('admin/Karyawan_Model'); 
		$this->load->library('form_validation');
		$this->load->helper('url','form'); 
	} 
  
	//membuat method function index untuk menampilkan data product lelang
	public function index(){

		$data['title']  = 'Data Karyawan';

		$data['dataKaryawan']	= $this->Karyawan_Model->getDataKaryawan();
		$user   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/karyawan/index',$data);
		$this->load->view('theme_admin/footer', $data);
	} 


	//membuat method function untuk menampilkan detail dari data karyawan
	public function detail(){

		$data['title']  = 'Rincian Data Karyawan';

		$data['detailKaryawan']	= $this->Karyawan_Model->getDataDetail($id);
		$user   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/karyawan/index',$data);
		$this->load->view('theme_admin/footer', $data);
	}
	//menampilkan halaman edit data karyawan
	public function edit($id){

		$this->form_validation->set_rules('karyawan','karyawan','required');
		
		$data['karyawan']=$this->Karyawan_Model->getKaryawanById($id);
		$data['jenis']=$this->Karyawan_Model->getAllJenis();
		$data['role']=$this->Karyawan_Model->insertJenisKelamin();
		if($this->form_validation->run() == FALSE){
			$data['title']  = 'Edit Data Karyawan';
			$data['data']	= $this->db->query('select * from karyawan where karyawan_id = "'.$id.'"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			// $data['user']   = $this->db->query('select * from pelelang where nama = "' . $_SESSION['nama'] . '"')->row();

			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/karyawan/edit', $data);
			$this->load->view('theme_admin/footer', $data);
		}else{
			$data = array(
				'nama'		  => $this->post('karyawan'),
				'email'       => $this->input->post('email'),
				'telp'        => $this->input->post('telp'),
				'norekening'  =>$this->input->post('norek'),
				'bank'        =>$this->input->post('bank'),
				'jeniskel'    =>$this->input->post('jeniskel')
			);	

			$karyawan_id = array('karyawan_id' => $id);
			
			$this->db->where($karyawan_id);
			$this->db->update('karyawan', $data);

			redirect('admin/karyawan/index',$data);
			
     	}
			
	}

	public function tambah(){
		
			$this->form_validation->set_rules('karyawan','karyawan','required');
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('telp', 'telp', 'required|callback_check_telp_exists');
			$this->form_validation->set_rules('email', 'email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('norek', 'norek', 'required');
			$this->form_validation->set_rules('bank', 'bank', 'required');
			
			$data['jenis']=$this->Karyawan_Model->getAllJenis();
			$data['role']=$this->Karyawan_Model->insertJenisKelamin();
			if($this->form_validation->run() == FALSE){
				$data['title']  = 'Tambah Data Karyawan';
				// get data nama user (untuk tampil di sidebar dan navbar)
				$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
				$this->load->view('theme_pelelang/header', $data);
				$this->load->view('admin/karyawan/tambah',$data);
				$this->load->view('theme_pelelang/footer', $data);
			}else{
				$id_karyawan=$this->Karyawan_Model->getId();
					$data = array(
						'karyawan_id' =>$id_karyawan,
						'nama'		  => $this->post('karyawan'),
						'email'       => $this->input->post('email'),
						'telp'        => $this->input->post('telp'),
						'norekening'  =>$this->input->post('norek'),
						'bank'        =>$this->input->post('bank'),
						'jeniskel'    =>$this->input->post('jeniskel')
					);	
					$this->db->insert('karyawan', $data);

            // Set message
            $this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

            redirect('admin/karyawan/index',$data);
			}
	}

	//membuat method function untuk mengambil status konfirmasi produk
	// public function konfirmasiSudahVerifikasi($id_pelelang,$pesan){
	// 	$this->Product_model->konfirmasiProduk($id_pelelang,$pesan);
	// 	if($pesan==1){
	// 		redirect('pelelang/product/index');
	// 	}else{
	// 		redirect('pelelang/dashboard');
	// 	}
	// }
				 


	//membuat function delete
	public function deleteKaryawan($id){
		$this->Karyawan_Model->deleteDataProduk($id);
		redirect(base_url('admin/karyawan/index'));
	}

	// Check if username exists
    public function check_telp_exists($username)
    {
        $this->form_validation->set_message('check_telp_exists', 'Usrname Sudah diambil. Silahkan gunakan username lain');
        if ($this->User_model->check_telp_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'Email Sudah diambil. Silahkan gunakan email lain');
        if ($this->User_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
}

