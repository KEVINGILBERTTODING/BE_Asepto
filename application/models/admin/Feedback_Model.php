<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback_Model extends CI_Model  
{

  public function getId(){
    $this->db->select('MAX(RIGHT(feedback_id,5)) as feedback_id',FALSE); 
      $this->db->from('feedback');
      $this->db->where('feedback_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->feedback_id,1,5);
      $add=(int)$num+1;
      if(strlen($add)==1){
          $kodebaru="0000".$add;
      }else if(strlen($add)==2){
          $kodebaru="000".$add;
      }else if(strlen($add)==3){
          $kodebaru="00".$add;
      }else if(strlen($add)==4){
          $kodebaru="0".$add;
      }else{
          $kodebaru="".$add;
      }
      $id_feedback='FDB-'.date('Y').'-'.$kodebaru;

      return $id_feedback;
   }

    //membuat function untuk insert feedback 
 public function masukanFeedback($project_id){
    $this->db->select('feedback.*,project.project_id,karyawan.nama,project.nama_project');
		$this->db->from('feedback');
		$this->db->join('karyawan','karyawan.karyawan_id=feedback.karyawan_id');
		$this->db->join('project','feedback.project_id=project.project_id');
		$this->db->where('feedback.feedback_id', $project_id);

		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{ 
			return array();
		}

  }
    //menampilkan data feedback
    public function getDataFeedback(){
    $this->db->select('feedback.*,project.project_id,karyawan.karyawan_id,karyawan.nama,project.nama_project');
		$this->db->from('feedback');
		$this->db->join('karyawan','karyawan.karyawan_id=feedback.karyawan_id');
		$this->db->join('project','feedback.project_id=project.project_id');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{ 
			return array();
		} 
    }

//menampilkan data feedback berdasarkan karyawan
public function getDataFeedbackKaryawan($karyawan_id){
  $this->db->select('feedback.*,project.project_id,karyawan.karyawan_id,karyawan.nama,project.nama_project');
		$this->db->from('feedback');
		$this->db->join('karyawan','karyawan.karyawan_id=feedback.karyawan_id');
		$this->db->join('project','feedback.project_id=project.project_id');
    $this->db->where('feedback.karyawan_id', $karyawan_id);
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return array();
		}
}


    //detail data feedback
    public function detailData($id){
      $this->db->where('feedback_id',$id);
      $query = $this->db->get('feedback');
      return $query->row();
    }

    //edit data feedback
    public function editFeedback($id){
      $data =[
        'feedback'   => $this->input->post('feedback'),
      ];
      $this->db->where('feedback_id',$id);
      $this->db->update('feedback',$data);
      $this->session->set_flashdata('sukses','Update data berhasil');
    }
    //menampilkan data feedback di dashboard karyawan
    public function tampilDataFeedback($karyawan_id){
      $this->db->select('feedback.*,project.project_id,karyawan.karyawan_id,karyawan.nama,project.nama_project');
      $this->db->from('feedback');
      $this->db->join('karyawan','karyawan.karyawan_id=feedback.karyawan_id');
      $this->db->join('project','feedback.project_id=project.project_id');
      $this->db->where('feedback.karyawan_id',$karyawan_id);
      $query=$this->db->get()->num_rows();
      return $query;
    }


	//membuat function untuk hapus data
   function deleteDataFeedback($id){
    $this->db->where('feedback_id',$id);
    $this->db->delete('feedback');
   }

   //membuat verifikasi tipe perusahaan
     public function pilihNamaProject(){
       $query="SELECT `project`.nama_project as id, `feedback`.`nama_project` FROM  `project` JOIN `feedback` ON `feedback`.`nama_project` = `project`.`project_id`";
       return $this->db->query($query)->row_array();
  }
  //memanggil id pada table project
  public function getProjectById($id){
    return $this->db->get_where('project',['project_id' => $id])->row_array();
  }
  //memanggil data jenis project
  public function getAllJenis(){
    return $this->db->get('project')->result_array();
  }

   //mengambil id dari karyawan yg dibuat
     public function selectIdKaryawan(){
  $query="SELECT `karyawan`.karyawan_id as id, `feedback`.`karyawan_id` FROM  `karyawan` JOIN `feedback` ON `feedback`.`karyawan_id` = `karyawan`.`karyawan_id`";
       return $this->db->query($query)->row_array();
     }
     //memanggil data nama karyawan
  public function getAllNama(){
    return $this->db->get('karyawan')->result_array();
  }

  //memilih id project
  public function selectIdProject() {
      $query="SELECT `project`.project_id as id, `feedback`.`project_id` FROM  `project` JOIN `feedback` ON `feedback`.`project_id` = `project`.`project_id`";
       return $this->db->query($query)->row();
  }
}
