<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Karyawan/Progress_Model');
		$this->load->model('admin/Karyawan_Model');
		$this->load->model('admin/Project_Model');
		$this->load->library('form_validation');
		$this->load->helper('url', 'form');
	}

	//membuat method function index untuk menampilkan data project
	public function index()
	{

		$data['title']          = 'Progress Pekerjaan';
		$user   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['dataProgress']	= $this->db->query('select * from progress where karyawan_id = "' . $user->karyawan_id . '"')->result();

		//username untuk navbar
		$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_karyawan/header', $data);
		$this->load->view('karyawan/progress/index', $data);
		$this->load->view('theme_karyawan/footer', $data);
	}

	//menampilkan halaman edit data Project
	public function edit($id)
	{

		$this->form_validation->set_rules('progress', 'Masukan Catatan Tambahan', 'required');

		$data['project'] = $this->Progress_Model->getProjectById($id);
		$data['jenis'] = $this->Progress_Model->getAllJenis();
		$data['select'] = $this->Progress_Model->pilihNamaProject();

		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Edit Catatan Progress';
			$data['data']	= $this->db->query('select * from progress where progress_id = "' . $id . '"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

			$this->load->view('theme_karyawan/header', $data);
			$this->load->view('karyawan/progress/edit', $data);
			$this->load->view('theme_karyawan/footer', $data);
		} else {
			$id_project = $this->input->post('project_id');
			$project = $this->Project_Model->getDataProjectDetail($id_project);
			$karyawan_id = $this->input->post('karyawan_id');
			$jabatan = $this->Progress_Model->getDataJabatan($karyawan_id);
			date_default_timezone_set('Asia/Jakarta');
			$now = date('Y-m-d H:i:s');
			$data = array(
				'project_id' => $id_project,
				'karyawan_id' => $this->input->post('karyawan_id'),
				'nama_project' => $project['nama_project'],
				'keterangan'   => $this->input->post('keterangan'),
				'tanggal'	 => $now,
				'jabatan'	=> $jabatan['jabatan'],
				'progress'   => $this->input->post('progress')

			);

			$project_id = array('progress_id' => $id);

			$this->db->where($project_id);
			$this->db->update('progress', $data);

			redirect('karyawan/progress/index', $data);
			// var_dump($this->db->last_query());

		}
	}

	public function tambah()
	{

		$this->form_validation->set_rules('progress', 'Masukan Catatan Tambahan', 'required');

		$data['jenis'] = $this->Progress_Model->getAllJenis();
		$data['select'] = $this->Progress_Model->pilihNamaProject();
		$data['project'] = $this->Progress_Model->selectIdProject();
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Tambah Catatan progress';

			// $data['progress']	= $this->db->query('select * from progress where project_id = "'.$id.'"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_karyawan/header', $data);
			$this->load->view('karyawan/progress/tambah');
			$this->load->view('theme_karyawan/footer', $data);
		} else {
			$id_project = $this->input->post('project_id');
			$project = $this->Project_Model->getDataProjectDetail($id_project);
			$user = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
			$data['progress'] = $this->Progress_Model->insertProgress($user->karyawan_id);
			// $project_id=$this->Project_Model->getId();
			date_default_timezone_set('Asia/Jakarta');
			$now = date('Y-m-d H:i:s');
			$karyawan_id = $this->input->post('karyawan_id');
			$jabatan = $this->Progress_Model->getDataJabatan($karyawan_id);
			$data = array(
				'project_id' => $id_project,
				'karyawan_id' => $this->input->post('karyawan_id'),
				'nama_project' => $project['nama_project'],
				'keterangan'   => $this->input->post('keterangan'),
				'tanggal'	 => $now,
				'jabatan'	=> $jabatan['jabatan'],
				'progress'   => $this->input->post('progress'),
			);
			$this->db->insert('progress', $data);

			// Set message
			$this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

			redirect('karyawan/progress/index', $data);
		}
	}
}
