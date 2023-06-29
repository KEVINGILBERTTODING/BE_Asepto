<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Task_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	function insertTask($data)
	{
		$insert = $this->db->insert('task', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}
