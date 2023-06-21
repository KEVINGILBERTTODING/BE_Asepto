<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Karyawan extends CI_Controller
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

	function getMyProject()
	{
		$id = $this->input->get('id');
		$status = $this->input->get('status');
		echo json_encode($this->project_model->getProjectByUserId($id, $status));
	}

	function getProgressById()
	{
		$userId = $this->input->get('user_id');
		$projectId = $this->input->get('project_id');
		echo json_encode($this->progress_model->getProgressById($projectId, $userId));
	}

	function updateProgress()
	{
		$id = $this->input->post('id');
		$data = [
			'keterangan' => $this->input->post('keterangan')
		];

		$update = $this->progress_model->updateProgress($id, $data);
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

	function insertProgress()
	{
		$data = [
			'project_id' => $this->input->post('project_id'),
			'karyawan_id' => $this->input->post('karyawan_id'),
			'jabatan' => $this->input->post('jabatan'),
			'nama_project' => $this->input->post('nama_project'),
			'progress' => $this->input->post('progress'),
			'keterangan' => $this->input->post('keterangan'),
			'tanggal' => date('Y-m-d H:i:s')
		];
		$insert = $this->progress_model->insert($data);
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

	function getKaryawanById()
	{
		$id = $this->input->get('id');
		echo json_encode($this->karyawan_model->getKaryawanyId($id));
	}

	function getDeadlineProject()
	{
		$idProject = $this->input->post('id');
		$date = $this->project_model->getProjectDetail($idProject)['tgl_selesai'];
		$deadline = strtotime($date);
		$oneDayBeforeDeadline = strtotime("-1 day", $deadline);
		$currentDate = time();

		if ($currentDate >= $oneDayBeforeDeadline && $currentDate < $deadline) {

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

	function getFeedBack()
	{
		$id  = $this->input->get('id');
		echo json_encode($this->feedback_model->getFeedBckByUserId($id));
	}

	function getCatatan()
	{
		echo json_encode($this->catatan_model->getAllCatatan());
	}
}
