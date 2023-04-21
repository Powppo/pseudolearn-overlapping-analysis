<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailHistory extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		
		$this->load->library(['datatables']);// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->load->model('Ujian_model', 'ujian');
		
		$this->user = $this->ion_auth->user()->row();
	}

	public function output_json($data, $encode = true)
	{
		if($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function data()
	{
		// $nip_dosen = null;
		
		// if( $this->ion_auth->in_group('dosen') ) {
		// 	$nip_dosen = $this->user->username;
		// }

		$this->output_json($this->ujian->getLogAktivitas(), false);
	}

	public function NilaiMhs($id)
	{
		$this->output_json($this->ujian->HslUjianById($id, true), false);
	}

	public function index()
	{
        $results = $this->ujian->confidenceHistory();
		$data = [
			'user' => $this->user,
			'informasi' => $results,
			'judul'	=> 'History',
			'subjudul'=> 'History Confidence Tag',
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/history_confidence');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function historyConfidence($id)
	{
		$results = $this->ujian->getConfidenceLevel($id);
		$data = [
			'user' => $this->user,
			'hasil' => $results,
			'judul'	=> 'History',
			'subjudul'=> 'Detail Level',
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/detailsconfidence');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function logConfidencePerLevel($id, $id_level) {

		$detail_data = $this->ujian->detailConfidenceLevel($id, $id_level);
		$id_soal = $this->db->query('select id_soal from conditions')->row_array();
		$data = [
			'user' => $this->user,
			'detail' => $detail_data,
			'judul'	=> 'History',
			'subjudul'=> 'History Per Level',
			'total_yakin_salah' => $this->db->query("SELECT COUNT(*) AS total_yakin_salah FROM conditions c JOIN tb_soal s ON c.id_soal = s.id_soal WHERE confidence = 'yakin' AND status_jawaban = 'salah' AND c.id_user = ? AND s.id_level = ?", [$id, $id_level])->row_array()['total_yakin_salah'],
			'total_yakin_benar' => $this->db->query("SELECT COUNT(*) AS total_yakin_benar FROM conditions c JOIN tb_soal s ON c.id_soal = s.id_soal WHERE confidence = 'yakin' AND status_jawaban = 'benar' AND c.id_user = ? AND s.id_level = ?", [$id, $id_level])->row_array()['total_yakin_benar'],
			'total_tidakyakin_salah' => $this->db->query("SELECT COUNT(*) AS total_tidakyakin_salah FROM conditions c JOIN tb_soal s ON c.id_soal = s.id_soal WHERE confidence = 'tidak yakin' AND status_jawaban = 'salah' AND c.id_user = ? AND s.id_level = ?", [$id, $id_level])->row_array()['total_tidakyakin_salah'],
			'total_tidakyakin_benar' => $this->db->query("SELECT COUNT(*) AS total_tidakyakin_benar FROM conditions c JOIN tb_soal s ON c.id_soal = s.id_soal WHERE confidence = 'tidak yakin' AND status_jawaban = 'benar' AND c.id_user = ? AND s.id_level = ?", [$id, $id_level])->row_array()['total_tidakyakin_benar'],
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['soal'] = $this->db->query('select * from tb_soal')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/log_confidence_level');
		$this->load->view('_templates/dashboard/_footer.php');

	}

	public function logConfidencePerSoal($id, $id_level) {
		$detail_data = $this->ujian->detailConfidenceSoal($id, $id_level);
		$data = [
			'user' => $this->user,
			'detail' => $detail_data,
			'judul'	=> 'History',
			'subjudul'=> 'Detail Soal',
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['soal'] = $this->db->query('select * from tb_soal')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/log_confidence_soal');
		$this->load->view('_templates/dashboard/_footer.php');

	}

	public function logConfidenceSubSoal($id, $id_soal) {
		$detail_data = $this->ujian->detailsConfidencePerSoal($id, $id_soal);
		$data = [
			'user' => $this->user,
			'detail' => $detail_data,
			'judul'	=> 'History',
			'subjudul'=> 'History Per Soal',
			'total_yakin_salah' => $this->db->query("SELECT COUNT(id) AS total_yakin_salah FROM conditions WHERE confidence = 'yakin' AND status_jawaban = 'salah' AND id_user = ? AND id_soal = ?", [$id, $id_soal])->row_array()['total_yakin_salah'],
			'total_yakin_benar' => $this->db->query("SELECT COUNT(id) AS total_yakin_benar FROM conditions WHERE confidence = 'yakin' AND status_jawaban = 'benar' AND id_user = ? AND id_soal = ?", [$id, $id_soal])->row_array()['total_yakin_benar'],
			'total_tidakyakin_salah' => $this->db->query("SELECT COUNT(id) AS total_tidakyakin_salah FROM conditions WHERE confidence = 'tidak yakin' AND status_jawaban = 'salah' AND id_user = ? AND id_soal = ?", [$id, $id_soal])->row_array()['total_tidakyakin_salah'],
			'total_tidakyakin_benar' => $this->db->query("SELECT COUNT(id) AS total_tidakyakin_benar FROM conditions WHERE confidence = 'tidak yakin' AND status_jawaban = 'benar' AND id_user = ? AND id_soal = ?", [$id, $id_soal])->row_array()['total_tidakyakin_benar'],
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['soal'] = $this->db->query('select * from tb_soal')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/log_confidence_subsoal');
		$this->load->view('_templates/dashboard/_footer.php');

	}

	public function manageHistoryUjian(){
	$results = $this->ujian->historyUjian();
		$data = [
			'user' => $this->user,
			'informasi' => $results,
			'judul'	=> 'Kelola Data History',
			'subjudul'=> 'History Ujian Mahasiswa',
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/kelola_historyujian');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function hapus($iduser, $idsoal)
    {
        $this->ujian->hapusData($iduser, $idsoal);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('detailhistory/manageHistoryUjian');
    }
}
