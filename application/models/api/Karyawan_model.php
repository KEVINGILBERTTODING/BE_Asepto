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

	function getAllKaryawan()
	{

		$this->db->select('*');
		$this->db->from('karyawan');
		$this->db->order_by('karyawan_id', 'desc');
		return $this->db->get()->result();
	}

	function updateKaryawan($id, $data)
	{
		$this->db->where('karyawan_id', $id);
		$update = $this->db->update('karyawan', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	public function get_new_id()
	{
		$this->db->select(' karyawan_id');
		$this->db->order_by(' karyawan_id', 'DESC');
		$query = $this->db->get('karyawan', 1);

		if ($query->num_rows() > 0) {
			$last_id = $query->row()->karyawan_id;
			$id_parts = explode('-', $last_id);
			$increment = intval($id_parts[2]) + 1;
		} else {
			$increment = 1;
		}

		$new_id = 'KN-' . date('Y') . '-' . sprintf('%05d', $increment);

		return $new_id;
	}


	function deleteKaryawan($id)
	{
		$this->db->where('karyawan_id', $id);
		$delete = $this->db->delete('karyawan');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

	function insertKaryawan($data)
	{
		$insert = $this->db->insert('karyawan', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
