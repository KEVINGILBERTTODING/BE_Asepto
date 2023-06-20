<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_Model extends CI_Model  
{
    //membuat function untuk menampilkan data produk lelang
 public function getDataKaryawan(){
        $query=$this->db->get('karyawan');
        return $query->result();  
    }

    public function selectJenisKel(){
        $this->db->select('jeniskel');
        $this->db->from('karyawan');
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }
    }

    public function selectJenisJabatan(){
        $this->db->select('jabatan');
        $this->db->from('karyawan');
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }
    }
   public function getId(){
    $this->db->select('MAX(RIGHT(karyawan_id,5)) as karyawan_id',FALSE); 
      $this->db->from('karyawan');
      $this->db->where('karyawan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->karyawan_id,1,5);
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
      $id_karyawan='KN-'.date('Y').'-'.$kodebaru;

      return $id_karyawan;
   }
    //membuat function untuk insert/tambah data product
   public function tambah(){
    // $insert=$this->db->insert('lelang',$data);
     $this->db->select('MAX(RIGHT(karyawan_id,5)) as karyawan_id',FALSE); 
      $this->db->from('karyawan');
      $this->db->where('karyawan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->karyawan_id,1,5);
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
      $id_karyawan='KN-'.date('Y').'-'.$kodebaru;
      $data=[
        'karyawan_id' =>'KN-'.date('Y').'-'.$kodebaru,
        'nama'				=> $this->input->post('karyawan'),
        'email'          => $this->input->post('email'),
        'telp'      => $this->input->post('telp'),
        'norekening'            =>$this->input->post('norek'),
        'bank'        =>$this->input->post('bank'),
        'jeniskel'        =>$this->input->post('jeniskel')
        ];            
        $this->db->insert('karyawan', $data);
      }

       
    

   //membuat method function untuk bisa mengambil data agar diupdate
   function getDataDetail($id){
    $this->db->where('karyawan_id',$id);
    $query=$this->db->get('karyawan');
    return $query->row_array();
   }
   
   //membuat function untuk update data
   function updateDataKaryawan($id,$data){
   $this->db->select('MAX(RIGHT(karyawan_id,5)) as karyawan_id',FALSE); 
      $this->db->from('karyawan');
      $this->db->where('karyawan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->karyawan_id,1,5);
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
      $id_karyawan='KN-'.date('Y').'-'.$kodebaru;
      $data=[
        'nama'				=> $this->input->post('karyawan'),
        'email'          => $this->input->post('email'),
        'telp'      => $this->input->post('telp'),
        'norekening'            =>$this->input->post('norek'),
        'bank'        =>$this->input->post('bank'),
        'jeniskel'        =>$this->input->post('jeniskel')
      ];
       $this->db->where('karyawan_id',$id);
       $this->db->update('karyawan',$data);
       $this->session->set_flashdata('sukses','data berhasil diupdate');
    }

   


   //membuat function untuk hapus data
   function deleteDataKaryawan($id){
    $this->db->where('karyawan_id',$id);
    $this->db->delete('karyawan');
   }

    // Check telp exists
    public function check_telp_exists($telp)
    {
        $query = $this->db->get_where('karyawan', array('telp' => $telp));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('karyawan', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }
}
