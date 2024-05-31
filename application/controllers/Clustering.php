<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clustering extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->user = $this->ion_auth->user()->row();
		
	}

    public function admin_box()
	{
		$box = [
			[
				'box' 		=> 'green',
				'title'		=> 'Kriteria',
			],
			[
				'box' 		=> 'yellow',
				'title'		=> 'Nilai',
			],
			[
				'box' 		=> 'red',
				'title'		=> 'Perhitungan',
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function index()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Clustering',
			'subjudul'=> 'Menu Clustering',
		];
        if ( $this->ion_auth->is_admin() ) {
			$data['info_box'] = $this->admin_box();
		}else{
			$data['mahasiswa'] = $this->dashboard->get_where('mahasiswa a', 'nim', $user->username)->row();
		}

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('clustering');
		$this->load->view('_templates/dashboard/_footer.php');
	}
}

