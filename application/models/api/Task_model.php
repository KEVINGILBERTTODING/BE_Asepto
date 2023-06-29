<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Task_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function insertTask($data)
	{
		$insert = $this->db->insert('task', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	function getTaskByProject($projectId)
	{
		$this->db->select('task.*, karyawan.nama as nama_karyawan');
		$this->db->from('task');
		$this->db->where('project_id', $projectId);
		$this->db->join('karyawan', 'karyawan.karyawan_id = task.karyawan_id', 'left');
		return $this->db->get()->result();
	}

	function deleteTask($taskId)
	{

		$this->db->where('task_id', $taskId);
		$delete = $this->db->delete('task');

		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

	function updateTask($id, $data)
	{

		$this->db->where('task_id', $id);
		$update = $this->db->update('task', $data);
		if ($update == true) {
			return true;
		} else {
			return false;
		}
	}
}
