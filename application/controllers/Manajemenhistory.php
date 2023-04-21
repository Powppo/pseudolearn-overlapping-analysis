<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManajemenHistory extends CI_Controller {

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

	public function index()
	{
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
        redirect('manajemenhistory');
    }
}
