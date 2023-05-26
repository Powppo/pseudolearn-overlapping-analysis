<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{

	public $mhs, $user;

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->helper('my');
		$this->load->model('Master_model', 'master');
		$this->load->model('Soal_model', 'soal');
		$this->load->model('Ujian_model', 'ujian');
		$this->load->model('Level_model', 'level');
		$this->form_validation->set_error_delimiters('', '');

		$this->user = $this->ion_auth->user()->row();
		$this->mhs 	= $this->ujian->getIdMahasiswa($this->user->username);
	}

	public function akses_dosen()
	{
		if (!$this->ion_auth->in_group('dosen')) {
			show_error('Halaman ini khusus untuk dosen untuk membuat Test Online, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
	}

	public function akses_mahasiswa()
	{
		if (!$this->ion_auth->in_group('mahasiswa')) {
			show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	// public function json($id = null)
	// {
	// 	$this->akses_dosen();

	// 	$this->output_json($this->ujian->getDataUjian($id), false);
	// }

	public function convert_tgl($tgl)
	{
		$this->akses_dosen();
		return date('Y-m-d H:i:s', strtotime($tgl));
	}

	/**
	 * BAGIAN MAHASISWA
	 */

	public function list_json_old()
	{
		$this->akses_mahasiswa();

		$list = $this->ujian->getListUjian($this->mhs->id_mahasiswa, $this->mhs->kelas_id);

		$this->output_json($list, false);
	}

	public function list_json($id_level = null)
	{
		$this->akses_mahasiswa();
		$mhs = $this->mhs;
		// print_r($mhs);
		$data = $this->ujian->getListUjian($id_level, $mhs->id_mahasiswa);
		// for ($i = 0; $i < count($data); $i++) {
		// 	$data[$i]->id_ujian_enc = urlencode($this->encryption->encrypt($data[$i]->id_ujian));
		// }

		echo json_encode($data);
	}

	public function list_level()
	{
		$this->akses_mahasiswa();

		$user = $this->ion_auth->user()->row();
    
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Soal',
			'subjudul'	=> 'List Soal',
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'total'     => $this->db->query('select sum(nilai) as total from nilai where id_user = ?', $user->id)->row_array()['total']
			
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/list');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function list_ujian()
	{
		$this->akses_mahasiswa();

		$user = $this->ion_auth->user()->row();

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Soal',
			'subjudul'	=> 'List Soal',
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'total'     => $this->db->query('select sum(nilai) as total from nilai where id_user = ?', $user->id)->row_array()['total']
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/list_ujian');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function encrypt()
	{
		$id = $this->input->post('id', true);
		$key = urlencode($this->encryption->encrypt($id));
		// $decrypted = $this->encryption->decrypt(rawurldecode($key));
		$this->output_json(['key' => $key]);
	}

	public function soal()
	{
		$this->akses_mahasiswa();
		$user = $this->ion_auth->user()->row();
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Token Ujian',
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username)
		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/soal');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function save_history($id_soal)
	{
		$id_user = $this->session->userdata('user_id');
		$user = $this->db->query('select * from users where id = ?', $id_user)->row_array();
		$soal = $this->db->query('select * from tb_soal where id_soal = ?', $id_soal)->row_array();
		$count_data = $this->db->query('SELECT * FROM history_ujian WHERE idsoal = ? and iduser = ?', [$id_soal, $id_user])->num_rows();
		if ($count_data === 0) {
			$this->db->insert('history_ujian', [
				'idsoal' => $id_soal,
				'iduser' => $id_user,
			]);
		}
		$this->session->sess_expiration = 0;// expires in 4 hours
	}

	public function save_percobaan($id_soal)
	{
		// Decrypt Id
		$id_user = $this->session->userdata('user_id');
		$soal = $this->db->query('select * from tb_soal where id_soal = ?', $id_soal)->row_array();
		$click = $this->db->query('select * from history_percobaan where id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();
		$data['id_user'] = $id_user;
		$data['id_soal'] = $id_soal;
		$data['id_level'] = $soal['id_level'];
		$data['jumlah'] = $click['jumlah'] + 1;
			$this->db->insert('history_percobaan', $data);
			$this->session->sess_expiration = 0;// expires in 4 hours
		$this->output_json(['status' => true]);
	}

	function save_confidence($id_soal){
		$id_user = $this->session->userdata('user_id');
		$click = $this->db->query('select * from confidence_tag where id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();
        $data['id_user'] = $id_user;
		$data['id_soal'] = $id_soal;
		$data['confidence'] = $this->input->post('confidence');
		$data['waktu'] = $this->input->post('waktu');
		$this->db->insert('confidence_tag', $data);
		$this->session->sess_expiration = 0;// expires in 4 hours
		$this->session->set_userdata(array(
			'confidence' => $this->input->post('confidence'),
			'waktu' => $this->input->post('waktu')
		));
    }

	function save_condition($id_soal){
		$id_user = $this->session->userdata('user_id');
		$confidences = $this->session->userdata('confidence_id');
		// $click = $this->db->query('select * from users where id = ?', $id_user)->row_array();
		// $confidences = $this->db->query('SELECT DISTINCT(id) FROM confidence_tag', [$id_soal, $id_user])->row_array();
		$this->db->insert('conditions', [
			'id_soal' => $id_soal,
			'id_user' => $id_user,
			// 'username' => $click['username'],
			'status_jawaban' => $this->input->post('condition'),
			'confidence'=>$this->session->confidence,
			'waktu'=>$this->session->waktu,
		]);
		$this->session->sess_expiration = 0;// expires in 4 hours
		$this->output_json(['status' => true]);
    }

	public function index()
	{
		$this->akses_mahasiswa();
		$id = $this->input->get('key', true);

		$soal 		= $this->ujian->getSoal($id);
		//$soal_urut_ok = $soal;
		//echo "tes";
		//print_r($soal_urut_ok);

		$mhs		= $this->mhs;
		$levelId = 0;
			$i = 0;
			foreach ($soal as $s) {
				$levelId = $s->id_level;
				$soal_per = new stdClass();
				$soal_per->id_soal 		= $s->id_soal;
				$soal_per->id_level 	= $s->id_level;
				$soal_per->soal 		= $s->soal;
				$soal_per->judul 		= $s->judul;
				$soal_per->opsi_a 		= $s->opsi_a;
				$soal_per->opsi_b 		= $s->opsi_b;
				$soal_per->opsi_c 		= $s->opsi_c;
				$soal_per->opsi_d 		= $s->opsi_d;
				$soal_per->opsi_e 		= $s->opsi_e;
				$soal_per->opsi_f 		= $s->opsi_f;
				$soal_per->opsi_g 		= $s->opsi_g;
				$soal_per->opsi_h 		= $s->opsi_h;
				$soal_per->opsi_i 		= $s->opsi_i;
				$soal_per->opsi_j 		= $s->opsi_j;
				$soal_per->opsi_k 		= $s->opsi_k;
				$soal_per->opsi_l 		= $s->opsi_l;
				$soal_per->opsi_m 		= $s->opsi_m;
				$soal_per->opsi_n 		= $s->opsi_n;
				$soal_per->opsi_o 		= $s->opsi_o;
				$soal_per->opsi_p 		= $s->opsi_p;
				$soal_per->opsi_q 		= $s->opsi_q;
				$soal_per->opsi_r 		= $s->opsi_r;
				$soal_per->opsi_s 		= $s->opsi_s;
				$soal_per->opsi_t 		= $s->opsi_t;
				$soal_per->opsi_u 		= $s->opsi_u;
				$soal_per->opsi_v 		= $s->opsi_v;
				$soal_per->opsi_w 		= $s->opsi_w;
				$soal_per->opsi_x 		= $s->opsi_x;
				$soal_per->opsi_y 		= $s->opsi_y;
				$soal_per->opsi_z 		= $s->opsi_z;
				$soal_per->urut_a 			= $s->urut_a;
				$soal_per->urut_b 			= $s->urut_b;
				$soal_per->urut_c 			= $s->urut_c;
				$soal_per->urut_d 			= $s->urut_d;
				$soal_per->urut_e 			= $s->urut_e;
				$soal_per->urut_f 			= $s->urut_f;
				$soal_per->urut_g 			= $s->urut_g;
				$soal_per->urut_h 			= $s->urut_h;
				$soal_per->urut_i 			= $s->urut_i;
				$soal_per->urut_j 			= $s->urut_j;
				$soal_per->urut_k 			= $s->urut_k;
				$soal_per->urut_l 			= $s->urut_l;
				$soal_per->urut_m 			= $s->urut_m;
				$soal_per->urut_n 			= $s->urut_n;
				$soal_per->urut_o 			= $s->urut_o;
				$soal_per->urut_p 			= $s->urut_p;
				$soal_per->urut_q 			= $s->urut_q;
				$soal_per->urut_r 			= $s->urut_r;
				$soal_per->urut_s 			= $s->urut_s;
				$soal_per->urut_t 			= $s->urut_t;
				$soal_per->urut_u 			= $s->urut_u;
				$soal_per->urut_v 			= $s->urut_v;
				$soal_per->urut_w 			= $s->urut_w;
				$soal_per->urut_x 			= $s->urut_x;
				$soal_per->urut_y 			= $s->urut_y;
				$soal_per->urut_z 			= $s->urut_z;
				$soal_per->clue_a 			= $s->clue_a;
				$soal_per->clue_b 			= $s->clue_b;
				$soal_per->clue_c 			= $s->clue_c;
				$soal_per->clue_d 			= $s->clue_d;
				$soal_per->clue_e 			= $s->clue_e;
				$soal_per->clue_f 			= $s->clue_f;
				$soal_per->clue_g 			= $s->clue_g;
				$soal_per->clue_h 			= $s->clue_h;
				$soal_per->clue_i 			= $s->clue_i;
				$soal_per->clue_j 			= $s->clue_j;
				$soal_per->clue_k 			= $s->clue_k;
				$soal_per->clue_l 			= $s->clue_l;
				$soal_per->clue_m 			= $s->clue_m;
				$soal_per->clue_n 			= $s->clue_n;
				$soal_per->clue_o 			= $s->clue_o;
				$soal_per->clue_p 			= $s->clue_p;
				$soal_per->clue_q 			= $s->clue_q;
				$soal_per->clue_r 			= $s->clue_r;
				$soal_per->clue_s 			= $s->clue_s;
				$soal_per->clue_t 			= $s->clue_t;
				$soal_per->clue_u 			= $s->clue_u;
				$soal_per->clue_v 			= $s->clue_v;
				$soal_per->clue_w 			= $s->clue_w;
				$soal_per->clue_x 			= $s->clue_x;
				$soal_per->clue_y 			= $s->clue_y;
				$soal_per->clue_z 			= $s->clue_z;
				$soal_per->variable_1 			= $s->variable_1;
				$soal_per->variable_2 			= $s->variable_2;
				$soal_per->variable_3 			= $s->variable_3;
				$soal_per->variable_4 			= $s->variable_4;
				$soal_per->variable_5 			= $s->variable_5;
				$soal_per->variable_6 			= $s->variable_6;
				$soal_per->variable_7 			= $s->variable_7;
				$soal_per->variable_8 			= $s->variable_8;
				$soal_per->jenis_data_v1 			= $s->jenis_data_v1;
				$soal_per->jenis_data_v2 			= $s->jenis_data_v2;
				$soal_per->jenis_data_v3 			= $s->jenis_data_v3;
				$soal_per->jenis_data_v4 			= $s->jenis_data_v4;
				$soal_per->jenis_data_v5 			= $s->jenis_data_v5;
				$soal_per->jenis_data_v6 			= $s->jenis_data_v6;
				$soal_per->jenis_data_v7 			= $s->jenis_data_v7;
				$soal_per->jenis_data_v8 			= $s->jenis_data_v8;
				$soal_urut_ok[$i] 		= $soal_per;
				$i++;
			}

		$arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j","k","l","m","n","o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$arr_clue = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j","k","l","m","n","o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$var_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		$jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		shuffle($var_opsi);
		shuffle($jenis_opsi);
		$var_count = 8;
		$jenis_count = 8;
		$html = '';
		$no = 1;
		$feedback = $this->ujian->getLevelFeedback($levelId);
		if($feedback)
		{
			$feedback = [
							'tipe_data'=>$feedback->tipe_data
							,'input'=>$feedback->input
							,'process'=>$feedback->process
							,'output'=>$feedback->output
						];
		}else{
			$feedback = [
							'tipe_data'=>''
							,'input'=>''
							,'process'=>''
							,'output'=>''
						];
		}
		//$feedbackStr = '';
		// if (!empty($soal_urut_ok)) {
			foreach ($soal_urut_ok as $s) 
			{
				//print_r($soal_urut_ok);
				//echo "tes1";
				$path = 'uploads/bank_soal/';
				$html .= '<input type="hidden" id="id_soal" name="id_soal_' . $no . '" value="' . $s->id_soal . '">';
				$html .= '<input type="hidden" id="id_user" name="user-id" value="' . $mhs->id_mahasiswa . '">';
				$html .= '<input type="hidden" name="rg_' . $no . '" id="rg_' . $no . '" value="r">';
				$html .= '<div class="step" id="widget_' . $no . '">';
				$html .= '<main class="quiz">
				<div class="quiz__description description">
			
					<p class="description__question">';
				$html .= '<div class="text-center"><div class="w-25"></div></div>' . $s->soal . '<div class="funkyradio"></p>';
				$html .= '<div class="description__data-type data-type" style="margin-left: -3px; width:350px; background-color: #ffe3c5;border-color:#75251e">
				<h4 class="data-type__title" style="background-color: #ab372d;"><b>Tipe Data</b></h4>
				<ul class="data-type__items">';
				for ($i=0; $i < $var_count; $i++) { 
					$var = "jenis_data_v".$var_opsi[$i];
					!empty($s->$var) ? $html .= '<li class="data-type__item draggable" id="opsi_jenis_'.$var_opsi[$i].'" value="' .$s->$var. '">'.$s->$var.'</li>' : '';
				}
				$html .= '</ul>
						</div>';
				$html .= '<div class="description__algorithm algorithm" style="margin-left: -3px; width:350px; background-color: #ffe3c5;border-color:#75251e">
						<h4 class="algorithm__title" style="background-color: #ab372d"><b>Algoritma</b></h4>
						<ul class="algorithm__items" style="margin-right:35px;">';
				for ($j = 0; $j < $this->config->item('jml_opsi'); $j++) {
					$array_clues = [];
					for ($k = 0; $k < $this->config->item('jml_opsi'); $k++) {
						$isClue = "clue_" . $arr_clue[$k];
						$clues = $s->$isClue;
						if ($clues) {
							$clues = 'opsi_'.$s->$clues;
							array_push($array_clues, $clues);
						}
					}
					$opsi 			= "opsi_" . $arr_opsi[$j];
						if (!in_array($opsi, $array_clues)) {
							$pilihan_opsi 	= !empty($s->$opsi) ? $s->$opsi : "";
							
							!empty($s->$opsi) ? $html .= '<li class="algorithm__item draggable dsdsd" style="width:300px;" id="opsi_' . strtolower($arr_opsi[$j]) . '">'. $pilihan_opsi .'</li>' : '';
						}		
					}
					$html .= '</ul>
						</div>
						
					</div>
					</div>
					<div class="quiz__answer answer">
						<table class="answer__content">
							<tbody>
								<tr>
									<th><span style="background-color: #FF6D60">Judul</span></th>
									<td>'.$s->judul.'</td>
								</tr>
								<tr>
									<th><span style="background-color: #FF6D60">Deklarasi</span></th>
									<td>
										<table>
											<tbody>';
											for ($i=0; $i < $jenis_count; $i++) { 
												$var = "variable_".$jenis_opsi[$i];
												!empty($s->$var) ? $html .= '<tr style="height: 40px;"><th>'.$s->$var.'</th><td class="drop-zone" id="jenis_'.$jenis_opsi[$i].'"></td>
											</tr>' : '';
											}
											$html .= '</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="answer__content">
							<tbody>
								<tr>
									<th rowspan="40"><span style="background-color: #FF6D60">DeskripsiAlgoritma</span></th>
									
								</tr>';
								if ($s->clue_a) {
									$clue = $s->clue_a;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_a) ? $html .= '<tr style="height: 50px;"><td class="drop-zone" id="jawaban_'.$s->urut_a.'"></td></tr>' : '';
								}
								if ($s->clue_b) {
									$clue = $s->clue_b;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_b) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_b.'"></td></tr>' : '';
								}
								if ($s->clue_c) {
									$clue = $s->clue_c;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_c) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_c.'"></td></tr>' : '';
								}
								if ($s->clue_d) {
									$clue = $s->clue_d;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_d) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_d.'"></td></tr>' : '';
								}
								if ($s->clue_e) {
									$clue = $s->clue_e;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_e) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_e.'"></td></tr>' : '';
								}

								if ($s->clue_f) {
									$clue = $s->clue_f;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_f) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_f.'"></td></tr>' : '';
								}

								if ($s->clue_g) {
									$clue = $s->clue_g;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_g) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_g.'"></td></tr>' : '';
								}

								if ($s->clue_h) {
									$clue = $s->clue_h;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_h) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_h.'"></td></tr>' : '';
								}

								if ($s->clue_i) {
									$clue = $s->clue_i;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_i) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_i.'"></td></tr>' : '';
								}
								
								if ($s->clue_j) {
									$clue = $s->clue_j;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_j) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_j.'"></td></tr>' : '';
								}
								if ($s->clue_k) {
									$clue = $s->clue_k;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_k) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_k.'"></td></tr>' : '';
								}
								if ($s->clue_l) {
									$clue = $s->clue_l;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_l) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_l.'"></td></tr>' : '';
								}
								if ($s->clue_m) {
									$clue = $s->clue_m;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_m) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_m.'"></td></tr>' : '';
								}
								if ($s->clue_n) {
									$clue = $s->clue_n;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_n) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_n.'"></td></tr>' : '';
								}
								if ($s->clue_o) {
									$clue = $s->clue_o;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_o) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_o.'"></td></tr>' : '';
								}
								if ($s->clue_p) {
									$clue = $s->clue_p;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_p) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_p.'"></td></tr>' : '';
								}
								if ($s->clue_q) {
									$clue = $s->clue_q;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_q) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_q.'"></td></tr>' : '';
								}
								if ($s->clue_r) {
									$clue = $s->clue_r;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_r) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_r.'"></td></tr>' : '';
								}
								if ($s->clue_s) {
									$clue = $s->clue_s;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_s) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_s.'"></td></tr>' : '';
								}
								if ($s->clue_t) {
									$clue = $s->clue_t;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_t) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_t.'"></td></tr>' : '';
								}
								if ($s->clue_u) {
									$clue = $s->clue_u;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_u) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_u.'"></td></tr>' : '';
								}
								if ($s->clue_v) {
									$clue = $s->clue_v;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_v) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_v.'"></td></tr>' : '';
								}
								if ($s->clue_w) {
									$clue = $s->clue_w;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_w) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_w.'"></td></tr>' : '';
								}
								if ($s->clue_x) {
									$clue = $s->clue_x;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_x) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_x.'"></td></tr>' : '';
								}
								if ($s->clue_y) {
									$clue = $s->clue_y;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_y) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_y.'"></td></tr>' : '';
								}
								if ($s->clue_z) {
									$clue = $s->clue_z;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr style="height: 50px;"><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_z) ? $html .= '<tr style="height: 50px;"><td class="drop-zone"  id="jawaban_'.$s->urut_z.'"></td></tr>' : '';
								}
							$html .= '</tbody>
						</table>
					</div>
					<!-- ALERT -->
					<div id="success-alert" class="alert" style="display: none; ">
						<h4>Jawaban anda benar, silahkan lanjut ke studi kasus berikutnya</h4>
						<img src="'.base_url().'template/images/success.png" alt="success" />
						<button type="button" id="btn_corrects" onclick="return submit_nilai('.$s->id_soal.','.$s->id_level.');" class="btn btn-xs btn-info">close</button>
					</div>
					<div id="fail-alert" class="alert" style="display: none;height:600px">
						<p>Jawaban anda masih salah, silahkan menyusun ulang</p><br>
						<br>
							<br>
						<small id="tipe_data_feedback" style="display:none;">Teliti kembali tipe data Anda :'.$feedback['tipe_data'].'</small></br>
						<small id="input_feedback" style="display:none;">Teliti kembali inputan Anda : '.$feedback['input'].'</small></br>
						<small id="process_feedback" style="display:none;">Teliti kembali proses Anda :'.$feedback['process'].'</small></br>
						<small id="output_feedback" style="display:none;">Ups! Outputnya salah : '.$feedback['output'].'</small></br>
						</p>
						<img src="'.base_url().'template/images/fail.jpeg" style="width:120px;" alt="fail" />
						<button type="button" id="btn_incorrects" onclick="return close_alert();" class="btn btn-xs btn-info">close</button>
					</div>
					</main>';
				}
					$html .= '</div>';
					$no++;
				// }
			//}

		// Enkripsi Id Tes
		// $id_tes = $this->encryption->encrypt($detail_tes->id);
		$timeTaken = null;
		$userId = $this->session->userdata('user_id');
		$getTimeTaken = $this->ujian->getTimeTakenByIdKey($id,$userId);
		if($getTimeTaken)
		{
			$timeTaken = $getTimeTaken->waktu;
			$str_time = $timeTaken;
			$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
			sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
			$timeTaken = $hours * 3600 + $minutes * 60 + $seconds; //on scond calculate
		}

		
		$data = [
			'user' 		=> $this->user,
			'mhs'		=> $this->mhs,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Lembar Ujian',
			// 'soal'		=> $detail_tes,
			'no' 		=> $no,
			'html' 		=> $html,
			'timeTaken' => $timeTaken,
			'levelId'	=> $levelId,
			'id_tes'	=> $id
		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/sheet');
		$this->load->view('_templates/topnav/_footer.php');
	}
	
	public function simpan_hasil($id)
	{
		// Decrypt Id
		$id_user = $this->session->userdata('user_id');
		$soal = $this->db->query('select * from tb_soal where id_soal = ?', $id)->row_array();
		$data['id_user'] = $id_user;
		$data['id_soal'] = $id;
		$data['id_level'] = $soal['id_level'];
		$data['nilai'] = $soal['bobot'];
		$cek = $this->db->query('select * from nilai where id_user = ? and id_soal = ?', [$id_user, $id])->num_rows();
		if ($cek == 0) {
			$this->db->insert('nilai', $data);
		}
		$this->session->sess_expiration = 0;// expires in 4 hours
		$this->output_json(['status' => true]);
	}

	public function simpan_satu()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);

		$input 	= $this->input->post(null, true);
		$list_jawaban 	= "";
		for ($i = 1; $i < $input['jml_soal']; $i++) {
			$_tjawab 	= "opsi_" . $i;
			$_tidsoal 	= "id_soal_" . $i;
			$_ragu 		= "rg_" . $i;
			$jawaban_ 	= empty($input[$_tjawab]) ? "" : $input[$_tjawab];
			$list_jawaban	.= "" . $input[$_tidsoal] . ":" . $jawaban_ . ":" . $input[$_ragu] . ",";
		}
		$list_jawaban	= substr($list_jawaban, 0, -1);
		$d_simpan = [
			'list_jawaban' => $list_jawaban
		];

		// Simpan jawaban
		$this->master->update('h_ujian', $d_simpan, 'id', $id_tes);
		$this->output_json(['status' => true]);
	}

	public function simpan_akhir()
	{
		// Decrypt Id
		$id_tes = $this->input->post('id', true);
		$id_tes = $this->encryption->decrypt($id_tes);

		// Get Jawaban
		$list_jawaban = $this->ujian->getJawaban($id_tes);

		// Pecah Jawaban
		$pc_jawaban = explode(",", $list_jawaban);

		$jumlah_benar 	= 0;
		$jumlah_salah 	= 0;
		$jumlah_ragu  	= 0;
		$nilai_bobot 	= 0;
		$total_bobot	= 0;
		$jumlah_soal	= sizeof($pc_jawaban);

		foreach ($pc_jawaban as $jwb) {
			$pc_dt 		= explode(":", $jwb);
			$id_soal 	= $pc_dt[0];
			$jawaban 	= $pc_dt[1];
			$ragu 		= $pc_dt[2];

			$cek_jwb 	= $this->soal->getSoalById($id_soal);
			$total_bobot = $total_bobot + $cek_jwb->bobot;

			$jawaban == $cek_jwb->jawaban ? $jumlah_benar++ : $jumlah_salah++;
		}

		$nilai = ($jumlah_benar / $jumlah_soal)  * 100;
		$nilai_bobot = ($total_bobot / $jumlah_soal)  * 100;

		$d_update = [
			'jml_benar'		=> $jumlah_benar,
			'nilai'			=> number_format(floor($nilai), 0),
			'nilai_bobot'	=> number_format(floor($nilai_bobot), 0),
			'status'		=> 'N'
		];

		$this->master->update('h_ujian', $d_update, 'id', $id_tes);
		$this->output_json(['status' => TRUE, 'data' => $d_update, 'id' => $id_tes]);
	}

	public function listCondition_json($id, $id_soal)
    {
        //$this->akses_mahasiswa();

        $data = $this->ujian->detailLogConditions2($id, $id_soal);

        echo json_encode($data);
    }
	public function listConfidence_json($id, $id_soal)
    {
        //$this->akses_mahasiswa();

        $data = $this->ujian->detailLogConfidence2($id, $id_soal);

        echo json_encode($data);
    }
}
