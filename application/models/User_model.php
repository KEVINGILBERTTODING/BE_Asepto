<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    //id admin
    public function getIdAdmin() {
        $this->db->select('MAX(RIGHT(admin_id,5)) as admin_id',FALSE);
      $this->db->from('admin');
      $this->db->where('admin_id !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->admin_id,1,5);
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
      $id_admin='ADM-'.date('Y').'-'.$kodebaru;

      return $id_admin;
    }

    public function getDataAdmin($admin_id){
         $results = array();
    	$this->db->select('*');
    	$this->db->from('admin');
    	$this->db->where('admin.admin_id', $admin_id);
        $query=$this->db->get();
       if($query->num_rows()>0){
    		$results = $query->result();
    	} return $results;
    }

   public function update_data($id,$table,$data){
		$this->db->where($id);
		$this->db->update($table,$data);
	}
    // karyawan log in
    public function login_karyawan($nama, $email)
    {
        $this->db->where('nama', $nama);
        $this->db->where('email', $email);
        return $this->db->get('karyawan', 1);

    }


    // admin log in
    public function login_admin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('admin', 1);
    }

    //check username untuk login admin
     public function check_username_exists($username)
    {
        $query = $this->db->get_where('admin', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    function validateEmail($email)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE email='$email'");
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function updatePasswordhash($data,$email)
	{
		$this->db->where('email',$email);
		$this->db->update('admin',$data);
	}

	function getHahsDetails($hash)
	{
		$query =$this->db->query("select * from admin WHERE hash_key='$hash'");
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

	}

	function validateCurrentPassword($currentPassword,$hash)
	{
		$query = $this->db->query("SELECT * FROM admin WHERE password='$currentPassword' AND hash_key='$hash'");
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateNewPassword($data,$hash)
	{
		$this->db->where('hash_key',$hash);
		$this->db->update('admin',$data);
	}

}
