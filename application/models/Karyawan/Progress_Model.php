<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress_Model extends CI_Model
{
	//membuat function untuk insert progress
	public function insertProgress($project_id)
	{
		$this->db->select('progress.progress_id,project.project_id,project.nama_project,progress.progress,progress.tanggal,karyawan.karyawan_id');
		$this->db->from('progress');
		$this->db->join('karyawan', 'progress.karyawan_id = karyawan.karyawan_id');
		$this->db->join('project', 'progress.project_id=project.project_id');
		$this->db->where('project.project_id', $project_id);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}
	//menampilkan data progress yg pernah dikerjakan
	public function totalProgress($karyawan_id)
	{
		// $this->db->select('nominal_dibayarkan'); #memilih field untuk menghitung perolehan gaji karyawan
		$this->db->select('*');
		$this->db->from('progress');
		$this->db->where('progress.karyawan_id', $karyawan_id);
		$query = $this->db->get()->num_rows();
		return $query;
	}
	//menampilkan data feedback
	public function getDataProgress()
	{
		$this->db->select('project.project_id,project.nama_project,progress.progress,progress.tanggal,karyawan.karyawan_id,karyawan.nama');
		$this->db->from('progress');
		$this->db->join('karyawan', 'progress.karyawan_id = karyawan.karyawan_id');
		$this->db->join('project', 'progress.project_id=project.project_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	//menampilkan pilih nama project
	public function pilihNamaProject()
	{
		$query = "SELECT `project`.nama_project as id, `progress`.`nama_project` FROM  `project` JOIN `progress` ON `progress`.`nama_project` = `project`.`project_id`";
		return $this->db->query($query)->row_array();
	}
	//memanggil id pada table oroject
	public function getProjectById($id)
	{
		return $this->db->get_where('project', ['project_id' => $id])->row_array();
	}


	//memanggil data jenis project
	public function getAllJenis()
	{
		return $this->db->get('project')->result_array();
	}

	public function selectIdProject()
	{
		$query = "SELECT `project`.project_id as id, `progress`.`project_id` FROM  `project` JOIN `progress` ON `progress`.`project_id` = `project`.`project_id`";
		return $this->db->query($query)->row();
	}


	public function getDataJabatan($id)
	{
		$this->db->where('karyawan_id', $id);
		$query = $this->db->get('karyawan');
		return $query->row_array();
	}
}
