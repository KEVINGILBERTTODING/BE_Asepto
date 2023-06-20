<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectKaryawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('admin/Project_Model');
        // $this->load->library('form_validation');
        // $this->load->helper('url', 'form');
    }
    //membuat method function index untuk menampilkan data project
    public function index()
    {

        $data['title']          = 'Data Project Masuk';

        $user   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
        $data['dataProject']    = $this->db->query('select * from project where karyawan_id = "' . $user->karyawan_id . '"')->result();


        //untuk menampilkan nama karyawan yang tampil
        $data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
        $this->load->view('theme_karyawan/header', $data);
        $this->load->view('karyawan/project', $data);
        $this->load->view('theme_karyawan/footer', $data);
    }
}
