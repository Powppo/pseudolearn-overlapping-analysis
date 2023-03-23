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

	public function json($id = null)
	{
		$this->akses_dosen();

		$this->output_json($this->ujian->getDataUjian($id), false);
	}

	public function master()
	{
		$this->akses_dosen();
		$user = $this->ion_auth->user()->row();
		$data = [
			'user' => $user,
			'judul'	=> 'Ujian',
			'subjudul' => 'Data Ujian',
			'dosen' => $this->ujian->getIdDosen($user->username),
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function add()
	{
		$this->akses_dosen();

		$user = $this->ion_auth->user()->row();

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Tambah Ujian',
			'matkul'	=> $this->soal->getMatkulDosen($user->username),
			'dosen'		=> $this->ujian->getIdDosen($user->username),
			'level'		=> $this->db->query('select * from tb_level')->result_array(),
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit($id)
	{
		$this->akses_dosen();

		$user = $this->ion_auth->user()->row();

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Edit Ujian',
			'matkul'	=> $this->soal->getMatkulDosen($user->username),
			'dosen'		=> $this->ujian->getIdDosen($user->username),
			'ujian'		=> $this->ujian->getUjianById($id),
			'level'		=> $this->db->query('select * from tb_level')->result_array(),
		];

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('ujian/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function convert_tgl($tgl)
	{
		$this->akses_dosen();
		return date('Y-m-d H:i:s', strtotime($tgl));
	}

	public function validasi()
	{
		$this->akses_dosen();

		$user 	= $this->ion_auth->user()->row();
		$dosen 	= $this->ujian->getIdDosen($user->username);
		$jml 	= $this->ujian->getJumlahSoal($dosen->id_dosen)->jml_soal;
		$jml_a 	= $jml + 1; // Jika tidak mengerti, silahkan baca user_guide codeigniter tentang form_validation pada bagian less_than

		$this->form_validation->set_rules('nama_ujian', 'Nama Ujian', 'required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('jumlah_soal', 'Jumlah Soal', "required|integer|less_than[{$jml_a}]|greater_than[0]", ['less_than' => "Soal tidak cukup, anda hanya punya {$jml} soal"]);
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');
		$this->form_validation->set_rules('waktu', 'Waktu', 'required|integer|max_length[4]|greater_than[0]');
		$this->form_validation->set_rules('jenis', 'Acak Soal', 'required|in_list[acak,urut]');
	}

	public function save()
	{
		$this->validasi();
		$this->load->helper('string');

		$method 		= $this->input->post('method', true);
		$dosen_id 		= $this->input->post('dosen_id', true);
		$matkul_id 		= $this->input->post('matkul_id', true);
		$nama_ujian 	= $this->input->post('nama_ujian', true);
		$jumlah_soal 	= $this->input->post('jumlah_soal', true);
		$tgl_mulai 		= $this->convert_tgl($this->input->post('tgl_mulai', 	true));
		$tgl_selesai	= $this->convert_tgl($this->input->post('tgl_selesai', true));
		$waktu			= $this->input->post('waktu', true);
		$jenis			= $this->input->post('jenis', true);
		$level			= $this->input->post('level', true);
		$token 			= strtoupper(random_string('alpha', 5));

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = false;
			$data['errors'] = [
				'nama_ujian' 	=> form_error('nama_ujian'),
				'jumlah_soal' 	=> form_error('jumlah_soal'),
				'tgl_mulai' 	=> form_error('tgl_mulai'),
				'tgl_selesai' 	=> form_error('tgl_selesai'),
				'waktu' 		=> form_error('waktu'),
				'jenis' 		=> form_error('jenis'),
				'level' 		=> form_error('level'),
			];
		} else {
			$input = [
				'nama_ujian' 	=> $nama_ujian,
				'jumlah_soal' 	=> $jumlah_soal,
				'tgl_mulai' 	=> $tgl_mulai,
				'terlambat' 	=> $tgl_selesai,
				'waktu' 		=> $waktu,
				'jenis' 		=> $jenis,
				'level' 		=> $level,
			];
			if ($method === 'add') {
				$input['dosen_id']	= $dosen_id;
				$input['matkul_id'] = $matkul_id;
				$input['token']		= $token;
				$action = $this->master->create('m_ujian', $input);
			} else if ($method === 'edit') {
				$id_ujian = $this->input->post('id_ujian', true);
				$action = $this->master->update('m_ujian', $input, 'id_ujian', $id_ujian);
			}
			$data['status'] = $action ? TRUE : FALSE;
		}
		$this->output_json($data);
	}

	public function delete()
	{
		$this->akses_dosen();
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('m_ujian', $chk, 'id_ujian')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function refresh_token($id)
	{
		$this->load->helper('string');
		$data['token'] = strtoupper(random_string('alpha', 5));
		$refresh = $this->master->update('m_ujian', $data, 'id_ujian', $id);
		$data['status'] = $refresh ? TRUE : FALSE;
		$this->output_json($data);
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

	public function token($id)
	{
		$this->akses_mahasiswa();
		$user = $this->ion_auth->user()->row();

		$data = [
			'user' 		=> $user,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Token Ujian',
			'mhs' 		=> $this->ujian->getIdMahasiswa($user->username),
			'ujian'		=> $this->ujian->getUjianById($id),
			'encrypted_id' => urlencode($this->encryption->encrypt($id))
		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/token');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function cektoken()
	{
		$id = $this->input->post('id_ujian', true);
		$token = $this->input->post('token', true);
		$cek = $this->ujian->getUjianById($id);

		$data['status'] = $token === $cek->token ? TRUE : FALSE;
		$this->output_json($data);
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
		$point = $this->db->query('select * from nilai where id_soal = ?', $id_soal)->row_array();
		$count_data = $this->db->query('SELECT * FROM history_ujian WHERE idsoal = ? and iduser = ?', [$id_soal, $id_user])->num_rows();
		$count_datas = $this->db->query('SELECT * FROM nilai WHERE id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();
		$total = $this->db->query('select sum(nilai) as total from nilai where id_user = ?', $id_user)->row_array()['total']; 
		if ($count_data === 0 & $count_datas === 0) {
			$this->db->insert('history_ujian', [
				'idsoal' => $id_soal,
				'iduser' => $id_user,
				'poin' => $soal['bobot'],
				'id_level' => $soal['id_level'],
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name'],
				'nim' => $user['username'],
				'total_poin' => $total + 20,
				'studi_kasus' => $soal['soal'],
				'sub_soal' => $soal['judul'],
			]);
		}
	}

	public function save_detail_confidence($id_soal)
	{
		$id_user = $this->session->userdata('user_id');
		$confidence = $this->db->query('select c.confidence, cd.condition from confidence_tag c inner join conditions cd on c.id_soal = cd.id_soal')->num_rows();
		$this->db->insert('detail_confidence_tag', [
		'id_soal' => $id_soal,
		'id_user' => $id_user,
		'confidence' => $confidence['confidence'],
		'status_jawaban' => $confidence['condition'],
	]);
}

	public function save_percobaan($id_soal)
	{
		// Decrypt Id
		$id_user = $this->session->userdata('user_id');
		$click = $this->db->query('select * from history_percobaan where id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();
		$data['id_user'] = $id_user;
		$data['id_soal'] = $id_soal;
		$data['jumlah'] = $click['jumlah'] + 1;
			$this->db->insert('history_percobaan', $data);
		
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
		$this->output_json(['status' => true]);
    }

	function save_condition($id_soal){
		$id_user = $this->session->userdata('user_id');
		$click = $this->db->query('select * from users where id = ?', $id_user)->row_array();
		$this->db->insert('conditions', [
			'id_soal' => $id_soal,
			'id_user' => $id_user,
			'username' => $click['username'],
			'status_jawaban' => $this->input->post('condition'),
		]);
		// $data['id_user'] => $click['username'];
		// $data['id_soal'] = $id_soal;
		// $data['condition'] = $this->input->post('condition');
		// 	$this->db->insert('conditions', $data);
		$this->output_json(['status' => true]);
    }



	public function index()
	{
		$this->akses_mahasiswa();
		$id = $this->input->get('key', true);

		$soal 		= $this->ujian->getSoal($id);

		$mhs		= $this->mhs;
			$i = 0;
			foreach ($soal as $s) {
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
				$soal_per->urut_1 			= $s->urut_1;
				$soal_per->urut_2 			= $s->urut_2;
				$soal_per->urut_3 			= $s->urut_3;
				$soal_per->urut_4 			= $s->urut_4;
				$soal_per->urut_5 			= $s->urut_5;
				$soal_per->urut_6 			= $s->urut_6;
				$soal_per->urut_7 			= $s->urut_7;
				$soal_per->urut_8 			= $s->urut_8;
				$soal_per->urut_9 			= $s->urut_9;
				$soal_per->urut_10 			= $s->urut_10;
				$soal_per->urut_11 			= $s->urut_11;
				$soal_per->urut_12 			= $s->urut_12;
				$soal_per->urut_13 			= $s->urut_13;
				$soal_per->urut_14 			= $s->urut_14;
				$soal_per->urut_15 			= $s->urut_15;
				$soal_per->clue_1 			= $s->clue_1;
				$soal_per->clue_2 			= $s->clue_2;
				$soal_per->clue_3 			= $s->clue_3;
				$soal_per->clue_4 			= $s->clue_4;
				$soal_per->clue_5 			= $s->clue_5;
				$soal_per->clue_6 			= $s->clue_6;
				$soal_per->clue_7 			= $s->clue_7;
				$soal_per->clue_8 			= $s->clue_8;
				$soal_per->clue_9 			= $s->clue_9;
				$soal_per->clue_10 			= $s->clue_10;
				$soal_per->clue_11 			= $s->clue_11;
				$soal_per->clue_12 			= $s->clue_12;
				$soal_per->clue_13 			= $s->clue_13;
				$soal_per->clue_14 			= $s->clue_14;
				$soal_per->clue_15 			= $s->clue_15;
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



		$arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j","k","l","m","n","o");
		$arr_clue = array(1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
		$var_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		$jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		shuffle($var_opsi);
		shuffle($jenis_opsi);
		$var_count = 8;
		$jenis_count = 8;
		$html = '';
		$no = 1;
		// if (!empty($soal_urut_ok)) {
			foreach ($soal_urut_ok as $s) {
				$path = 'uploads/bank_soal/';
				$html .= '<input type="hidden" id="id_soal" name="id_soal_' . $no . '" value="' . $s->id_soal . '">';
				$html .= '<input type="hidden" id="id_user" name="user-id" value="' . $mhs->id_mahasiswa . '">';
				$html .= '<input type="hidden" name="rg_' . $no . '" id="rg_' . $no . '" value="r">';
				$html .= '<div class="step" id="widget_' . $no . '">';
				$html .= '<main class="quiz">
				<div class="quiz__description description">
			
					<p class="description__question">';
				$html .= '<div class="text-center"><div class="w-25"></div></div>' . $s->soal . '<div class="funkyradio"></p>';
				$html .= '<div class="description__data-type data-type">
				<h4 class="data-type__title">Tipe Data</h4>
				<ul class="data-type__items">';
				for ($i=0; $i < $var_count; $i++) { 
					$var = "jenis_data_v".$var_opsi[$i];
					!empty($s->$var) ? $html .= '<li class="data-type__item draggable" id="opsi_jenis_'.$var_opsi[$i].'">'.$s->$var.'</li>' : '';
				}
				$html .= '</ul>
			</div>';
				$html .= '<div class="description__algorithm algorithm">
						<h4 class="algorithm__title">Algoritma</h4>
						<ul class="algorithm__items">';
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
							
							!empty($s->$opsi) ? $html .= '<li class="algorithm__item draggable dsdsd" id="opsi_' . strtolower($arr_opsi[$j]) . '">'. $pilihan_opsi .'</li>' : '';
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
									<th><span>Judul</span></th>
									<td>'.$s->judul.'</td>
								</tr>
								<tr>
									<th><span>Deklarasi</span></th>
									<td>
										<table>
											<tbody>';
											for ($i=0; $i < $jenis_count; $i++) { 
												$var = "variable_".$jenis_opsi[$i];
												!empty($s->$var) ? $html .= '<tr><th>'.$s->$var.'</th><td class="drop-zone" id="jenis_'.$jenis_opsi[$i].'"></td>
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
									<th rowspan="16"><span>DeskripsiAlgoritma</span></th>
									
								</tr>';
								if ($s->clue_1) {
									$clue = $s->clue_1;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_1) ? $html .= '<tr><td class="drop-zone" id="jawaban_'.$s->urut_1.'"></td></tr>' : '';
								}
								if ($s->clue_2) {
									$clue = $s->clue_2;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_2) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_2.'"></td></tr>' : '';
								}
								if ($s->clue_3) {
									$clue = $s->clue_3;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_3) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_3.'"></td></tr>' : '';
								}
								if ($s->clue_4) {
									$clue = $s->clue_4;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_4) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_4.'"></td></tr>' : '';
								}
								if ($s->clue_5) {
									$clue = $s->clue_5;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_5) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_5.'"></td></tr>' : '';
								}

								if ($s->clue_6) {
									$clue = $s->clue_6;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_6) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_6.'"></td></tr>' : '';
								}

								if ($s->clue_7) {
									$clue = $s->clue_7;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_7) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_7.'"></td></tr>' : '';
								}

								if ($s->clue_8) {
									$clue = $s->clue_8;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_8) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_8.'"></td></tr>' : '';
								}

								if ($s->clue_9) {
									$clue = $s->clue_9;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_9) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_9.'"></td></tr>' : '';
								}
								
								if ($s->clue_10) {
									$clue = $s->clue_10;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_10) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_10.'"></td></tr>' : '';
								}
								if ($s->clue_11) {
									$clue = $s->clue_11;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_11) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_11.'"></td></tr>' : '';
								}
								if ($s->clue_12) {
									$clue = $s->clue_12;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_12) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_12.'"></td></tr>' : '';
								}
								if ($s->clue_13) {
									$clue = $s->clue_13;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_13) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_13.'"></td></tr>' : '';
								}
								if ($s->clue_14) {
									$clue = $s->clue_14;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_14) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_14.'"></td></tr>' : '';
								}
								if ($s->clue_15) {
									$clue = $s->clue_15;
									$clue = $s->$clue;
									$clue = "opsi_".$clue;
									$clue = $s->$clue;
									$html .= '<tr><td><span>'.$clue.'</span></td></tr>';
								} else {
									!empty($s->urut_15) ? $html .= '<tr><td class="drop-zone"  id="jawaban_'.$s->urut_15.'"></td></tr>' : '';
								}

							$html .= '</tbody>
						</table>
					</div>
					<!-- ALERT -->
					<div id="success-alert" class="alert" style="display: none;">
						<h4>Jawaban anda benar, silahkan lanjut ke studi kasus berikutnya</h4>
						<img src="'.base_url().'template/images/success.png" alt="success" />
						<button type="button" id="btn_corrects" onclick="return submit_nilai('.$s->id_soal.','.$s->id_level.');" class="btn btn-xs btn-info">close</button>
					</div>
					<div id="fail-alert" class="alert" style="display: none;">
						<h4>Jawaban anda masih salah, silahkan menyusun ulang</h4>
						<img src="'.base_url().'template/images/fail.jpeg" alt="fail" />
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

		$data = [
			'user' 		=> $this->user,
			'mhs'		=> $this->mhs,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Lembar Ujian',
			// 'soal'		=> $detail_tes,
			'no' 		=> $no,
			'html' 		=> $html,
			'id_tes'	=> $id
		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/sheet');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function indexOld()
	{
		$this->akses_mahasiswa();
		$key = $this->input->get('key', true);
		$id  = $this->encryption->decrypt(rawurldecode($key));
		$soal = $this->ujian->getSoalNew($id);

		$soal_urut_ok = $soal;

		$arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j","k","l","m","n","o");
		$html = '';
		$no = 1;
		if (!empty($soal_urut_ok)) {
			foreach ($soal_urut_ok as $s) {
				$path = 'uploads/bank_soal/';
				$html .= '<input type="hidden" name="id_soal_' . $no . '" value="' . $s->id_soal . '">';
				$html .= '<input type="hidden" name="rg_' . $no . '" id="rg_' . $no . '" value="' . $no . '">';
				$html .= '<div class="step" id="widget_' . $no . '">';

				$html .= '<div class="text-center"><div class="w-25"></div></div>' . $s->soal . '<div class="funkyradio">';
				for ($j = 0; $j < $this->config->item('jml_opsi'); $j++) {
					$opsi 			= "opsi_" . $arr_opsi[$j];
					// $file 			= "file_" . $arr_opsi[$j];
					$pilihan_opsi 	= !empty($s->$opsi) ? $s->$opsi : "";
					
					$html .= '<div class="funkyradio-success" onclick="return simpan_sementara();">
						<input type="radio" id="opsi_' . strtolower($arr_opsi[$j]) . '_' . $s->id_soal . '" name="opsi_' . $no . '" value="' . strtoupper($arr_opsi[$j]) . '"> <label for="opsi_' . strtolower($arr_opsi[$j]) . '_' . $s->id_soal . '"><div class="huruf_opsi">' . $arr_opsi[$j] . '</div> <p>' . $pilihan_opsi . '</p><div class="w-25"></div></label></div>';
				}
				$html .= '</div></div>';
				$no++;
			}
		}

		$data = [
			'user' 		=> $this->user,
			'mhs'		=> $this->mhs,
			'judul'		=> 'Ujian',
			'subjudul'	=> 'Lembar Ujian',
			//'soal'		=> $detail_tes,
			'no' 		=> $no,
			'html' 		=> $html
			//'id_tes'	=> $id_tes
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
}