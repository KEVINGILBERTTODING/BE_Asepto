 <?php
defined('BASEPATH') or exit('No direct script access allowed');


class RiwayatProgress_Model extends CI_Model{
 

     //menampilkan data progress dari setiap karyawan
    public function getDataProgress(){
      	$this->db->select('progress.*,project.project_id,project.nama_project,karyawan.karyawan_id,karyawan.nama');
		$this->db->from('progress');
		$this->db->join('karyawan','progress.karyawan_id=karyawan.karyawan_id');
		$this->db->join('project','progress.project_id=project.project_id');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
    }


}