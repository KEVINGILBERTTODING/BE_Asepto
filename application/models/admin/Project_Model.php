<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_Model extends CI_Model
{
    //membuat function untuk menampilkan data produk lelang
    public function getDataProject()
    {
        $query = $this->db->get('project');
        return $query->result();
    }

    public function getDataProjectDashboard()
    {
        $query = $this->db->get('project');
        return $query->row();
    }

    public function getDataProjectDetail($id)
    {
        $this->db->where('project_id', $id);
        $query = $this->db->get('project');
        return $query->row_array();
    }

    //menampilkan data project yg berhasil dikerjakan di dashboard
    public function dataprojectBerhasil()
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('status', 1);
        $where = '(status=1)';
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //menampilkan data project yg berhasil dikerjakan
    public function projectBerhasil()
    {
        $results = array();
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }
    //mengambil data tipe perusahaan

    public function selectTipePerusahaan()
    {
        $this->db->select('tipe_perusahaan');
        $this->db->from('project');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    //membuat data kategori project
    public function selectKategoriProject()
    {
        $this->db->select('kategori');
        $this->db->from('project');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    //mengambil status dari project yg dibuat
    public function selectStatus()
    {
        $this->db->select('status');
        $this->db->from('project');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    //mengambil data nama project
    public function selectNamaProject()
    {
        $this->db->select('nama_project');
        $this->db->from('project');
        $query = $this->db->get();
        return $query->result();
    }

    public function selectIdProject($id)
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getId()
    {
        $this->db->select('MAX(RIGHT(project_id,5)) as project_id', FALSE);
        $this->db->from('project');
        $this->db->where('project_id !=', 'NULL');
        $query = $this->db->get();
        $kode = $query->row();
        $num = substr($kode->project_id, 1, 5);
        $add = (int)$num + 1;
        if (strlen($add) == 1) {
            $kodebaru = "0000" . $add;
        } else if (strlen($add) == 2) {
            $kodebaru = "000" . $add;
        } else if (strlen($add) == 3) {
            $kodebaru = "00" . $add;
        } else if (strlen($add) == 4) {
            $kodebaru = "0" . $add;
        } else {
            $kodebaru = "" . $add;
        }
        $id_project = 'PRJ-' . date('Y') . '-' . $kodebaru;

        return $id_project;
    }
    //membuat function untuk insert/tambah data product
    public function tambah()
    {
        // $insert=$this->db->insert('lelang',$data);
        $this->db->select('MAX(RIGHT(project_id,5)) as project_id', FALSE);
        $this->db->from('project');
        $this->db->where('project_id !=', 'NULL');
        $query = $this->db->get();
        $kode = $query->row();
        $num = substr($kode->project_id, 1, 5);
        $add = (int)$num + 1;
        if (strlen($add) == 1) {
            $kodebaru = "0000" . $add;
        } else if (strlen($add) == 2) {
            $kodebaru = "000" . $add;
        } else if (strlen($add) == 3) {
            $kodebaru = "00" . $add;
        } else if (strlen($add) == 4) {
            $kodebaru = "0" . $add;
        } else {
            $kodebaru = "" . $add;
        }
        $id_project = 'PRJ-' . date('Y') . '-' . $kodebaru;
        $data = [
            'project_id' => $id_project,
            'nama_project'                => $this->input->post('nama_project'),
            'deskripsi_project'         => $this->input->post('deskripsi'),
            'tgl_mulai'                    => $this->input->post('tgl_mulai'),
            'tgl_selesai'                => $this->input->post('tgl_selesai'),
            'nama_perusahaan'           => $this->input->post('nama_perusahaan'),
            'email_perusahaan'          => $this->input->post('email_perusahaan'),
            'tipe_perusahaan'           => $this->input->post('tipe_perusahaan')
        ];
        $this->db->insert('project', $data);
    }




    //membuat method function untuk bisa mengambil data agar diupdate
    function getDataDetail($id)
    {
        $this->db->where('project_id', $id);
        $query = $this->db->get('project');
        return $query->row();
    }

    //membuat function untuk update data
    function updateDataProject($id, $data)
    {
        $this->db->select('MAX(RIGHT(project_id,5)) as project_id', FALSE);
        $this->db->from('project');
        $this->db->where('project_id !=', 'NULL');
        $query = $this->db->get();
        $kode = $query->row();
        $num = substr($kode->project_id, 1, 5);
        $add = (int)$num + 1;
        if (strlen($add) == 1) {
            $kodebaru = "0000" . $add;
        } else if (strlen($add) == 2) {
            $kodebaru = "000" . $add;
        } else if (strlen($add) == 3) {
            $kodebaru = "00" . $add;
        } else if (strlen($add) == 4) {
            $kodebaru = "0" . $add;
        } else {
            $kodebaru = "" . $add;
        }
        $id_project = 'PRJ-' . date('Y') . '-' . $kodebaru;
        $data = [
            'nama_project'                => $this->input->post('nama_project'),
            'deskripsi_project'         => $this->input->post('deskripsi'),
            'tgl_mulai'                    => $this->input->post('tgl_mulai'),
            'tgl_selesai'                => $this->input->post('tgl_selesai'),
            'nama_perusahaan'           => $this->input->post('nama_perusahaan'),
            'email_perusahaan'          => $this->input->post('email_perusahaan'),
            'tipe_perusahaan'           => $this->input->post('tipe_perusahaan')
        ];
        $this->db->where('project_id', $id);
        $this->db->update('project', $data);
        $this->session->set_flashdata('sukses', 'data berhasil diupdate');
    }

    //     //membuat verifikasi tipe perusahaan
    //      public function insertJenisPerusahaan(){
    //        $query="SELECT `project`.tipe as id, `jenis_perusahaan`.`tipe` FROM  `project` JOIN `jenis_perusahaan` ON `project`.`tipe` = `jenis_perusahaan`.`id`";
    //        return $this->db->query($query)->row_array();
    //   }
    //   //memanggil id pada table karyawan
    //   public function getProjectById($id){
    //     return $this->db->get_where('project',['project_id' => $id])->row_array();
    //   }
    //   //memanggil data jenis kelamin
    //   public function getAllJenis(){
    //     return $this->db->get('jenis_perusahaan')->result_array();
    //   }

    //untuk mengambil data yg sudah selesai projectnya

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('project');
        $query = $this->db->get();
        return $query->result();
    }
    //membuat function untuk hapus data
    function deleteDataProject($id)
    {
        $this->db->where('project_id', $id);
        $this->db->delete('project');
    }

    //detail project
    function hasilProjectById($id)
    {
        // $results = array();
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('status', 1);
        $this->db->where('project_id', $id);
        $query = $this->db->update('project');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }
    //membuat method function untuk upload gambar  project yang telah selesai
    public function uploadFile($id)
    {
        $gambar = $this->input->post('gambar_project');
        $this->db->set('gambar_project', $gambar);
        $this->db->where('project_id', $id);
        return $this->db->update('project');
        $this->session->set_flashdata('sukses', 'data berhasil diupdate');
    }

    //memanggil data jenis project
    public function getAllKaryawan()
    {
        return $this->db->get('karyawan')->result_array();
    }

    public function getDataKaryawanDetail($id)
    {
        $this->db->where('karyawan_id', $id);
        $query = $this->db->get('karyawan');
        return $query->row_array();
    }

    //function untuk mengecek project yang masuk di karyawan
    public function getDataProjectKaryawanDetail($id)
    {
        $this->db->where('karyawan_id', $id);
        $query = $this->db->get('project');
        return $query->row_array();
    }
}
