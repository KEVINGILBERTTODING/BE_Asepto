<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catatan_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	function getAllCatatan()
	{
		$this->db->select('*');
		$this->db->from('catatan_tambahan');
		$this->db->order_by('catatan_id', 'desc');
		return $this->db->get()->result();
	}

	function update($id, $data)
	{

		$this->db->where('catatan_id', $id);
		$update = $this->db->update('catatan_tambahan', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	function delete($id)
	{

		$this->db->where('catatan_id', $id);
		$delete = $this->db->delete('catatan_tambahan');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}

	public function get_new_id()
	{
		$this->db->select('catatan_id');
		$this->db->order_by('catatan_id', 'DESC');
		$query = $this->db->get('catatan_tambahan', 1);

		if ($query->num_rows() > 0) {
			$last_id = $query->row()->catatan_id;
			$id_parts = explode('-', $last_id);
			$increment = intval($id_parts[2]) + 1;
		} else {
			$increment = 1;
		}

		$new_id = 'NOTE-' . date('Y') . '-' . sprintf('%05d', $increment);

		return $new_id;
	}

	function insert($data)
	{
		$insert = $this->db->insert('catatan_tambahan', $data);

		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
