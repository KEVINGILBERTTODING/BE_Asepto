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
}
