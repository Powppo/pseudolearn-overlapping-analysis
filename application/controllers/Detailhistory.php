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
        $detail_data = $this->ujian->logHistory();
		$data = [
			'user' => $this->user,
			'detail' => $detail_data,
			'judul'	=> 'Hasil Ujian',
			'subjudul'=> 'Detail Log Aktivitas Mahasiswa',
			'total_yakin' => $this->db->query("SELECT COUNT(IF(confidence = 'yakin', confidence, NULL)) as total_yakin from confidence_tag GROUP BY id_soal, id_user")->row_array()['total_yakin'],
			'total_benar' => $this->db->query("SELECT COUNT(IF(status_jawaban = 'benar', status_jawaban, NULL)) as total_benar from conditions INNER JOIN tb_soal ON tb_soal.id_soal = conditions.id_soal GROUP BY tb_soal.id_soal")->row_array()['total_benar'],
		];

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

		if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/detail_log');
		$this->load->view('_templates/dashboard/_footer.php');

	}
}
