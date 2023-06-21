<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function getFeedBckByUserId($id)
	{

		$this->db->select('feedback.*, project.nama_project, karyawan.nama');
		$this->db->from('feedback');
		$this->db->join('project', 'project.project_id = feedback.project_id', 'left');
		$this->db->join('karyawan', 'karyawan.karyawan_id = feedback.karyawan_id', 'left');
		$this->db->where('feedback.karyawan_id', $id);
		return $this->db->get()->result();
	}


	function getAllFeedBack()
	{
		$this->db->select('feedback.*, project.nama_project, karyawan.nama');
		$this->db->from('feedback');
		$this->db->join('project', 'project.project_id = feedback.project_id', 'left');
		$this->db->join('karyawan', 'karyawan.karyawan_id = feedback.karyawan_id', 'left');
		return $this->db->get()->result();
	}

	function update($id, $data)
	{

		$this->db->where('feedback_id', $id);
		$update = $this->db->update('feedback', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	function delete($id)
	{

		$this->db->where('feedback_id', $id);
		$delete = $this->db->delete('feedback');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

	function insert($data)
	{
		$insert = $this->db->insert('feedback', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
