<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->user = $this->ion_auth->user()->row();
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->form_validation->set_error_delimiters('', '');
		$this->load->helper('url');
	}

	public function index()
	{

		$data = [
			'user' => $this->user,
			'judul'	=> 'Clustering',
			'subjudul' => 'Mengelola Kriteria',
		];
		$arr['data'] = $this->master->getKriteria();
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/kriteria/data',$arr);
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data($id = null)
	{
		$this->output_json($this->master->getDataKriteria($id), false);
	}

	public function add()
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Clustering',
			'subjudul' => 'Mengelola Kriteria'
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/kriteria/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function validasi_kriteria($method)
	{
		$id_kriteria 	= $this->input->post('id_kriteria', true);

		$this->form_validation->set_rules('kriteria', 'Kriteria', 'required');
	}

	public function save()
	{
		$method = $this->input->post('method', true);
		$this->validasi_kriteria($method);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'kriteria' => form_error('kriteria'),
				]
			];
			redirect('/kriteria/add', 'refresh');
		} else {
			$input = [
				'kriteria'		=> $this->input->post('kriteria', true),
			];
			$check = $this->master->checkKriteria($input['kriteria']);
			if(count($check) <= 0)
			{
				$action = $this->master->create('kriteria', $input);
				if($action)
				{
					redirect('/kriteria', 'refresh');
				}
			}else
			{
				redirect('/kriteria', 'refresh');
			}
		}
	}

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('kriteria', $chk, 'id_kriteria')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}
}
