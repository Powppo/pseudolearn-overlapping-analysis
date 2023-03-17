<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->model('Dashboard_model', 'dashboard');
		$this->user = $this->ion_auth->user()->row();
	}

	public function admin_box()
	{
		$box = [
			[
				'box' 		=> 'green',
				'total' 	=> $this->dashboard->total('tb_level'),
				'title'		=> 'level',
				'icon'		=> 'arrow-up'
			],
			[
				'box' 		=> 'yellow',
				'total' 	=> $this->dashboard->total('tb_soal'),
				'title'		=> 'Soal',
				'icon'		=> 'book'
			],
			[
				'box' 		=> 'red',
				'total' 	=> $this->dashboard->total('mahasiswa'),
				'title'		=> 'Mahasiswa',
				'icon'		=> 'user'
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function index()
	{
		$user = $this->user;
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Dashboard',
			'subjudul'	=> 'Data Statistik',
		];

		if ( $this->ion_auth->is_admin() ) {
			$data['info_box'] = $this->admin_box();
		}else{
			$data['mahasiswa'] = $this->dashboard->get_where('mahasiswa a', 'nim', $user->username)->row();
		}

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('dashboard');
		$this->load->view('_templates/dashboard/_footer.php');
	}
}