<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_login();
        $this->load->model('admin/Pembayaran_Model');
        $this->load->model('Karyawan/Progress_Model');
        $this->load->model('admin/Feedback_Model');
        $this->load->model('admin/Project_Model');

        if (!$this->session->userdata('karyawan') == true) {
            redirect('User');
        }
    }

    public function index()
    {
        $data['title']  = 'Dashboard';
        $user = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();
        $data['dataProject']    = $this->Project_Model->getDataProjectDashboard();

        $data['total_penghasilan'] = $this->Pembayaran_Model->totalPenghasilan($user->karyawan_id);
        //$this->Pembayaran_Model->countData();
        $data['data_progress'] = $this->Progress_Model->totalProgress($user->karyawan_id);
        $data['riwayat_feedback'] = $this->Feedback_Model->tampilDataFeedback($user->karyawan_id);

        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_karyawan/header', $data);
        $this->load->view('karyawan/dashboard', $data);
        $this->load->view('theme_karyawan/footer', $data);
    }
    public function total_penghasilan()
    {
        $data['title']  = 'Total Penghasilan';
        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_karyawan/header', $data);
        $this->load->view('karyawan/penghasilan', $data);
        $this->load->view('theme_karyawan/footer', $data);
    }
    public function progress()
    {
        $data['title']  = 'Progress';
        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['user']   = $this->db->query('select * from karyawan where nama = "' . $_SESSION['nama'] . '"')->row();

        $this->load->view('theme_karyawan/header', $data);
        $this->load->view('karyawan/progress/index', $data);
        $this->load->view('theme_karyawan/footer', $data);
    }
    public function feedback()
    {
        $this->load->view('karyawan/feedback');
    }
}
