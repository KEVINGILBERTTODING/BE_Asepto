<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function getProgressById($idProject, $userId)
	{
		$this->db->select('progress.*, karyawan.jabatan as jabatan_karyawan');
		$this->db->from('progress');
		$this->db->join('karyawan', 'karyawan.karyawan_id = progress.karyawan_id', 'left');
		$this->db->where('progress.project_id', $idProject);
		$this->db->where('progress.karyawan_id', $userId);
		return $this->db->get()->result();
	}

	function getProgress($idProject)
	{
		$this->db->select('progress.*, karyawan.jabatan as jabatan_karyawan, karyawan.nama as nama');
		$this->db->from('progress');
		$this->db->join('karyawan', 'karyawan.karyawan_id = progress.karyawan_id', 'left');
		$this->db->where('progress.project_id', $idProject);
		return $this->db->get()->result();
	}

	function updateProgress($id, $data)
	{
		$this->db->where('progress_id', $id);
		$update = $this->db->update('progress', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	function insert($data)
	{
		$insert = $this->db->insert('progress', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
