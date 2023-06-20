<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CatatanTambahan_Model extends CI_Model  
{
    //membuat function untuk menampilkan data produk lelang
 public function getDataCatatan(){
        $query=$this->db->get('catatan_tambahan');
        return $query->result();  
    }    
   public function getId(){
    $this->db->select('MAX(RIGHT(catatan_id,5)) as catatan_id',FALSE); 
      $this->db->from('catatan_tambahan');
      $this->db->where('catatan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->catatan_id,1,5);
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
      $catatan_id='NOTE-'.date('Y').'-'.$kodebaru;

      return $catatan_id;
   }
    //membuat function untuk insert/tambah data product
   public function tambah(){
      $this->db->select('MAX(RIGHT(catatan_id,5)) as catatan_id',FALSE); 
      $this->db->from('catatan_tambahan');
      $this->db->where('catatan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->catatan_id,1,5);
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
      $catatan_id='NOTE-'.date('Y').'-'.$kodebaru;
      $data=[
        'catatan_id' =>$catatan_id,
        'catatan'         => $this->input->post('catatan'),
        'tanggal_event' =>$this->input->post('tanggal_event')
        ];            
        $this->db->insert('catatan_tambahan', $data);
      }

       
    

   //membuat method function untuk bisa mengambil data agar diupdate
   function getDataDetail($id){
    $this->db->where('catatan_id',$id);
    $query=$this->db->get('catatan_tambahan');
    return $query->row();
   }
   
   //membuat function untuk update data
   function updateDataCatatan($id,$data){
        $this->db->select('MAX(RIGHT(catatan_id,5)) as catatan_id',FALSE); 
      $this->db->from('catatan_tambahan');
      $this->db->where('catatan_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->catatan_id,1,5);
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
      $catatan_id='NOTE-'.date('Y').'-'.$kodebaru;
      $data=[
        'catatan'         => $this->input->post('catatan'),
        'tanggal_event' =>$this->input->post('tanggal_event')
      ];
       $this->db->where('catatan_id',$id);
       $this->db->update('catatan_tambahan',$data);
       $this->session->set_flashdata('sukses','data berhasil diupdate');
    }

   //membuat function untuk hapus data
   function deleteDataCatatan($id){
    $this->db->where('catatan_id',$id);
    $this->db->delete('catatan_tambahan');
   }

}
