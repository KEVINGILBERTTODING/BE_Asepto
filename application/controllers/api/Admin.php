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
		$data = [
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
}
