<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('admin/RiwayatProgress_Model');
		$this->load->model('admin/Project_Model');
		// $this->load->library('form_validation');
		// $this->load->helper('url','form');
	}

	//mengambil data dari database
	public function index()
	{
		$data['title']  = 'Hasil progrees Pekerjaan';
		$data['dataRiwayat'] = $this->RiwayatProgress_Model->getDataProgress();
		// $data['RiwayatLelang']=$this->Riwayat_Model->getDataLelang();
		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/progress', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	public function grafik()
	{
		if (!empty($this->input->get('proyek'))) {
			// var_dump($this->input->get('proyek'));die;
			$data['hidden'] = null;
			$data['data_project'] = $this->db->query('select * from project where project_id = "' . $this->input->get('proyek', true) . '"')->row();
			// var_dump($data['data_project']);
			// die;
			$data['progress_project'] = $this->db->query('select * from progress where project_id = "' . $this->input->get('proyek', true) . '"')->result();
			if (!empty($data['progress_project'])) {
				$this->db->select('a.karyawan_id, b.karyawan_id, a.nama, b.keterangan');
				$this->db->from('karyawan as a');
				$this->db->join('progress as b', 'a.karyawan_id = b.karyawan_id', 'right');
				$this->db->where('b.project_id', $this->input->get('proyek', null));
				// $karyawan_ids = array('Frank', 'Todd', 'James');
				$karyawan_ids = [];
				$data['progress_karyawan'] = [];
				foreach ($data['progress_project'] as $dpp) {
					array_push($karyawan_ids, $dpp->karyawan_id);
					array_push($data['progress_karyawan'], $dpp->progress);
				}
				$karyawan = $this->db->where_in('a.karyawan_id', $karyawan_ids)->get()->result();
				$data['karyawan'] = [];
				foreach ($karyawan as $karyawan) {
					array_push($data['karyawan'], ucwords($karyawan->nama . '__' . $karyawan->keterangan));
				}
				// var_dump($data['karyawan']);die;
			} else {
				$data['hidden'] = 'style="display: none;"';
				$data['data_project'] = null;
				$data['progress_project'] = null;
				$data['karyawan'] = null;
			}
		} else {
			$data['hidden'] = 'style="display: none;"';
			$data['data_project'] = null;
			$data['progress_project'] = null;
			$data['karyawan'] = null;
		}
		$data['title']  = 'Hasil progrees Pekerjaan';
		$data['projects'] = $this->Project_Model->getDataProject();
		// var_dump($data['projects']);die;
		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/grafik', $data);
		$this->load->view('theme_admin/footer', $data);
	}
}
