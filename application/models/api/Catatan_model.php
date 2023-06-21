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
		return $this->db->get()->result();
	}
}
