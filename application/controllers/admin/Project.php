<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('admin/Project_Model');
		// $this->load->library('form_validation');
		// $this->load->helper('url', 'form');
	}

	//membuat method function index untuk menampilkan data project
	public function index()
	{

		$data['title']          = 'Data Project';

		$data['dataProject']	= $this->Project_Model->getDataProject();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/project/index', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	//menampilkan project yang telah selesai
	public function projectSelesai()
	{
		$data['title']          = 'Data Project Selesai';
		$data['dataProject'] = $this->Project_Model->projectBerhasil();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/project/selesai', $data);
		$this->load->view('theme_admin/footer', $data);
	}
	//menampilkan halaman edit data Project
	public function edit($id)
	{
		$this->form_validation->set_rules('nama_project', 'Nama Project', 'required');
		$data['jenis'] = $this->Project_Model->getAllKaryawan();
		$data['tipe'] = $this->Project_Model->selectTipePerusahaan();
		$data['status'] = $this->Project_Model->selectStatus();
		// $data['project']  = $this->Project_Model->getDataProjectDetail($id);
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Edit Data Project';
			$data['data']	= $this->db->query('select * from project where project_id = "' . $id . '"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/project/edit', $data);
			$this->load->view('theme_admin/footer', $data);
		} else {
			$id_karyawan = $this->input->post('pilih_karyawan');
			$karyawan = $this->Project_Model->getDataKaryawanDetail($id_karyawan);
			$data = array(
				'nama_project'		        => $this->input->post('nama_project'),
				'deskripsi_project'         => $this->input->post('deskripsi'),
				'tgl_mulai'					=> $this->input->post('tgl_mulai'),
				'tgl_selesai'				=> $this->input->post('tgl_selesai'),
				'nama_perusahaan'           => $this->input->post('nama_perusahaan'),
				'email_perusahaan'          => $this->input->post('email_perusahaan'),
				'tipe_perusahaan'           => $this->input->post('tipe_perusahaan'),
				'budget'   					=> $this->input->post('budget'),
				'karyawan_id'				=> $karyawan['karyawan_id'],
				'nama'						=> $karyawan['nama'],
				'status' 					=> $this->input->post('status'),
				'kategori'  => $this->input->post('kategori_project')
			);

			$project_id = array('project_id' => $id);

			$this->db->where($project_id);
			$this->db->update('project', $data);

			redirect('admin/project/index', $data);
		}
	}

	public function tambah()
	{

		$this->form_validation->set_rules('nama_project', 'Nama Project', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		$this->form_validation->set_rules('tgl_mulai', 'tgl_mulai', 'required');
		$this->form_validation->set_rules('tgl_selesai', 'tgl_selesai', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('email_perusahaan', 'Email Perusahaan', 'required');
		$data['jenis'] = $this->Project_Model->getAllKaryawan();
		$data['tipe'] = $this->Project_Model->selectTipePerusahaan();
		$data['kategori'] = $this->Project_Model->selectKategoriProject();
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Tambah Data Project';
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/project/tambah', $data);
			$this->load->view('theme_admin/footer', $data);
		} else {
			$id_project = $this->Project_Model->getId();
			date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
			$now = date('Y-m-d H:i:s');
			$id_karyawan = $this->input->post('pilih_karyawan');
			$karyawan = $this->Project_Model->getDataKaryawanDetail($id_karyawan);
			$data = array(
				'project_id' => $id_project,
				'nama_project' => $this->input->post('nama_project'),
				'deskripsi_project' => $this->input->post('deskripsi'),
				'tgl_mulai'			=> $this->input->post('tgl_mulai'),
				'tgl_selesai'		=> $this->input->post('tgl_selesai'),
				'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
				'email_perusahaan'  => $this->input->post('email_perusahaan'),
				'tipe_perusahaan'   => $this->input->post('tipe_perusahaan'),
				'budget'   			=> $this->input->post('budget'),
				'karyawan_id'		=> $karyawan['karyawan_id'],
				'nama'				=> $karyawan['nama'],
				'kategori'  		=> $this->input->post('kategori_project'),
				'status' 			=> 0
			);
			$this->db->insert('project', $data);

			// Set message
			$this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

			redirect('admin/project/index', $data);
		}
	}


	//membuat function upload image project ketika project selesai dikerjakan
	public function uploadImageProject($id)
	{
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgInfo', '<div class="alert alert-danger" role="alert">
				<div class="alert-text">Anda belum mengisi apapun !</div>
			</div>');
			redirect('admin/Project/index');
		} else {
			$random_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
			$data['bukti'] = $this->Project_Model->uploadFile($id);
			// $data['bukti_project'] = $this->Project_Model->hasilProjectById($id);
			// $data['data']	= $this->db->query('select * from project where project_id = "' . $id . '"')->row_array();
			$config = array();
			$config['upload_path'] = './assets/uploads/project/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name']    = $id . '-' . $random_string . '-' . date('d-m-Y');

			$this->load->library('upload', $config);
			// $this->upload->initialize($config);
			$upload_foto = $this->upload->do_upload('gambar_project');
			// $new_bukti = $data['upload_gambar']['gambar'];
			// $fileExt = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
			// $upload_bukti = $data['bukti']['project_id'] . date('d-m-Y') . '-' . time();
			// var_dump($upload_foto);die;
			if ($upload_foto) {
				$data = array(
					'gambar_project'              => $this->upload->data("file_name"),
				);

				$id_project = array('project_id' => $id);
				$sql       = $this->db->query('select * from project where project_id="' . $id . '"')->row();
				unlink('/assets/uploads/project' . $sql->logo_title);
				unlink('/assets/uploads/project' . $sql->logo_website);
				$this->db->where($id_project);
				$this->db->update('project', $data);
				$this->session->set_flashdata('msgInfo', '<div class="alert alert-success" role="alert">
					<div class="alert-text">Sukses mengubah data !</div>
				</div>');
				redirect('admin/Project/projectSelesai', $data);
			}
			// redirect('admin/Project/index');
			var_dump($this->db->last_query());
		}
	}
	//membuat function untuk konfirmasi status project yang telah selesai
	public function konfirmasiStatus($id)
	{
		$this->form_validation->set_rules('project_id', 'project_id', 'required');

		$data = [
			'status' => $this->input->post('status')
		];
		$this->db->where('project_id', $id);
		$this->db->update('project', $data);
		redirect('admin/project/index');
	}



	//membuat function delete
	public function deleteProject($id)
	{
		$this->Project_Model->deleteDataProject($id);
		redirect(base_url('admin/project/index'));
	}
}
