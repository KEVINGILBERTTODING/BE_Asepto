<?php

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH .'libraries/chriskacerguis/codeigniter-restserver/src/RestController.php');
require(APPPATH .'libraries/chriskacerguis/codeigniter-restserver/src/Format.php');

use chriskacerguis\RestServer\RestController;


class Index_Api extends RestController
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		//load model untuk API
		$this->load->model('admin/Project_Model');
		$this->load->model('admin/Feedback_Model');
		$this->load->model('karyawan/Progress_Model');
		$this->load->model('admin/Karyawan_Model');
		$this->load->model('admin/Pembayaran_Model');
		$this->load->model('admin/CatatanTambahan_Model');
		$this->load->model('User_model');

	}

	/*API ADMIN */


	//endpoint untuk mendapatkan data project yang sudah dibuat


	//endpoint untuk login admin
	public function loginAdmin_post()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

		$username = $this->post('username');
		$password = $this->post('password');

		$this->db->select('username,password,admin_id,role');
		$this->db->from('admin');

		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();

		if ($result != null) {

			$this->response([
				'status' => true,
				'username' => $result->username,
				'kode' => $result->admin_id,
				'stats' => $result->role,
				'message' => 'Welcome back!',
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'data' => [],
				'message' => 'BAD REQUEST. USERNAME OR PASSWORD INVALID!',
			], RestController::HTTP_BAD_REQUEST);
		}
	}

	public function dataProjectAdmin_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$project = $this->db->get('project')->result();
		} else {
			$this->db->where('project_id', $id);
			$project = $this->db->get('project')->result();
		}
		$this->response($project, RestController::HTTP_OK);
	}

	//endpoint untuk menambahkan sebuah project baru
	public function tambahProject_post()
	{
		$id_project = $this->Project_Model->getId();
		$data = array(
			'project_id' 		=> $id_project,
			'nama_project' 		=> $this->input->post('nama_project'),
			'deskripsi_project' => $this->input->post('deskripsi'),
			'tgl_mulai'			=> $this->input->post('tgl_mulai'),
			'tgl_selesai'		=> $this->input->post('tgl_selesai'),
			'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
			'email_perusahaan'  => $this->input->post('email_perusahaan'),
			'tipe_perusahaan'   => $this->input->post('tipe_perusahaan'),
			'status' 			=> 0
		);
		$insert = $this->db->insert('project', $data);
		if ($insert) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'data' => $data,
					'message' => "Produk berhasil ditambahkan!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Please check your input data!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}

	//endpoint untuk update project dari admin

	public function editProject_put()
	{
		$id = $this->get('id');

		$data = array(
			'nama_project' 		=> $this->put('nama_project'),
			'deskripsi_project' => $this->put('deskripsi'),
			'tgl_mulai'			=> $this->put('tgl_mulai'),
			'tgl_selesai'		=> $this->put('tgl_selesai'),
			'nama_perusahaan'   => $this->put('nama_perusahaan'),
			'email_perusahaan'  => $this->put('email_perusahaan'),
			'tipe_perusahaan'   => $this->put('tipe_perusahaan'),
			'status' 		    => $this->put('status')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('project', $data);
		if ($update) {
			$this->response([
				'stats' => true,
				'message' => 'Update Successful'
			], 200);
		} else {
			$this->response([
				'stats' => false,
				'message' => 'Update Failed'
			], 400);
		}
	}

	//endpoint untuk delete data project
	public function DeletedataProject_delete()
	{

		$id = $this->get('id');

		$this->db->where('id', $id);
		$delete = $this->db->delete('project');
		if ($delete) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'message' => "Produk berhasil dihapus!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Can not be deleted!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}

	//endpoint untuk menampilkan data catatan tambahan dari admin
	public function getCatatanAdmin_get()
	{
		$data = $this->CatatanTambahan_Model->getDataCatatan();
		$this->response($data, RestController::HTTP_OK);
	}

	//endopoint untuk menampilkan data karyawawn yang ada berdasarkan id karyawan
	public function getKaryawanAdminById_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$karyawan = $this->db->get('karyawan')->result();
		} else {
			$this->db->where('karyawan_id', $id);
			$karyawan = $this->db->get('karyawan')->result();
		}
		$this->response($karyawan, RestController::HTTP_OK);
	}

	//endpoint untuk menampilkan semua data karyawan yg ada
	public function getKaryawanAdmin_get()
	{
		$data = $this->Karyawan_Model->getDataKaryawan();
		$this->response($data, RestController::HTTP_OK);
	}


	//endpoint untuk tambah data karyawan
	public function tambahDataKaryawan_post()
	{
		$id_karyawan = $this->Karyawan_Model->getId();
		$data = array(
			'karyawan_id' => $id_karyawan,
			'nama'		  => $this->input->post('karyawan'),
			'email'       => $this->input->post('email'),
			'telp'        => $this->input->post('telp'),
			'norekening'  => $this->input->post('norek'),
			'bank'        => $this->input->post('bank'),
			'jeniskel'    => $this->input->post('jeniskel')
		);
		$insert = $this->db->insert('karyawan', $data);
		if ($insert) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'data' => $data,
					'message' => "Produk berhasil ditambahkan!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Please check your input data!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}

	//endpoint untuk edit data karyawan
	public function editKaryawan_put()
	{
		$id = $this->get('id');

		$data = array(
			'nama'				=> $this->put('karyawan'),
			'email'          => $this->put('email'),
			'telp'      	=> $this->put('telp'),
			'norekening'            => $this->put('norek'),
			'bank'        => $this->put('bank'),
			'jeniskel'        => $this->put('jeniskel')
		);
		$this->db->where('karyawan_id', $id);
		$update = $this->db->update('karyawan', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//endpoint untuk hapus data karyawan
	public function deleteDataKaryawan_delete()
	{
		$id = $this->get('id');

		$this->db->where('karyawan_id', $id);
		$delete = $this->db->delete('karyawan');
		if ($delete) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'message' => "Produk berhasil dihapus!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Can not be deleted!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}

	//endpoint untuk menampilkan data pembayaran karyawan oleh admin
	public function getPembyaranAdmin_get()
	{
		$data = $this->Pembayaran_Model->getData();
		$this->response($data, RestController::HTTP_OK);
	}

	//endpoint untuk menambahkan data pembayaran karyawan oleh admin
	public function masukanDataPembayaran_post()
	{
		$config['upload_path'] = './assets/uploads/bukti-transfer';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name']    = 'Bukti-' . date('d-m-Y') . '/' . time();

		$this->load->library('upload', $config, 'bukti_bayar');
		$this->bukti_bayar->initialize($config);
		$upload_image1 = $this->bukti_bayar->do_upload('bukti_bayar');
		if ($upload_image1) {
			$id_project = $this->Pembayaran_Model->selectIdProject();
			$data = array(
				'project_id'					=> $id_project,
				'karyawan_id'					=> $this->post('karyawan_id'),
				'tgl_bayar'						=> $this->post('tanggal_bayar'),
				'nominal_bonus'					=> $this->post('nominal_bonus'),
				'nominal_dibayarkan'			=> $this->post('nominal_dibayarkan'),
				'bukti_transfer'    			=> $this->bukti_bayar->data("file_name"),
				'admin_id' => $this->session->admin_id
			);
			$insert = $this->db->insert('pembayaran_karyawan', $data);
			if ($insert) {
				$this->response(
					[
						'status' => "success",
						'code' => RestController::HTTP_CREATED,
						'data' => $data,
						'message' => "Produk berhasil ditambahkan!",
					],
					RestController::HTTP_CREATED
				);
			} else {
				$this->response(
					[
						'status' => "error",
						'code' => RestController::HTTP_BAD_REQUEST,
						'message' => "Something wrong! Please check your input data!",
					],
					RestController::HTTP_BAD_REQUEST
				);
			}
		}
	}

	//endpoint untk edit data pembayaran karyawan oleh admin
	public function editDataPembayaran_post()
{
    $id = $this->get('id');

    $config['upload_path'] = './assets/uploads/bukti-transfer';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['file_name']    = 'Bukti-' . date('d-m-Y') . '/' . time();

    $this->load->library('upload', $config, 'bukti_bayar');
    $this->bukti_bayar->initialize($config);
    $upload_image1 = $this->bukti_bayar->do_upload('bukti_bayar');

    if ($upload_image1) {
        $id_project = $this->Pembayaran_Model->selectIdProject();


        $data = array(
            'project_id'            => $id_project,
            'karyawan_id'           => $this->post('karyawan_id'),
            'tgl_bayar'             => $this->post('tanggal_bayar'),
            'nominal_bonus'         => $this->post('nominal_bonus'),
            'nominal_dibayarkan'    => $this->post('nominal_dibayarkan'),
            'bukti_transfer'        => $this->bukti_bayar->data("file_name"),
            'admin_id'              => $this->post('admin_id'),
        );

        $this->db->where('id_pembayaran', $id);
        $update = $this->db->update('pembayaran_karyawan', $data);

        if ($update) {
            $this->response(
                [
                    'status' => "success",
                    'code' => RestController::HTTP_CREATED,
                    'message' => "Produk berhasil diupdate!",
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => "error",
                    'code' => RestController::HTTP_BAD_REQUEST,
                    'message' => "Something wrong! Please check your input data!",
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }
}


	//endpoint untuk hapus data pembayaran karyawan oleh admin
	public function hapusdataPembayaran_delete()
	{
		$id = $this->get('id');

		$this->db->where('id_pembayaran', $id);
		$delete = $this->db->delete('pembayaran_karyawan');
		if ($delete) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'message' => "Produk berhasil dihapus!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Can not be deleted!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}
	//endpoint untuk menampilkan data feedback oleh admin
	public function getDataFeedbackAdmin_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$data = $this->db->get('feedback')->result();
		} else {
			$this->db->where('feedback_id', $id);
			$data = $this->db->get('feedback')->result();
		}
		$this->response($data, RestController::HTTP_OK);
	}


	//endpoint untuk menambahkan data feedback oleh admin
	public function tambahDataFeedback_post()
	{
		$id_project = $this->input->post('project_id');
		$project = $this->Project_Model->getDataProjectDetail($id_project);
		$data = array(
			'project_id' => $id_project,
			'karyawan_id' => $this->input->post('nama_karyawan'),
			'nama_project' => $project['nama_project'],
			'feedback'   => $this->input->post('feedback'),
			'admin_id' => $this->session->admin_id
		);
		$insert = $this->db->insert('feedback', $data);;
		if ($insert) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'data' => $data,
					'message' => "Produk berhasil ditambahkan!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Please check your input data!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}

	//endpoint menampilkan progress pekerjaan karyawan dibagian admin
	public function getProgressPekerjaan_get()
	{
		$data = $this->Progress_Model->getDataProgress();
		$this->response($data, RestController::HTTP_OK);
	}

	/* API  KARYAWAN */

	//endpoint untuk login karyawan
	public function loginKaryawan_post()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

		$nama = $this->post('nama');
		$email = $this->post('email');

		$this->db->select('nama,email,karyawan_id');
		$this->db->from('karyawan');

		$this->db->where('nama', $nama);
		$this->db->where('email', $email);
		$query = $this->db->get();
		$result = $query->row();

		if ($result != null) {

			$this->response([
				'status' => true,
				'nama' => $result->nama,
				'kode' => $result->karyawan_id,
				'message' => 'Welcome back!',
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'data' => [],
				'message' => 'BAD REQUEST. NAMA OR EMAIL INVALID!',
			], RestController::HTTP_BAD_REQUEST);
		}
	}


	//endpoint untuk menampilkan hasil pembayaran karyawan
	public function getHasilPembayaran_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$pembayaran = $this->db->get('pembayaran_karyawan')->result();
		} else {
			$this->db->where('karyawan_id', $id);
			$pembayaran = $this->db->get('pembayaran_karyawan')->result();
		}
		$this->response($pembayaran, RestController::HTTP_OK);
	}

	//endpoint untuk menampilkan progress pekerjaan
	public function getProgressPekerjaanById_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$progress = $this->db->get('progress')->result();
		} else {
			$this->db->where('karyawan_id', $id);
			$progress = $this->db->get('progress')->result();
		}
		$this->response($progress, RestController::HTTP_OK);
	}

	//endpoint untuk menambahkan progress pekerjaan
	public function tambahProgressPekerjaan_post()
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$id_project = $this->input->post('project_id');
		$project = $this->Project_Model->getDataProjectDetail($id_project);

		$data = array(
			'project_id' => $id_project,
			'karyawan_id' => $this->input->post('karyawan_id'),
			'nama_project' => $project['nama_project'],
			'progress'   => $this->input->post('progress'),
			'tanggal'	 => $now,
		);
		$insert = $this->db->insert('progress', $data);;
		if ($insert) {
			$this->response(
				[
					'status' => "success",
					'code' => RestController::HTTP_CREATED,
					'data' => $data,
					'message' => "Produk berhasil ditambahkan!",
				],
				RestController::HTTP_CREATED
			);
		} else {
			$this->response(
				[
					'status' => "error",
					'code' => RestController::HTTP_BAD_REQUEST,
					'message' => "Something wrong! Please check your input data!",
				],
				RestController::HTTP_BAD_REQUEST
			);
		}
	}


	//endpoint untuk update progress pekerjaan
	public function editProgressKaryawan_put()
	{
		$id = $this->get('id');

		$id_project = $this->input->post('project_id');
		$project = $this->Project_Model->getDataProjectDetail($id_project);
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$data = array(
			'karyawan_id' => $this->put('karyawan_id'),
			'nama_project' => $this->put('nama_project'),
			'progress'   => $this->put('progress'),
			'tanggal'	 => $now,
		);

		$this->db->where('progress_id', $id);
		$update = $this->db->update('progress', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//endpoint menampilkan data feedback pekerjaan karyawan
	public function getFeedbackPekerjaanKaryawan_get()
	{
		$id = $this->get('id');
		if (is_null($id)) {
			$feedback = $this->db->get('feedback')->result();
		} else {
			$this->db->where('karyawan_id', $id);
			$feedback = $this->db->get('feedback')->result();
		}
		$this->response($feedback, RestController::HTTP_OK);
	}

	/*AKHIR API KARYAWAN */

}
