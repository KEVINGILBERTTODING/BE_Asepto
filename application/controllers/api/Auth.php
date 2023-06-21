<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api/karyawan_model');
		$this->load->model('api/admin_model');
	}

	function login()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$validateKaryawan =  $this->karyawan_model->validate($username);
		$validateAdmin = $this->admin_model->validate($username);

		if ($validateKaryawan != null) {
			if ($validateKaryawan['email'] == $email) {
				$response = [
					'code' => 200,
					'user_id' => $validateKaryawan['karyawan_id'],
					'role' => 2
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 404,
					'message' => 'Email salah'
				];
				echo json_encode($response);
			}
		} else if ($validateAdmin != null) {

			if ($validateAdmin['password'] == md5($password)) {
				$response = [
					'code' => 200,
					'user_id' => $validateAdmin['admin_id'],
					'role' => 1
				];
				echo json_encode($response);
			} else {
				$response = [
					'code' => 404,
					'message' => 'Password Salah'
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'code' => 404,
				'message' => 'Username belum terdaftar'
			];
			echo json_encode($response);
		}
	}
}
