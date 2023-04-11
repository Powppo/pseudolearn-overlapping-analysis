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
			[
				'box' 		=> 'orange',
				'total' 	=> $this->dashboard->totals(),
				'title'		=> 'HasilUjian',
				'icon'		=> 'check'
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function index()
	{
		$user = $this->user;
		//level 1
		$results_ys_satu = $this->dashboard->get_confidence_ys();
		$results_yb_satu = $this->dashboard->get_confidence_yb();
		$results_tys_satu = $this->dashboard->get_confidence_tys();
		$results_tyb_satu = $this->dashboard->get_confidence_tyb();

		//level 2
		$results_ys_dua = $this->dashboard->get_confidence_ys2();
		$results_yb_dua = $this->dashboard->get_confidence_yb2();
		$results_tys_dua = $this->dashboard->get_confidence_tys2();
		$results_tyb_dua = $this->dashboard->get_confidence_tyb2();

		//level 3
		$results_ys_tiga = $this->dashboard->get_confidence_ys3();
		$results_yb_tiga = $this->dashboard->get_confidence_yb3();
		$results_tys_tiga = $this->dashboard->get_confidence_tys3();
		$results_tyb_tiga = $this->dashboard->get_confidence_tyb3();

		//level 4
		$results_ys_empat = $this->dashboard->get_confidence_ys4();
		$results_yb_empat = $this->dashboard->get_confidence_yb4();
		$results_tys_empat = $this->dashboard->get_confidence_tys4();
		$results_tyb_empat = $this->dashboard->get_confidence_tyb4();

		//level 5
		$results_ys_lima = $this->dashboard->get_confidence_ys5();
		$results_yb_lima = $this->dashboard->get_confidence_yb5();
		$results_tys_lima = $this->dashboard->get_confidence_tys5();
		$results_tyb_lima = $this->dashboard->get_confidence_tyb5();
		$data = [
			'user' 		=> $user,

			//level 1
			'yakinsalah_satu' => $results_ys_satu,
			'yakinbenar_satu' => $results_yb_satu,
			'tidakyakinsalah_satu' => $results_tys_satu,
			'tidakyakinbenar_satu' => $results_tyb_satu,

			//level 2
			'yakinsalah_dua' => $results_ys_dua,
			'yakinbenar_dua' => $results_yb_dua,
			'tidakyakinsalah_dua' => $results_tys_dua,
			'tidakyakinbenar_dua' => $results_tyb_dua,

			//level 3
			'yakinsalah_tiga' => $results_ys_tiga,
			'yakinbenar_tiga' => $results_yb_tiga,
			'tidakyakinsalah_tiga' => $results_tys_tiga,
			'tidakyakinbenar_tiga' => $results_tyb_tiga,

			//level 4
			'yakinsalah_empat' => $results_ys_empat,
			'yakinbenar_empat' => $results_yb_empat,
			'tidakyakinsalah_empat' => $results_tys_empat,
			'tidakyakinbenar_empat' => $results_tyb_empat,

			//level 5
			'yakinsalah_lima' => $results_ys_lima,
			'yakinbenar_lima' => $results_yb_lima,
			'tidakyakinsalah_lima' => $results_tys_lima,
			'tidakyakinbenar_lima' => $results_tyb_lima,

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