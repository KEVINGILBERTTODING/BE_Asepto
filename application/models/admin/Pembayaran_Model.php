 <?php
	defined('BASEPATH') or exit('No direct script access allowed');


	class Pembayaran_Model extends CI_Model
	{

		//menampilkan hasil pembayaran oleh panitia ke pelelang
		public function getData()
		{
			$this->db->select('project.project_id,project.status, karyawan.karyawan_id, pembayaran_karyawan.*, karyawan.nama, project.nama_project, pembayaran_karyawan.bukti_transfer,pembayaran_karyawan.nominal_dibayarkan,pembayaran_karyawan.nominal_bonus');
			$this->db->from('pembayaran_karyawan');
			$this->db->join('project', 'pembayaran_karyawan.project_id = project.project_id');
			$this->db->join('karyawan', 'karyawan.karyawan_id = pembayaran_karyawan.karyawan_id');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		//menampilkan hasil pembayaran  di karyawan
		public function getDataPembayaranKaryawan($karyawan_id)
		{
			$this->db->select('project.project_id,project.status, karyawan.karyawan_id, pembayaran_karyawan.karyawan_id,pembayaran_karyawan.project_id, pembayaran_karyawan.tgl_bayar, karyawan.nama, project.nama_project, pembayaran_karyawan.bukti_transfer,pembayaran_karyawan.nominal_dibayarkan,pembayaran_karyawan.nominal_bonus');
			$this->db->from('pembayaran_karyawan');
			$this->db->join('project', 'pembayaran_karyawan.project_id = project.project_id');
			$this->db->join('karyawan', 'karyawan.karyawan_id = pembayaran_karyawan.karyawan_id');
			$this->db->where('pembayaran_karyawan.karyawan_id', $karyawan_id);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		//
		public function totalPenghasilan($karyawan_id)
		{
			// $this->db->select('nominal_dibayarkan'); #memilih field untuk menghitung perolehan gaji karyawan
			$this->db->select('*');
			$this->db->from('pembayaran_karyawan');
			$this->db->where('pembayaran_karyawan.karyawan_id', $karyawan_id);
			$query = $this->db->get();
			// return $query->row()->nominal_dibayarkan; #untuk menghitung hasil perolehan gaji karyawwan
			return $query->num_rows();
		}

		public function editData($project_id)
		{
			$this->db->select('project.*, karyawan.karyawan_id, pembayaran_karyawan.karyawan_id, pembayaran_karyawan.tgl_bayar, karyawan.nama, pembayaran_karyawan.bukti_transfer,pembayaran_karyawan.nominal_dibayarkan,pembayaran_karyawan.nominal_bonus');
			$this->db->from('pembayaran_karyawan');
			$this->db->join('project', 'pembayaran_karyawan.project_id = project.project_id');
			$this->db->join('karyawan', 'karyawan.karyawan_id = pembayaran_karyawan.karyawan_id');
			$this->db->where('project.project_id', $project_id);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		//menghitung total pembayaran yang diterima karyawan
		public function countData($project_id)
		{
			$this->db->select('nominal_dibayarkan,nominal_bonus');
			$this->db->from('pembayaran_karyawan');
			$this->db->where('pembayaran_karyawan.project_id', $project_id);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		//untuk mengambil id karyawan dan nama karyawan
		public function getIDKaryawan($id)
		{
			$this->db->select('karyawan.karyawan_id,karyawan.nama');
			$this->db->from('karyawan');
			$this->db->where('karyawan.karyawan_id', $id);

			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return array();
			}
		}

		//membuat verifikasi tipe perusahaan
		public function pilihNamaProject()
		{
			$query = "SELECT `project`.nama_project as id, `pembayaran_karyawan`.`nama_project` FROM  `project` JOIN `pembayaran_karyawan` ON `pembayaran_karyawan`.`nama_project` = `project`.`project_id`";
			return $this->db->query($query)->row_array();
		}
		//memanggil id pada table project
		public function getProjectById($id)
		{
			return $this->db->get_where('project', ['project_id' => $id])->row_array();
		}
		//memanggil data jenis project
		public function getAllJenis()
		{
			// return $this->db->get('project')->result_array();
			$this->db->select('*');
			$this->db->from('project');
			$this->db->where('status', 1);
			$query = $this->db->get();
			return $query->result_array();
		}

		//mengambil id dari karyawan yg dibuat
		public function selectIdKaryawan()
		{
			$query = "SELECT `karyawan`.karyawan_id as id, `feedback`.`karyawan_id` FROM  `karyawan` JOIN `feedback` ON `feedback`.`karyawan_id` = `karyawan`.`karyawan_id`";
			return $this->db->query($query)->row_array();
		}
		//memanggil data nama karyawan
		public function getAllNama()
		{
			return $this->db->get('karyawan')->result_array();
		}

		public function selectIdProject()
		{
			$query = "SELECT `project`.project_id as id, `feedback`.`project_id` FROM  `project` JOIN `feedback` ON `feedback`.`project_id` = `project`.`project_id`";
			return $this->db->query($query)->row();
		}
	}
