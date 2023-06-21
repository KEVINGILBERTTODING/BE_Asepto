<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function getProjectByUserId($id, $status)
	{
		if ($status == 'all') {
			$this->db->select('*');
			$this->db->from('project');
			$this->db->where('karyawan_id', $id);
			return $this->db->get()->result();
		} else {
			$this->db->select('*');
			$this->db->from('project');
			$this->db->where('karyawan_id', $id);
			$this->db->where('status', $status);
			return $this->db->get()->result();
		}
	}

	function getProjectDetail($id)
	{

		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('project_id', $id);
		return $this->db->get()->row_array();
	}

	function getProject($status)
	{
		if ($status == 'all') {
			$this->db->select('*');
			$this->db->from('project');
			$this->db->order_by('id', 'desc');
			return $this->db->get()->result();
		} else {
			$this->db->select('*');
			$this->db->from('project');
			$this->db->where('status', $status);
			$this->db->order_by('id', 'desc');
			return $this->db->get()->result();
		}
	}

	function insertProject($data)
	{
		$insert = $this->db->insert('project', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function get_new_id()
	{
		$this->db->select('project_id');
		$this->db->order_by('project_id', 'DESC');
		$query = $this->db->get('project', 1);

		if ($query->num_rows() > 0) {
			$last_id = $query->row()->project_id;
			$id_parts = explode('-', $last_id);
			$increment = intval($id_parts[2]) + 1;
		} else {
			$increment = 1;
		}

		$new_id = 'PRJ-' . date('Y') . '-' . sprintf('%05d', $increment);

		return $new_id;
	}
}
