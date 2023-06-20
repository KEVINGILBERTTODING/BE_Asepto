<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Karyawan_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function validate($username)
	{

		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->where('nama', $username);
		return $this->db->get()->row_array();
	}

	function getKaryawanyId($id)
	{
		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->where('karyawan_id', $id);
		return $this->db->get()->row_array();
	}
}
