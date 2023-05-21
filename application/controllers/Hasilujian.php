<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilUjian extends CI_Controller {

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
		$results = $this->ujian->getLogAktivitas();
		$data = [
			'user' => $this->user,
			'informasi' => $results,
			'judul'	=> 'Log',
			'subjudul'=> 'Log Aktivitas Mahasiswa',
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/hasil');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function detailLevel($id)
	{
		$results = $this->ujian->getHistoryLevel($id);
		$data = [
			'user' => $this->user,
			'hasil' => $results,
			'judul'	=> 'Log',
			'subjudul'=> 'Detail Log Per Level',
			'total_waktu' => $this->db->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(waktu))) AS total_waktu FROM conditions c WHERE c.status_jawaban='benar' AND id_user = ?", $id)->row_array()['total_waktu'],
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/historylevel');
		$this->load->view('_templates/dashboard/_footer.php');
	}
	
	public function detailLog($id, $id_level) {

		$detail_data = $this->ujian->detailLogAktivitas($id, $id_level);
		$id_soal = $this->db->query('select id_soal from conditions')->row_array();
		$data = [
			'user' => $this->user,
			'detail' => $detail_data,
			'judul'	=> 'Log',
			'subjudul'=> 'Detail Log Per Soal',
			'total_waktu' => $this->db->query('select SEC_TO_TIME(SUM(TIME_TO_SEC(waktu))) as total_waktu from conditions c INNER JOIN tb_soal s ON c.id_soal = s.id_soal where c.status_jawaban="benar" and c.id_user = ? and s.id_level = ?', [$id, $id_level])->row_array()['total_waktu'],
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
		$this->load->view('ujian/details_hasil');
		$this->load->view('_templates/dashboard/_footer.php');

	}

	public function detailConfidence($id, $id_soal) {

		$detail_conf = $this->ujian->detailLogConfidence($id, $id_soal);
		// $detail_cond = $this->ujian->detailLogConditions($id, $id_soal);
		$data = [
			'user' => $this->user,
			'detail' => $detail_conf,
			'details' => $this->db->query("SELECT s.judul, c.status_jawaban as details FROM conditions c INNER JOIN tb_soal s ON c.id_soal = s.id_soal WHERE c.id_user = ? and c.id_soal = ?", [$id, $id_soal])->row_array()['details'],
			// 'details' => $this->db->query("SELECT s.judul, d.confidence, d.status_jawaban as details FROM `detail_confidence_tag` d INNER JOIN tb_soal s ON s.id_soal = d.id_soal where d.status_jawaban IS NOT NULL and d.id_user = ? and d.id_soal = ?", [$id, $id_soal])->row_array()['details'],
			'details_max' =>$this->db->query("SELECT MAX(d.id) AS details_max FROM `confidence_tag` d INNER JOIN tb_soal s ON s.id_soal = d.id_soal where d.id_user = ? and d.id_soal = ?", [$id, $id_soal])->row_array()['details_max'],
			'judul'	=> 'Log',
			'subjudul'=> 'Detail Confidence Tag',
			'total' => $this->db->query('select sum(jumlah) as total from history_percobaan where id_user = ? and id_soal = ?', [$id, $id_soal])->row_array()['total'],
			'total_benar' => $this->db->query("SELECT COUNT(IF(status_jawaban = 'benar', status_jawaban, NULL)) as total_benar from conditions where id_user = ? and id_soal = ?", [$id, $id_soal])->row_array()['total_benar'],
			'total_salah' => $this->db->query("SELECT COUNT(IF(status_jawaban = 'salah', status_jawaban, NULL)) as total_salah from conditions where id_user = ? and id_soal = ?", [$id, $id_soal])->row_array()['total_salah'],
			'total_waktu' => $this->db->query("SELECT waktu AS total_waktu FROM confidence_tag WHERE id_user = ? AND id_soal = ? ORDER BY id DESC LIMIT 1", [$id, $id_soal])->row_array()['total_waktu'],
			'nama_mahasiswa' => $this->db->query("SELECT CONCAT(first_name, ' ', last_name) AS nama_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nama_mahasiswa'],
			'nim_mahasiswa' => $this->db->query("SELECT username AS nim_mahasiswa FROM users WHERE id = ?", $id)->row_array()['nim_mahasiswa'],
			'kelas_mahasiswa' => $this->db->query("SELECT u.id, k.nama AS kelas_mahasiswa FROM users u INNER JOIN tb_kelas k ON u.id_kelas = k.id_kelas WHERE id = ?", $id)->row_array()['kelas_mahasiswa'],
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/detail_conf');
		$this->load->view('_templates/dashboard/_footer.php');

	}
}