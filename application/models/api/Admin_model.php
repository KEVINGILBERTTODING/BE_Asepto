<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}


	function validate($username)
	{

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $username);
		return $this->db->get()->row_array();
	}
}
