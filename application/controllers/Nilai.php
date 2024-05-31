<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->user = $this->ion_auth->user()->row();
		$this->load->model('Perhitungan_model', 'perhitungan');
	}

	public function index()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Clustering',
			'subjudul' => 'Nilai Mahasiswa',
			'dataCondition' => $this->perhitungan->getDataCondition(999),
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('nilai', $data);
		$this->load->view('_templates/dashboard/_footer.php');
	}
	function updateNilai()
	{
		$post_test = $this->input->post('post_test');
		$pre_test = $this->input->post('pre_test');
		foreach ($post_test as $key => $value) {
			if ($key) {
				$nilai = [
					'id_user' => $key,
					'post_test' => $value,
					'pre_test' => $pre_test[$key],
				];
				$this->perhitungan->updateTestNilai($nilai);
			}
		}
		redirect('nilai');
	}
}
