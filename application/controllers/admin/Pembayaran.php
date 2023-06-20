<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('admin/Pembayaran_Model');
		$this->load->model('admin/Project_Model');
		$this->load->model('admin/Karyawan_Model');
		$this->load->model('admin/Feedback_Model');
		$this->load->library('form_validation');
		$this->load->helper('url', 'form');
	}

	//mengambil data dari database
	public function index()
	{
		$data['title']  = 'Hasil Pembayaran oleh Admin';
		$data['RiwayatTransfer'] = $this->Pembayaran_Model->getData();
		// $data['RiwayatLelang']=$this->Riwayat_Model->getDataLelang();
		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/pembayaran/index', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	// //function untuk tambah data pembayaran karyawan

	public function tambah()
	{
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data['jenis'] = $this->Pembayaran_Model->getAllJenis();
		$data['select'] = $this->Pembayaran_Model->pilihNamaProject();
		$data['karyawan'] = $this->Pembayaran_Model->selectIdKaryawan();
		$data['namaKaryawan'] = $this->Pembayaran_Model->getAllNama();
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Tambah Data';
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/pembayaran/tambah');
			$this->load->view('theme_admin/footer', $data);
		} else {
			$config = array();
			// $id_project=$this->Project_Model->getId();
			$config['upload_path'] = './assets/uploads/bukti-transfer';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name']    = 'Bukti-' . date('d-m-Y') . '/' . time();

			$this->load->library('upload', $config, 'bukti_bayar');
			$this->bukti_bayar->initialize($config);
			$upload_image1 = $this->bukti_bayar->do_upload('bukti_bayar');
			if ($upload_image1) {
				$id_project = $this->input->post('project_id');
				$project = $this->Project_Model->getDataProjectDetail($id_project);
				$id_karyawan = $this->input->post('id_karyawan');
				$karyawan = $this->Karyawan_Model->getDataDetail($id_karyawan);

				$data = array(
					'project_id'					=> $id_project,
					'nama_project'					=> $project['nama_project'],
					'karyawan_id'					=> $this->input->post('id_karyawan'),
					'tgl_bayar'						=> $this->input->post('tanggal_bayar'),
					'nominal_bonus'					=> $this->input->post('nominal_bonus'),
					'nominal_dibayarkan'			=> $this->input->post('nominal_dibayarkan'),
					'bukti_transfer'    			=> $this->bukti_bayar->data("file_name"),
					'admin_id' => $this->session->admin_id
				);

				$this->db->insert('pembayaran_karyawan', $data);

				redirect('admin/Pembayaran/index', $data);
				// var_dump($this->db->last_query());
			} else {
				redirect('admin/Pembayaran/tambah');
				// var_dump($this->db->last_query());
			}
		}
	}

	//Fungsi Edit
	public function halaman_edit($id)
	{
		$this->form_validation->set_rules('nama_project', 'Nama Project', 'required');
		$data['getDataKaryawan'] = $this->Pembayaran_Model->getIDKaryawan($id);
		$data['jenis'] = $this->Pembayaran_Model->getAllJenis();
		$data['select'] = $this->Pembayaran_Model->pilihNamaProject();
		$data['karyawan'] = $this->Pembayaran_Model->selectIdKaryawan();
		$data['namaKaryawan'] = $this->Pembayaran_Model->getAllNama();
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Edit';
			$data['data']	= $this->db->query('select * from pembayaran_karyawan where id_pembayaran = "' . $id . '"')->row();
			// $data['data']	= $this->db->query('select * from pelelang where pelelang_id = "'.$id.'"')->row();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
			$data['RiwayatTransfer'] = $this->Pembayaran_Model->getData();
			$this->load->view('theme_admin/header', $data);
			$this->load->view('admin/pembayaran/edit', $data);
			$this->load->view('theme_admin/footer', $data);
		} else {
			$config = array();
			$id_project = $this->Project_Model->getId();
			$config['upload_path'] = './assets/uploads/bukti-transfer';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name']    = 'Bukti-' . date('d-m-Y') . '/' . time();

			$this->load->library('upload', $config, 'bukti_bayar');
			$this->bukti_bayar->initialize($config);
			$upload_image1 = $this->bukti_bayar->do_upload('bukti_bayar');

			if ($upload_image1) {
				$id_project = $this->input->post('project_id');
				$project = $this->Project_Model->getDataProjectDetail($id_project);

				$data = array(
					'project_id'					=> $id_project,
					'nama_project'					=> $project['nama_project'],
					'karyawan_id' 					=> $this->input->post('nama_karyawan'),
					'tgl_bayar'						=> $this->input->post('tanggal_bayar'),
					'nominal_bonus'					=> $this->input->post('nominal_bonus'),
					'nominal_dibayarkan'			=> $this->input->post('nominal_dibayarkan'),
					'bukti_transfer'    			=> $this->bukti_bayar->data("file_name"),
					'admin_id' 						=> $this->session->admin_id
				);
				$id_project = array('id_pembayaran' => $id);
				$sql       = $this->db->query('select * from pembayaran_karyawan where id_pembayaran="' . $id . '"')->row();
				unlink('/assets/uploads/bukti-transfer' . $sql->logo_title);
				unlink('/assets/uploads/bukti-transfer' . $sql->logo_website);

				$this->db->where($id_project);
				$this->db->update('pembayaran_karyawan', $data);

				redirect('admin/Pembayaran/index');
			} else {
				redirect('admin/Pembayaran/halaman_edit' . $id);
			}
		}
	}
}
