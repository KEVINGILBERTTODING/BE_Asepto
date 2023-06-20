<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('admin/Project_Model');
        $this->load->model('admin/Karyawan_Model');

        if (!$this->session->userdata('admin') == true) {
            redirect('User');
        }
    }

    public function index()
    {
        $data['title']  = 'Dashboard';
        $user = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
        $data['dataProject']    = $this->Project_Model->getDataProjectDashboard();
        $data['total_karyawan'] = $this->db->get("karyawan")->num_rows();
        $data['project_selesai'] = $this->Project_Model->dataprojectBerhasil();
        $data['total_project'] = $this->db->get('project')->num_rows();

        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_admin/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('theme_admin/footer', $data);
    }
    public function karyawan()
    {
        $data['title']  = 'Total Karyawan';
        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_admin/header', $data);
        $this->load->view('admin/karyawan/index', $data);
        $this->load->view('theme_admin/footer', $data);
    }
    public function project_selesai()
    {
        $data['title']  = 'Project Selesai';
        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_admin/header', $data);
        $this->load->view('admin/project/selesai', $data);
        $this->load->view('theme_admin/footer', $data);
    }
    public function total_project()
    {
        $this->load->view('admin/project/index');
    }
}
