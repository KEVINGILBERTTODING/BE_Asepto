<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('api/project_model');
		$this->load->model('api/progress_model');
		$this->load->model('api/karyawan_model');
		$this->load->model('api/feedback_model');
		$this->load->model('api/catatan_model');
		$this->load->model('api/task_model');
	}

	function getProject()
	{
		$status = $this->input->get('status');
		echo json_encode($this->project_model->getProject($status));
	}

	function getAllKaryawan()
	{
		echo json_encode($this->karyawan_model->getAllKaryawan());
	}

	function insertKaryawan()
	{
		$id = $this->karyawan_model->get_new_id();
		$data = [
			'karyawan_id' => $id,
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'jabatan' => $this->input->post('jabatan'),
			'telp' => $this->input->post('telp'),
			'norekening' => $this->input->post('norekening'),
			'bank' => $this->input->post('bank'),
			'jeniskel' => $this->input->post('jeniskel')
		];

		$insert = $this->karyawan_model->insertKaryawan($data);
		if ($insert) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function updateKaryawan()
	{
		$id = $this->input->post('id');
		$data = [
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'jabatan' => $this->input->post('jabatan'),
			'telp' => $this->input->post('telp'),
			'norekening' => $this->input->post('norekening'),
			'bank' => $this->input->post('bank'),
			'jeniskel' => $this->input->post('jeniskel')
		];

		$update = $this->karyawan_model->updateKaryawan($id, $data);
		if ($update) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function deleteKaryawan()
	{
		$id = $this->input->post('id');
		$delete = $this->karyawan_model->deleteKaryawan($id);
		if ($delete) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function getAllFeedBack()
	{
		echo json_encode($this->feedback_model->getAllFeedBack());
	}

	function updateFeedBack()
	{
		$id = $this->input->post('id');
		$data = [
			'feedback' => $this->input->post('feedback')
		];
		$update = $this->feedback_model->update($id, $data);
		if ($update == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}
	function deleteReview()
	{
		$id = $this->input->post('id');
		$delete = $this->feedback_model->delete($id);
		if ($delete == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function addReview()
	{
		$data = [
			'project_id' => $this->input->post('project_id'),
			'karyawan_id' => $this->input->post('karyawan_id'),
			'nama_project' => $this->input->post('nama_project'),
			'feedback' => $this->input->post('feedback'),
			'admin_id' => 1,
		];

		$insert = $this->feedback_model->insert($data);
		if ($insert == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function updateCatatan()
	{
		$id = $this->input->post('id');
		$data = [
			'catatan' => $this->input->post('catatan'),
			'tanggal_event' => $this->input->post('tanggal_event'),
		];
		$update = $this->catatan_model->update($id, $data);
		if ($update == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function deleteCatatan()
	{
		$id = $this->input->post('id');
		$delete = $this->catatan_model->delete($id);
		if ($delete == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function insertCatatan()
	{
		$catatanId = $this->catatan_model->get_new_id();
		$data = [
			'catatan_id' => $catatanId,
			'catatan' => $this->input->post('catatan'),
			'tanggal_event' => $this->input->post('tanggal')
		];
		$insert = $this->catatan_model->insert($data);
		if ($insert == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function insertProject()
	{
		$projectId = $this->project_model->get_new_id();
		$data = [
			'project_id' => $projectId,
			'nama_project' => $this->input->post('nama_project'),
			'deskripsi_project' => $this->input->post('deskripsi_project'),
			'kategori' => $this->input->post('kategori'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'email_perusahaan' => $this->input->post('email_perusahaan'),
			'budget' => $this->input->post('budget'),
			'karyawan_id' => $this->input->post('karyawan_id'),
			'nama' => $this->input->post('nama'),
			'status' => 0
		];
		$insert = $this->project_model->insertProject($data);
		if ($insert == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function deleteProject()
	{
		$id = $this->input->post('id');
		$delete = $this->project_model->delete($id);
		if ($delete == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function updateProject()
	{

		$id = $this->input->post('id');

		$data = [
			'nama_project' => $this->input->post('nama_project'),
			'deskripsi_project' => $this->input->post('deskripsi_project'),
			'kategori' => $this->input->post('kategori'),
			'tgl_mulai' => $this->input->post('tgl_mulai'),
			'tgl_selesai' => $this->input->post('tgl_selesai'),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'email_perusahaan' => $this->input->post('email_perusahaan'),
			'budget' => $this->input->post('budget'),
			'karyawan_id' => $this->input->post('karyawan_id'),
			'nama' => $this->input->post('nama')
		];
		$update = $this->project_model->updateProject($id, $data);
		if ($update == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function projectDone()
	{
		$id = $this->input->post('id');
		$id = $this->input->post('id');
		$config['upload_path']          = './assets/uploads/project/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;


		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			$response = [
				'code' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];
			$data = [
				'gambar_project' => $file_name,
				'status' => 1
			];
			$update = $this->project_model->updateProject($id, $data);
			if ($update == true) {
				$response = [
					'code' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 404
				];
				echo json_encode($response);
			}
		}
	}

	function getProgress()
	{
		$id = $this->input->get('id');
		echo json_encode($this->progress_model->getProgress($id));
	}

	function insertTask()
	{
		$data = [
			'project_id' => $this->input->post('project_id'),
			'task_name' => $this->input->post('task_name'),
			'karyawan_id' => $this->input->post('karyawan_id'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];
		$insert = $this->task_model->insertTask($data);
		if ($insert == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function getTaskByProject()
	{
		$id = $this->input->get('id');
		echo json_encode($this->task_model->getTaskByProject($id));
	}

	function deleteTask()
	{
		$id = $this->input->post('id');
		$delete = $this->task_model->deleteTask($id);
		if ($delete == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}

	function updateTask()
	{
		$id = $this->input->post('id');
		$data = [
			'task_name' => $this->input->post('task_name'),
			'updated_at' => date('Y-m-d H:i:s')
		];
		$update = $this->task_model->updateTask($id, $data);
		if ($update == true) {
			$response = [
				'code' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404
			];
			echo json_encode($response);
		}
	}
}
