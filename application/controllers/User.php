<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{ 
   public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('User_model');
        $this->load->helper('url', 'form');
        $this->load->library(array('form_validation', 'session'));
    }

    //membuat method function untuk redirect login 
    function index()
    {
        if (!$this->session->userdata('logged_in') == TRUE) {
            $this->load->view('user/login_admin');
        } else {
            $url = base_url('Home');
            redirect($url);
        }
    }

    // Log in karyawan
    public function login_karyawan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/login_karyawan');
        } else { 
            $nama = $this->input->post('nama', true);
            $email =$this->input->post('email', true);
            $validasi = $this->User_model->login_karyawan($nama, $email);

            if ($validasi->num_rows() > 0) {
                $data           = $validasi->row_array();
                $karyawan_id    = $data['karyawan_id'];
                $nama           = $data['nama'];
                $email       = $data['email'];
                $role           = $data['role'];

                $sessdata = array(
                    'karyawan_id '  => $karyawan_id,
                    'nama'          => $nama,
                    'email'         => $email,
                    'role'          => $role,
                    'karyawan'      => true
                );

                $this->session->set_userdata($sessdata);
                if ($karyawan_id  === $karyawan_id) {
                    redirect('karyawan/dashboard');
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="border-radius: 6px;">
                                                            <i data-feather="bell"></i>
                                                            <p> Nama atau Email yang dimasukan salah !!</p>
                                                        </div>');

                redirect('User');
            }
        } 
    }


    // Log in admin
    public function login_admin()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/login_admin');
        } else {
            $username = $this->input->post('username', true);
            $password = md5($this->input->post('password', true));
            $validasi = $this->User_model->login_admin($username, $password);

            if ($validasi->num_rows() > 0) {
                $data           = $validasi->row_array();
                $userid         = $data['admin_id'];
                $nama           = $data['nama'];
                $username       = $data['username'];
                $role           = $data['role'];

                $sessdata = array(
                    'admin_id'        => $userid,
                    'nama'          => $nama,
                    'username'      => $username,
                    'role'          => $role,
                    'admin'         => true
                );

                $this->session->set_userdata($sessdata);
                if ($userid === $userid) {
                    redirect('admin/dashboard');
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="border-radius: 6px;">
                                                            <i data-feather="bell"></i>
                                                            <p>Wrong username and password !!</p>
                                                        </div>');

                redirect('User');
            }
        }
    }

    //function konfigurasi smtp
    	public function sendEmail($email,$subject,$message)
    {

    	/* use this on server */

    	/* $config = Array(
		      'mailtype' => 'html',
		      'charset' => 'iso-8859-1',
		      'wordwrap' => TRUE
	    	);
    	 */


    	/*This email configuration for sending email by Google Email(Gmail Acccount) from localhost */
	    $config = Array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.googlemail.com',
          'newline' => "\r\n",
	      'smtp_port' => 465,
	      'smtp_user' => 'azharfani6@gmail.com',  //gmail id
	      'smtp_pass' => 'ilwvaijjjrqmkucy',   //gmail password
        'smtp_crypto' => 'security',
	      'mailtype' => 'html',
	      'charset' => 'iso-8859-1',
	      'wordwrap' => TRUE
	    	);

        //configuration smtp mailtrap.io
        // $config = Array(
        // 'protocol' => 'smtp',
        // 'smtp_host' => 'smtp.mailtrap.io',
        // 'smtp_port' => 2525,
        // 'smtp_user' => '6e31d3a8ddbd56',
        // 'smtp_pass' => '96cdfdcb4065db',
        // 'crlf' => "\r\n",
        // 'newline' => "\r\n"
        // );
          $this->email->initialize($config);
          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('noreply');
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);

          if($this->email->send())
         {
           return true;
         }
         else
         {
         	return false;
         }
    }




    // Log user out
    public function logout()
    {
    
        $this->session->sess_destroy();

        // Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('User');
    }

    // Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'Usrname Sudah diambil. Silahkan gunakan username lain');
        if ($this->User_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if no telp exists
    public function check_telp_exists($telp)
    {
        $this->form_validation->set_message('check_telp_exists', 'Usrname Sudah diambil. Silahkan gunakan Nomer telp lain');
        if ($this->Karyawan_Model->check_telp_exists($telp)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'Email Sudah diambil. Silahkan gunakan email lain');
        if ($this->Karyawan_Model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    //function untuk reset password

	function password()
	{
		if($this->input->get('hash'))
		{
			$hash = $this->input->get('hash');
			$this->data['hash']=$hash;
			$getHashDetails = $this->User_model->getHahsDetails($hash);
			if($getHashDetails!=false)
			{
				$hash_expiry = $getHashDetails->hash_expiry;
				$currentDate = date('Y-m-d H:i');
				if($currentDate < $hash_expiry)
				{
					if($_SERVER['REQUEST_METHOD']=='POST')
					{
						// $this->form_validation->set_rules('currentPassword','Current Password','required');
						$this->form_validation->set_rules('password','New Password','required');
						$this->form_validation->set_rules('cpassword','Confirm New Password','required|matches[password]');
						if($this->form_validation->run()==TRUE)
						{
							// $currentPassword = $this->input->post('currentPassword');
							$newPassword = $this->input->post('password');

							// $validateCurrentPassword = $this->User_model->validateCurrentPassword($newPassword,$hash);
							// if($validateCurrentPassword!=false)
							// {
								 $newPassword =md5($newPassword);
								 $data = array(
								 	'password'=>$newPassword,
								 	'hash_key'=>null,
								 	'hash_expiry'=>null
								);
								 $this->User_model->updateNewPassword($data,$hash);
								 $this->session->set_flashdata('success','Successfully changed Password');
								 redirect(base_url('user/login_admin'));
							// }
							// else
							// {
							// 	$this->session->set_flashdata('error','Current Password is wrong');
							// 	$this->load->view('user/reset_password',$this->data);
							// }

						}
						else
						{
							$this->load->view('user/reset_password',$this->data);
						}
					}
					else
					{
						$this->load->view('user/reset_password',$this->data);
					}
				}
				else
				{
					$this->session->set_flashdata('error','link is expired');
					redirect(base_url('user/forgotPassword'));
				}
			}
			else
			{
				echo 'invalid link';exit;
			}
		}
		else
		{
			redirect(base_url('user/forgotPassword'));
		}
	}

    //function untuk mengirm request permintaan reset password
    function forgotPassword()
	{
		$this->load->model('User_model');
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->form_validation->set_rules('email','Email','required');
			if($this->form_validation->run()==TRUE)
			{
				$email  = $this->input->post('email');
				$validateEmail = $this->User_model->validateEmail($email);
				if($validateEmail!=false)
				{
					$row = $validateEmail;
					$user_id = $row->admin_id;

					$string = time().$user_id.$email;
					$hash_string = hash('sha256',$string);
					$currentDate = date('Y-m-d H:i');
					$hash_expiry = date('Y-m-d H:i',strtotime($currentDate. ' + 1 days'));
					$data = array(
						'hash_key'=>$hash_string,
						'hash_expiry'=>$hash_expiry,
					);


					$resetLink = base_url().'user/password?hash='.$hash_string;
					$message = '<p>Your reset password Link is here:</p>'.$resetLink;
					$subject = "Password Reset link";
					$sentStatus = $this->sendEmail($email,$subject,$message);
					if($sentStatus==true)
					{
						$this->User_model->updatePasswordhash($data,$email);
						$this->session->set_flashdata('success','Reset password link successfully sent');
						redirect(base_url('user/forgotPassword'));
                        // var_dump($this->email->print_debugger());
					}
					else
					{
						$this->session->set_flashdata('error','Email sending error');
						$this->load->view('user/lupa_password');
                        // var_dump($this->email->print_debugger());
					}

				}
				else
				{
					$this->session->set_flashdata('error','invalid email id');
					$this->load->view('user/lupa_password');
				}

			}
			else
			{
				$this->load->view('user/lupa_password');
			}
		}
		else
		{
			$this->load->view('user/lupa_password');
		}

	}
}
