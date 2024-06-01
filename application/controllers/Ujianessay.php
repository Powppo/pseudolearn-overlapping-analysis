<html>
    <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
</html>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujianessay extends CI_Controller
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
		$this->load->model('Essay_model', 'essay');
		$this->load->model('Essay_jawaban_siswa_model', 'jawaban_essay');
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

    public function save_hasil($id)
	{
		// Decrypt Id
		$id_user = $this->session->userdata('user_id');
		$essay = $this->db->query('select * from tb_essay where id_soal = ?', $id)->row_array();
		$hasil_essay = $this->db->query('select * from tb_essay_jawaban_siswa where id_soal = ?', $id)->row_array();
		$data['id_user'] = $id_user;
		$data['id_soal'] = $id;
		$data['nilaiessay'] = $essay['bobot'];
		$cek = $this->db->query('select * from nilai_essay where id_user = ? and id_soal = ?', [$id_user, $id])->num_rows();
		if ($cek == 0) {
			$this->db->insert('nilai_essay', $data);
		}
		$this->output_json(['status' => true]);
	}

	public function essay()
	{
		$this->akses_mahasiswa();
		$id = $this->input->get('key', true);

		$soalessay 	= $this->essay->getEssaySoal($id);

		$tabelsoal = $this->db->query('select * from tb_soal where id_soal = ?', $id)->result();

		$mhs		= $this->mhs;

		$i = 0;
		foreach ($tabelsoal as $tab) {
			$tabelsoal_per = new stdClass();
			$tabelsoal_per->soal 				= $tab->soal;
			$tabelsoal_per->judul 				= $tab->judul;
			$tabelsoal_per->opsi_a 				= $tab->opsi_a;
			$tabelsoal_per->opsi_b 				= $tab->opsi_b;
			$tabelsoal_per->opsi_c 				= $tab->opsi_c;
			$tabelsoal_per->opsi_d 				= $tab->opsi_d;
			$tabelsoal_per->opsi_e 				= $tab->opsi_e;
			$tabelsoal_per->opsi_f 				= $tab->opsi_f;
			$tabelsoal_per->opsi_g 				= $tab->opsi_g;
			$tabelsoal_per->opsi_h 				= $tab->opsi_h;
			$tabelsoal_per->opsi_i 				= $tab->opsi_i;
			$tabelsoal_per->opsi_j 				= $tab->opsi_j;
			$tabelsoal_per->opsi_k 				= $tab->opsi_k;
			$tabelsoal_per->opsi_l 				= $tab->opsi_l;
			$tabelsoal_per->opsi_m 				= $tab->opsi_m;
			$tabelsoal_per->opsi_n 				= $tab->opsi_n;
			$tabelsoal_per->opsi_o 				= $tab->opsi_o;
			$tabelsoal_per->opsi_p 				= $tab->opsi_p;
			$tabelsoal_per->opsi_q 				= $tab->opsi_q;
			$tabelsoal_per->opsi_r 				= $tab->opsi_r;
			$tabelsoal_per->opsi_s 				= $tab->opsi_s;
			$tabelsoal_per->opsi_t 				= $tab->opsi_t;
			$tabelsoal_per->opsi_u 				= $tab->opsi_u;
			$tabelsoal_per->opsi_v 				= $tab->opsi_v;
			$tabelsoal_per->opsi_w 				= $tab->opsi_w;
			$tabelsoal_per->opsi_x 				= $tab->opsi_x;
			$tabelsoal_per->opsi_y 				= $tab->opsi_y;
			$tabelsoal_per->opsi_z 				= $tab->opsi_z;
			$tabelsoal_per->urut_a 				= $tab->urut_a;
			$tabelsoal_per->urut_b 				= $tab->urut_b;
			$tabelsoal_per->urut_c 				= $tab->urut_c;
			$tabelsoal_per->urut_d 				= $tab->urut_d;
			$tabelsoal_per->urut_e 				= $tab->urut_e;
			$tabelsoal_per->urut_f 				= $tab->urut_f;
			$tabelsoal_per->urut_g 				= $tab->urut_g;
			$tabelsoal_per->urut_h 				= $tab->urut_h;
			$tabelsoal_per->urut_i 				= $tab->urut_i;
			$tabelsoal_per->urut_j 				= $tab->urut_j;
			$tabelsoal_per->urut_k 				= $tab->urut_k;
			$tabelsoal_per->urut_l 				= $tab->urut_l;
			$tabelsoal_per->urut_m 				= $tab->urut_m;
			$tabelsoal_per->urut_n 				= $tab->urut_n;
			$tabelsoal_per->urut_o 				= $tab->urut_o;
			$tabelsoal_per->urut_p 				= $tab->urut_p;
			$tabelsoal_per->urut_q 				= $tab->urut_q;
			$tabelsoal_per->urut_r 				= $tab->urut_r;
			$tabelsoal_per->urut_s 				= $tab->urut_s;
			$tabelsoal_per->urut_t 				= $tab->urut_t;
			$tabelsoal_per->urut_u 				= $tab->urut_u;
			$tabelsoal_per->urut_v 				= $tab->urut_v;
			$tabelsoal_per->urut_w 				= $tab->urut_w;
			$tabelsoal_per->urut_x 				= $tab->urut_x;
			$tabelsoal_per->urut_y 				= $tab->urut_y;
			$tabelsoal_per->urut_z 				= $tab->urut_z;
			$tabelsoal_per->clue_a 				= $tab->clue_a;
			$tabelsoal_per->clue_b 				= $tab->clue_b;
			$tabelsoal_per->clue_c 				= $tab->clue_c;
			$tabelsoal_per->clue_d 				= $tab->clue_d;
			$tabelsoal_per->clue_e 				= $tab->clue_e;
			$tabelsoal_per->clue_f 				= $tab->clue_f;
			$tabelsoal_per->clue_g 				= $tab->clue_g;
			$tabelsoal_per->clue_h 				= $tab->clue_h;
			$tabelsoal_per->clue_i 				= $tab->clue_i;
			$tabelsoal_per->clue_j 				= $tab->clue_j;
			$tabelsoal_per->clue_k 				= $tab->clue_k;
			$tabelsoal_per->clue_l 				= $tab->clue_l;
			$tabelsoal_per->clue_m 				= $tab->clue_m;
			$tabelsoal_per->clue_n 				= $tab->clue_n;
			$tabelsoal_per->clue_o 				= $tab->clue_o;
			$tabelsoal_per->clue_p 				= $tab->clue_p;
			$tabelsoal_per->clue_q 				= $tab->clue_q;
			$tabelsoal_per->clue_r 				= $tab->clue_r;
			$tabelsoal_per->clue_s 				= $tab->clue_s;
			$tabelsoal_per->clue_t 				= $tab->clue_t;
			$tabelsoal_per->clue_u 				= $tab->clue_u;
			$tabelsoal_per->clue_v 				= $tab->clue_v;
			$tabelsoal_per->clue_w 				= $tab->clue_w;
			$tabelsoal_per->clue_x 				= $tab->clue_x;
			$tabelsoal_per->clue_y 				= $tab->clue_y;
			$tabelsoal_per->clue_z 				= $tab->clue_z;
			$tabelsoal_per->variable_1 			= $tab->variable_1;
			$tabelsoal_per->variable_2 			= $tab->variable_2;
			$tabelsoal_per->variable_3 			= $tab->variable_3;
			$tabelsoal_per->variable_4 			= $tab->variable_4;
			$tabelsoal_per->variable_5 			= $tab->variable_5;
			$tabelsoal_per->variable_6 			= $tab->variable_6;
			$tabelsoal_per->variable_7 			= $tab->variable_7;
			$tabelsoal_per->variable_8 			= $tab->variable_8;
			$tabelsoal_per->jenis_data_v1 		= $tab->jenis_data_v1;
			$tabelsoal_per->jenis_data_v2 		= $tab->jenis_data_v2;
			$tabelsoal_per->jenis_data_v3 		= $tab->jenis_data_v3;
			$tabelsoal_per->jenis_data_v4 		= $tab->jenis_data_v4;
			$tabelsoal_per->jenis_data_v5 		= $tab->jenis_data_v5;
			$tabelsoal_per->jenis_data_v6 		= $tab->jenis_data_v6;
			$tabelsoal_per->jenis_data_v7 		= $tab->jenis_data_v7;
			$tabelsoal_per->jenis_data_v8 		= $tab->jenis_data_v8;
			$tabelsoal_ok[$i] = $tabelsoal_per;
		}

		$i = 0;
		foreach ($soalessay as $s) {
			$soalessay_per = new stdClass();
			$soalessay_per->id_essay 		= $s->id_essay;
			$soalessay_per->id_level 		= $s->id_level;
			$soalessay_per->id_soal			= $s->id_soal;
			$soalessay_per->urutan_nomor_1	= $s->urutan_nomor_1;
			$soalessay_per->urutan_nomor_2	= $s->urutan_nomor_2;
			$soalessay_per->urutan_nomor_3	= $s->urutan_nomor_3;
			$soalessay_per->urutan_nomor_4	= $s->urutan_nomor_4;
			$soalessay_per->urutan_nomor_5	= $s->urutan_nomor_5;
			$soalessay_per->urutan_nomor_6	= $s->urutan_nomor_6;
			$soalessay_per->urutan_nomor_7	= $s->urutan_nomor_7;
			$soalessay_per->urutan_nomor_8	= $s->urutan_nomor_8;
			$soalessay_per->urutan_nomor_a	= $s->urutan_nomor_a;
			$soalessay_per->urutan_nomor_b	= $s->urutan_nomor_b;
			$soalessay_per->urutan_nomor_c	= $s->urutan_nomor_c;
			$soalessay_per->urutan_nomor_d	= $s->urutan_nomor_d;
			$soalessay_per->urutan_nomor_e	= $s->urutan_nomor_e;
			$soalessay_per->urutan_nomor_f	= $s->urutan_nomor_f;
			$soalessay_per->urutan_nomor_g	= $s->urutan_nomor_g;
			$soalessay_per->urutan_nomor_h	= $s->urutan_nomor_h;
			$soalessay_per->urutan_nomor_i	= $s->urutan_nomor_i;
			$soalessay_per->urutan_nomor_j	= $s->urutan_nomor_j;
			$soalessay_per->urutan_nomor_k	= $s->urutan_nomor_k;
			$soalessay_per->urutan_nomor_l	= $s->urutan_nomor_l;
			$soalessay_per->urutan_nomor_m	= $s->urutan_nomor_m;
			$soalessay_per->urutan_nomor_n	= $s->urutan_nomor_n;
			$soalessay_per->urutan_nomor_o	= $s->urutan_nomor_o;
			$soalessay_per->urutan_nomor_p	= $s->urutan_nomor_p;
			$soalessay_per->urutan_nomor_q	= $s->urutan_nomor_q;
			$soalessay_per->urutan_nomor_r	= $s->urutan_nomor_r;
			$soalessay_per->urutan_nomor_s	= $s->urutan_nomor_s;
			$soalessay_per->urutan_nomor_t	= $s->urutan_nomor_t;
			$soalessay_per->urutan_nomor_u	= $s->urutan_nomor_u;
			$soalessay_per->urutan_nomor_v	= $s->urutan_nomor_v;
			$soalessay_per->urutan_nomor_w	= $s->urutan_nomor_w;
			$soalessay_per->urutan_nomor_x	= $s->urutan_nomor_x;
			$soalessay_per->urutan_nomor_y	= $s->urutan_nomor_y;
			$soalessay_per->urutan_nomor_z	= $s->urutan_nomor_z;
			$soalessay_per->bobot			= $s->bobot;
			$soalessay_per->jawaban_1 		= $s->jawaban_1;
			$soalessay_per->jawaban_2 		= $s->jawaban_2;
			$soalessay_per->jawaban_3 		= $s->jawaban_3;
			$soalessay_per->jawaban_4 		= $s->jawaban_4;
			$soalessay_per->jawaban_5 		= $s->jawaban_5;
			$soalessay_per->jawaban_6 		= $s->jawaban_6;
			$soalessay_per->jawaban_7 		= $s->jawaban_7;
			$soalessay_per->jawaban_8 		= $s->jawaban_8;
			$soalessay_per->jawaban_a 		= $s->jawaban_a;
			$soalessay_per->jawaban_b 		= $s->jawaban_b;
			$soalessay_per->jawaban_c 		= $s->jawaban_c;
			$soalessay_per->jawaban_d 		= $s->jawaban_d;
			$soalessay_per->jawaban_e 		= $s->jawaban_e;
			$soalessay_per->jawaban_f 		= $s->jawaban_f;
			$soalessay_per->jawaban_g 		= $s->jawaban_g;
			$soalessay_per->jawaban_h 		= $s->jawaban_h;
			$soalessay_per->jawaban_i 		= $s->jawaban_i;
			$soalessay_per->jawaban_j 		= $s->jawaban_j;
			$soalessay_per->jawaban_k 		= $s->jawaban_k;
			$soalessay_per->jawaban_l 		= $s->jawaban_l;
			$soalessay_per->jawaban_m 		= $s->jawaban_m;
			$soalessay_per->jawaban_n 		= $s->jawaban_n;
			$soalessay_per->jawaban_o 		= $s->jawaban_o;
			$soalessay_per->jawaban_p 		= $s->jawaban_p;
			$soalessay_per->jawaban_q 		= $s->jawaban_q;
			$soalessay_per->jawaban_r 		= $s->jawaban_r;
			$soalessay_per->jawaban_s 		= $s->jawaban_s;
			$soalessay_per->jawaban_t 		= $s->jawaban_t;
			$soalessay_per->jawaban_u 		= $s->jawaban_u;
			$soalessay_per->jawaban_v 		= $s->jawaban_v;
			$soalessay_per->jawaban_w 		= $s->jawaban_w;
			$soalessay_per->jawaban_x 		= $s->jawaban_x;
			$soalessay_per->jawaban_y 		= $s->jawaban_y;
			$soalessay_per->jawaban_z 		= $s->jawaban_z;
			$soalessay_per->output			= $s->output;
			$soalessay_per->jenis_program	= $s->jenis_program;
			$soalessay_urut[$i] = $soalessay_per;
			$i++;
		}

		$arr_jawaban = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o","p","q","r","s","t","u","v","w","x","y","z");
		$arr_opsi = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o","p","q","r","s","t","u","v","w","x","y","z");
		$arr_urut = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o","p","q","r","s","t","u","v","w","x","y","z");
		$arr_clue = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o","p","q","r","s","t","u","v","w","x","y","z");
		$var_jawaban = array(1, 2, 3, 4, 5, 6, 7, 8);
		// $arr_clue = array(1,2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27);
		$var_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		$var_urut = array(1, 2, 3, 4, 5, 6, 7, 8);
		$jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		$jenis_opsi = array(1, 2, 3, 4, 5, 6, 7, 8);
		$var_count = 8;
		$variabel_count = 8;
		$jenis_count = 8;
		$html = '';
		$soalDigunakan = '';

		$no = 1;

		foreach ($soalessay_urut as $essay) {
			$path = 'uploads/bank_soal/';
			$html .= '<input type="hidden" id="id_soal" name="id_soal" value="' . $essay->id_soal . '">';
			$html .= '<input type="hidden" id="id_level" name="id_level" value="' . $essay->id_level . '">';
			$html .= '<input type="hidden" id="id_essay" name="id_essay" value="' . $essay->id_essay . '">';
			$html .= '<input type="hidden" id="id_user" name="user-id" value="' . $mhs->id_mahasiswa . '">';
			$html .= '<input type="hidden" name="rg_' . $no . '" id="rg_' . $no . '" value="r">';
			$html .= '<div class="step" id="widget_' . $no . '">';
			$idessay = $essay->id_essay;
			
		}
		
		$nomer = 1;
		foreach ($tabelsoal_ok as $soal) {
			$html .= '<div style="width: 100%; width: 39%">
								<table class="answer1__content">
									<tbody>
										<tr>
											<th><span>Judul </span></th>
											<td style="font-size: 20px;">'.$soal->judul.'</td>
										</tr>
									</tbody>
								</table>
						</div>';
			$html .= '<div class="description__data-type data-type" style="margin: 15px; margin-left: -1px; width: 39%;">
			<h4 class="data-type__title">Tipe Data</h4>
			<ul class="data-type__items" style= "display: flex; flex-direction: column;">';
			for ($i=0; $i < $jenis_count; $i++) { 
					$jd = "jenis_data_v".$var_opsi[$i];
					$var = "variable_".$var_opsi[$i];
					if (!empty($soal->$var)) {
						$html .= '<li class="data-type__item draggable" id="opsi_jenis_'.$var_opsi[$i].'">'.$nomer .'. '.$soal->$var. " = " .$soal->$jd.'</li>';
						$nomer++;
					} else {
						$html .= '';
					}
				}
				$html .= '</ul>
			</div>';

		$html .= '<main class="quiz">
		<div class="quiz__description description">';
			$kata = $soal->soal;
			$hapus = array("<p>", "</p>");
			$hasil = str_replace($hapus, "", $kata);
			$soalDigunakan .= $hasil;
			$html .= '<div class="text-center"><div class="w-25"></div></div><div class="funkyradio" style="margin-left: -20px;">';

			$html .= '<div class="description__algorithm algorithm">
						<h4 class="algorithm__title">Urutan Pseudocode</h4>
						<ul style= "display: flex; flex-direction: column;">';
					// for ($j = 0; $j < $this->config->item('jml_pseudo'); $j++) {
					// $pseudo = "pseudo_" . $arr_pseudo[$j];
					// 	if (!in_array($pseudo, $arr_pseudo)) {
					// 		$pilihan_pseudo 	= !empty($essay->$pseudo) ? $essay->$pseudo : "";
							
					// 		!empty($essay->$pseudo) ? $html .= '<li class="algorithm__item draggable dsdsd" id="pseudo_' . strtolower($arr_pseudo[$j]) . '">'. strtoupper($arr_pseudo[$j]) . "." . " " . $pilihan_pseudo .'</li>' : '';
					// 	}		
					// }
					
					if ($soal->urut_a) {
						$urut = "opsi_".$soal->urut_a;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '.$hasilKata.'</li>';
							$nomer++;
						}
					}
					if ($soal->urut_b) {
						$urut = "opsi_".$soal->urut_b;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_c) {
						$urut = "opsi_".$soal->urut_c;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>' || $value == '<p>ENDIF</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_d) {
						$urut = "opsi_".$soal->urut_d;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_e) {
						$urut = "opsi_".$soal->urut_e;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_f) {
						$urut = "opsi_".$soal->urut_f;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.". ". $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_g) {
						$urut = "opsi_".$soal->urut_g;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}
					}
					if ($soal->urut_h) {
						$urut = "opsi_".$soal->urut_h;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_i) {
						$urut = "opsi_".$soal->urut_i;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_j) {
						$urut = "opsi_".$soal->urut_j;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_k) {
						$urut = "opsi_".$soal->urut_k;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_l) {
						$urut = "opsi_".$soal->urut_l;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_m) {
						$urut = "opsi_".$soal->urut_m;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_n) {
						$urut = "opsi_".$soal->urut_n;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_o) {
						$urut = "opsi_".$soal->urut_o;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_p) {
						$urut = "opsi_".$soal->urut_p;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_q) {
						$urut = "opsi_".$soal->urut_q;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_r) {
						$urut = "opsi_".$soal->urut_r;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_s) {
						$urut = "opsi_".$soal->urut_s;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_t) {
						$urut = "opsi_".$soal->urut_t;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_u) {
						$urut = "opsi_".$soal->urut_u;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_v) {
						$urut = "opsi_".$soal->urut_v;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_w) {
						$urut = "opsi_".$soal->urut_w;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_x) {
						$urut = "opsi_".$soal->urut_x;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_y) {
						$urut = "opsi_".$soal->urut_y;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
					if ($soal->urut_z) {
						$urut = "opsi_".$soal->urut_z;
						$value = $soal->$urut;
						$kata = $soal->$urut;
						$hapusKata = array("<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $kata);
						if ($value == '<p>START</p>' || $value == '<p>END</p>') {
							$html .= '';
						} else {
							$html .= '<li class="algorithm__item draggable dsdsd">'.$nomer.'. '. $hasilKata .'</li>';
							$nomer++;
						}	
					}
		}
		
		foreach ($tabelsoal_ok as $tb_soal) {
			# code...
			$html .= 
            '</ul></div>
			</div>
            </div>
			<div class="quiz__answer answer">';
				// <table class="answer__content">
				// 	<tbody>
				// 		<tr>
				// 			<th><span>Judul</span></th>
				// 			<td>'.$tb_soal->judul.'</td>
				// 		</tr>
				// 		<tr>
				// 			<th><span>Jenis Data</span></th>
				// 			<td>
				// 				<table>
				// 					<tbody>';
				// 					for ($i=0; $i <p $jenis_count; $i++) { 
				// 								$var = "variable_".$jenis_opsi[$i];
                //                                 $jd = "jenis_data_v".$var_opsi[$i];
				// 								!empty($tb_soal->$var) ? $html .= '<tr><th>'.$tb_soal->$var.'</th><td>'. '<p>' . $tb_soal->$jd . '</p>' .'</td>
				// 							</tr>' : '';
				// 							}
				// 					$html .= '</>
				// 				</table>
				// 			</td>
				// 		</tr>
				// 	</tbody>
				// </table>';
		}
					foreach ($tabelsoal_ok as $tb_soal) {
						$text = $tb_soal->judul;
						$hapusKata = array("program", "<p>", "</p>");
						$hasilKata = str_replace($hapusKata, "", $text);
					}
					
					$html .= '
					<div style="margin-top: -225px">
					<table class="answer__content">
					<tbody>
					<tr>
					<th rowspan=""><span>Kode Program</span></th>
					</tr>
					<tr><td>';

					foreach ($soalessay_urut as $essay) {
					if ($essay->jenis_program == 0) {
						$html .= '';
						if ($essay->jawaban_1) {
							!empty($essay->jawaban_1) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_1.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_1" maxlength="'.strlen($essay->jawaban_1).'"><input type="hidden" id="jawaban_1" value="'. $essay->jawaban_1 .'"><input type="hidden" id="nilai_1" name="nilai_1" value=""></div>' : '';
								
						}
						if ($essay->jawaban_2) {
							!empty($essay->jawaban_2) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_2.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_2" maxlength="'.strlen($essay->jawaban_2).'"><input type="hidden" id="jawaban_2" value="'. $essay->jawaban_2 .'"><input type="hidden" id="nilai_2" name="nilai_2" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_3) {
							!empty($essay->jawaban_3) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_3.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_3" maxlength="'.strlen($essay->jawaban_3).'"><input type="hidden" id="jawaban_3" value="'. $essay->jawaban_3 .'"><input type="hidden" id="nilai_3" name="nilai_3" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_4) {
							!empty($essay->jawaban_4) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_4.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_4" maxlength="'.strlen($essay->jawaban_4).'"><input type="hidden" id="jawaban_4" value="'. $essay->jawaban_4 .'"><input type="hidden" id="nilai_4" name="nilai_4" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_5) {
							!empty($essay->jawaban_5) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_5.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_5" maxlength="'.strlen($essay->jawaban_5).'"><input type="hidden" id="jawaban_5" value="'. $essay->jawaban_5 .'"><input type="hidden" id="nilai_5" name="nilai_5" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_6) {
							!empty($essay->jawaban_6) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_6.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_6" maxlength="'.strlen($essay->jawaban_6).'"><input type="hidden" id="jawaban_6" value="'. $essay->jawaban_6 .'"><input type="hidden" id="nilai_6" name="nilai_6" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_7) {
							!empty($essay->jawaban_7) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_7.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_7" maxlength="'.strlen($essay->jawaban_7).'"><input type="hidden" id="jawaban_7" value="'. $essay->jawaban_7 .'"><input type="hidden" id="nilai_7" name="nilai_7" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_8) {
							!empty($essay->jawaban_8) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_8.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_8" maxlength="'.strlen($essay->jawaban_8).'"><input type="hidden" id="jawaban_8" value="'. $essay->jawaban_8 .'"><input type="hidden" id="nilai_8" name="nilai_8" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_a) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_a, $kataCek) == FALSE) {
								!empty($essay->jawaban_a) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_a.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_a" maxlength="'.strlen($essay->jawaban_a).'"><input type="hidden" id="jawaban_a" value="'. htmlentities($essay->jawaban_a) .'"><input type="hidden" id="nilai_a" name="nilai_a" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_a, $kataCek) !== FALSE) {
								!empty($essay->jawaban_a) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_a.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_a" maxlength="'.strlen($essay->jawaban_a).'"><input type="hidden" id="jawaban_a" value="'. html_entity_decode($essay->jawaban_a) .'"><input type="hidden" id="nilai_a" name="nilai_a" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_b) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_b, $kataCek) == FALSE) {
								!empty($essay->jawaban_b) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_b.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_b" maxlength="'.strlen($essay->jawaban_b).'"><input type="hidden" id="jawaban_b" value="'. htmlentities($essay->jawaban_b) .'"><input type="hidden" id="nilai_b" name="nilai_b" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_b, $kataCek) !== FALSE) {
								!empty($essay->jawaban_b) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_b.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_b" maxlength="'.strlen($essay->jawaban_b).'"><input type="hidden" id="jawaban_b" value="'. html_entity_decode($essay->jawaban_b) .'"><input type="hidden" id="nilai_b" name="nilai_b" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_c) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_c, $kataCek) == FALSE) {
								!empty($essay->jawaban_c) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_c.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_c" maxlength="'.strlen($essay->jawaban_c).'"><input type="hidden" id="jawaban_c" value="'. htmlentities($essay->jawaban_c) .'"><input type="hidden" id="nilai_c" name="nilai_c" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_c, $kataCek) !== FALSE) {
								!empty($essay->jawaban_c) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_c.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_c" maxlength="'.strlen($essay->jawaban_c).'"><input type="hidden" id="jawaban_c" value="'. html_entity_decode($essay->jawaban_c) .'"><input type="hidden" id="nilai_c" name="nilai_c" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_d) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_d, $kataCek) == FALSE) {
								!empty($essay->jawaban_d) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_d.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_d" maxlength="'.strlen($essay->jawaban_d).'"><input type="hidden" id="jawaban_d" value="'. htmlentities($essay->jawaban_d) .'"><input type="hidden" id="nilai_d" name="nilai_d" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_d, $kataCek) !== FALSE) {
								!empty($essay->jawaban_d) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_d.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_d" maxlength="'.strlen($essay->jawaban_d).'"><input type="hidden" id="jawaban_d" value="'. html_entity_decode($essay->jawaban_d) .'"><input type="hidden" id="nilai_d" name="nilai_d" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_e) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_e, $kataCek) == FALSE) {
								!empty($essay->jawaban_e) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_e.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_e" maxlength="'.strlen($essay->jawaban_e).'"><input type="hidden" id="jawaban_e" value="'. htmlentities($essay->jawaban_e) .'"><input type="hidden" id="nilai_e" name="nilai_e" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_e, $kataCek) !== FALSE) {
								!empty($essay->jawaban_e) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_e.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_e" maxlength="'.strlen($essay->jawaban_e).'"><input type="hidden" id="jawaban_e" value="'. html_entity_decode($essay->jawaban_e) .'"><input type="hidden" id="nilai_e" name="nilai_e" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_f) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_f, $kataCek) == FALSE) {
								!empty($essay->jawaban_f) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_f.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_f" maxlength="'.strlen($essay->jawaban_f).'"><input type="hidden" id="jawaban_f" value="'. htmlentities($essay->jawaban_f) .'"><input type="hidden" id="nilai_f" name="nilai_f" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_f, $kataCek) !== FALSE) {
								!empty($essay->jawaban_f) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_f.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_f" maxlength="'.strlen($essay->jawaban_f).'"><input type="hidden" id="jawaban_f" value="'. html_entity_decode($essay->jawaban_f) .'"><input type="hidden" id="nilai_f" name="nilai_f" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_g) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_g, $kataCek) == FALSE) {
								!empty($essay->jawaban_g) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_g.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_g" maxlength="'.strlen($essay->jawaban_g).'"><input type="hidden" id="jawaban_g" value="'. htmlentities($essay->jawaban_g) .'"><input type="hidden" id="nilai_g" name="nilai_g" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_g, $kataCek) !== FALSE) {
								!empty($essay->jawaban_g) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_g.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_g" maxlength="'.strlen($essay->jawaban_g).'"><input type="hidden" id="jawaban_g" value="'. html_entity_decode($essay->jawaban_g) .'"><input type="hidden" id="nilai_g" name="nilai_g" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_h) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_h, $kataCek) == FALSE) {
								!empty($essay->jawaban_h) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_h.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_h" maxlength="'.strlen($essay->jawaban_h).'"><input type="hidden" id="jawaban_h" value="'. htmlentities($essay->jawaban_h) .'"><input type="hidden" id="nilai_h" name="nilai_h" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_h, $kataCek) !== FALSE) {
								!empty($essay->jawaban_h) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_h.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_h" maxlength="'.strlen($essay->jawaban_h).'"><input type="hidden" id="jawaban_h" value="'. html_entity_decode($essay->jawaban_h) .'"><input type="hidden" id="nilai_h" name="nilai_h" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_i) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_i, $kataCek) == FALSE) {
								!empty($essay->jawaban_i) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_i.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_i" maxlength="'.strlen($essay->jawaban_i).'"><input type="hidden" id="jawaban_i" value="'. htmlentities($essay->jawaban_i) .'"><input type="hidden" id="nilai_i" name="nilai_i" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_i, $kataCek) !== FALSE) {
								!empty($essay->jawaban_i) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_i.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_i" maxlength="'.strlen($essay->jawaban_i).'"><input type="hidden" id="jawaban_i" value="'. html_entity_decode($essay->jawaban_i) .'"><input type="hidden" id="nilai_i" name="nilai_i" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_j) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_j, $kataCek) == FALSE) {
								!empty($essay->jawaban_j) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_j.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_j" maxlength="'.strlen($essay->jawaban_j).'"><input type="hidden" id="jawaban_j" value="'. htmlentities($essay->jawaban_j) .'"><input type="hidden" id="nilai_j" name="nilai_j" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_j, $kataCek) !== FALSE) {
								!empty($essay->jawaban_j) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_j.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_j" maxlength="'.strlen($essay->jawaban_j).'"><input type="hidden" id="jawaban_j" value="'. html_entity_decode($essay->jawaban_j) .'"><input type="hidden" id="nilai_j" name="nilai_j" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_k) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_k, $kataCek) == FALSE) {
								!empty($essay->jawaban_k) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_k.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_k" maxlength="'.strlen($essay->jawaban_k).'"><input type="hidden" id="jawaban_k" value="'. htmlentities($essay->jawaban_k) .'"><input type="hidden" id="nilai_k" name="nilai_k" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_k, $kataCek) !== FALSE) {
								!empty($essay->jawaban_k) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_k.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_k" maxlength="'.strlen($essay->jawaban_k).'"><input type="hidden" id="jawaban_k" value="'. html_entity_decode($essay->jawaban_k) .'"><input type="hidden" id="nilai_k" name="nilai_k" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_l) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_l, $kataCek) == FALSE) {
								!empty($essay->jawaban_l) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_l.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_l" maxlength="'.strlen($essay->jawaban_l).'"><input type="hidden" id="jawaban_l" value="'. htmlentities($essay->jawaban_l) .'"><input type="hidden" id="nilai_l" name="nilai_l" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_l, $kataCek) !== FALSE) {
								!empty($essay->jawaban_l) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_l.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_l" maxlength="'.strlen($essay->jawaban_l).'"><input type="hidden" id="jawaban_l" value="'. html_entity_decode($essay->jawaban_l) .'"><input type="hidden" id="nilai_l" name="nilai_l" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_m) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_m, $kataCek) == FALSE) {
								!empty($essay->jawaban_m) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_m.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_m" maxlength="'.strlen($essay->jawaban_m).'"><input type="hidden" id="jawaban_m" value="'. htmlentities($essay->jawaban_m) .'"><input type="hidden" id="nilai_m" name="nilai_m" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_m, $kataCek) !== FALSE) {
								!empty($essay->jawaban_m) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_m.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_m" maxlength="'.strlen($essay->jawaban_m).'"><input type="hidden" id="jawaban_m" value="'. html_entity_decode($essay->jawaban_m) .'"><input type="hidden" id="nilai_m" name="nilai_m" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_n) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_n, $kataCek) == FALSE) {
								!empty($essay->jawaban_n) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_n.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_n" maxlength="'.strlen($essay->jawaban_n).'"><input type="hidden" id="jawaban_n" value="'. htmlentities($essay->jawaban_n) .'"><input type="hidden" id="nilai_n" name="nilai_n" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_n, $kataCek) !== FALSE) {
								!empty($essay->jawaban_n) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_n.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_n" maxlength="'.strlen($essay->jawaban_n).'"><input type="hidden" id="jawaban_n" value="'. html_entity_decode($essay->jawaban_n) .'"><input type="hidden" id="nilai_n" name="nilai_n" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_o) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_o, $kataCek) == FALSE) {
								!empty($essay->jawaban_o) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_o.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_o" maxlength="'.strlen($essay->jawaban_o).'"><input type="hidden" id="jawaban_o" value="'. htmlentities($essay->jawaban_o) .'"><input type="hidden" id="nilai_o" name="nilai_o" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_o, $kataCek) !== FALSE) {
								!empty($essay->jawaban_o) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_o.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_o" maxlength="'.strlen($essay->jawaban_o).'"><input type="hidden" id="jawaban_o" value="'. html_entity_decode($essay->jawaban_o) .'"><input type="hidden" id="nilai_o" name="nilai_o" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_p) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_p, $kataCek) == FALSE) {
								!empty($essay->jawaban_p) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_p.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_p" maxlength="'.strlen($essay->jawaban_p).'"><input type="hidden" id="jawaban_p" value="'. htmlentities($essay->jawaban_p) .'"><input type="hidden" id="nilai_p" name="nilai_p" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_p, $kataCek) !== FALSE) {
								!empty($essay->jawaban_p) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_p.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_p" maxlength="'.strlen($essay->jawaban_p).'"><input type="hidden" id="jawaban_p" value="'. html_entity_decode($essay->jawaban_p) .'"><input type="hidden" id="nilai_p" name="nilai_p" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_q) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_q, $kataCek) == FALSE) {
								!empty($essay->jawaban_q) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_q.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_q" maxlength="'.strlen($essay->jawaban_q).'"><input type="hidden" id="jawaban_q" value="'. htmlentities($essay->jawaban_q) .'"><input type="hidden" id="nilai_q" name="nilai_q" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_q, $kataCek) !== FALSE) {
								!empty($essay->jawaban_q) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_q.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_q" maxlength="'.strlen($essay->jawaban_q).'"><input type="hidden" id="jawaban_q" value="'. html_entity_decode($essay->jawaban_q) .'"><input type="hidden" id="nilai_q" name="nilai_q" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_r) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_r, $kataCek) == FALSE) {
								!empty($essay->jawaban_r) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_r.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_r" maxlength="'.strlen($essay->jawaban_r).'"><input type="hidden" id="jawaban_r" value="'. htmlentities($essay->jawaban_r) .'"><input type="hidden" id="nilai_r" name="nilai_r" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_r, $kataCek) !== FALSE) {
								!empty($essay->jawaban_r) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_r.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_r" maxlength="'.strlen($essay->jawaban_r).'"><input type="hidden" id="jawaban_r" value="'. html_entity_decode($essay->jawaban_r) .'"><input type="hidden" id="nilai_r" name="nilai_r" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_s) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_s, $kataCek) == FALSE) {
								!empty($essay->jawaban_s) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_s.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_s" maxlength="'.strlen($essay->jawaban_s).'"><input type="hidden" id="jawaban_s" value="'. htmlentities($essay->jawaban_s) .'"><input type="hidden" id="nilai_s" name="nilai_s" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_s, $kataCek) !== FALSE) {
								!empty($essay->jawaban_s) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_s.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_s" maxlength="'.strlen($essay->jawaban_s).'"><input type="hidden" id="jawaban_s" value="'. html_entity_decode($essay->jawaban_s) .'"><input type="hidden" id="nilai_s" name="nilai_s" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_t) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_t, $kataCek) == FALSE) {
								!empty($essay->jawaban_t) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_t.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_t" maxlength="'.strlen($essay->jawaban_t).'"><input type="hidden" id="jawaban_t" value="'. htmlentities($essay->jawaban_t) .'"><input type="hidden" id="nilai_t" name="nilai_t" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_t, $kataCek) !== FALSE) {
								!empty($essay->jawaban_t) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_t.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_t" maxlength="'.strlen($essay->jawaban_t).'"><input type="hidden" id="jawaban_t" value="'. html_entity_decode($essay->jawaban_t) .'"><input type="hidden" id="nilai_t" name="nilai_t" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_u) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_u, $kataCek) == FALSE) {
								!empty($essay->jawaban_u) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_u.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_u" maxlength="'.strlen($essay->jawaban_u).'"><input type="hidden" id="jawaban_u" value="'. htmlentities($essay->jawaban_u) .'"><input type="hidden" id="nilai_u" name="nilai_u" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_u, $kataCek) !== FALSE) {
								!empty($essay->jawaban_u) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_u.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_u" maxlength="'.strlen($essay->jawaban_u).'"><input type="hidden" id="jawaban_u" value="'. html_entity_decode($essay->jawaban_u) .'"><input type="hidden" id="nilai_u" name="nilai_u" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_v) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_v, $kataCek) == FALSE) {
								!empty($essay->jawaban_v) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_v.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_v" maxlength="'.strlen($essay->jawaban_v).'"><input type="hidden" id="jawaban_v" value="'. htmlentities($essay->jawaban_v) .'"><input type="hidden" id="nilai_v" name="nilai_v" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_v, $kataCek) !== FALSE) {
								!empty($essay->jawaban_v) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_v.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_v" maxlength="'.strlen($essay->jawaban_v).'"><input type="hidden" id="jawaban_v" value="'. html_entity_decode($essay->jawaban_v) .'"><input type="hidden" id="nilai_v" name="nilai_v" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_w) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_w, $kataCek) == FALSE) {
								!empty($essay->jawaban_w) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_w.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_w" maxlength="'.strlen($essay->jawaban_w).'"><input type="hidden" id="jawaban_w" value="'. htmlentities($essay->jawaban_w) .'"><input type="hidden" id="nilai_w" name="nilai_w" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_w, $kataCek) !== FALSE) {
								!empty($essay->jawaban_w) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_w.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_w" maxlength="'.strlen($essay->jawaban_w).'"><input type="hidden" id="jawaban_w" value="'. html_entity_decode($essay->jawaban_w) .'"><input type="hidden" id="nilai_w" name="nilai_w" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_x) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_x, $kataCek) == FALSE) {
								!empty($essay->jawaban_x) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_x.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_x" maxlength="'.strlen($essay->jawaban_x).'"><input type="hidden" id="jawaban_x" value="'. htmlentities($essay->jawaban_x) .'"><input type="hidden" id="nilai_x" name="nilai_x" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_x, $kataCek) !== FALSE) {
								!empty($essay->jawaban_x) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_x.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_x" maxlength="'.strlen($essay->jawaban_x).'"><input type="hidden" id="jawaban_x" value="'. html_entity_decode($essay->jawaban_x) .'"><input type="hidden" id="nilai_x" name="nilai_x" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_y) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_y, $kataCek) == FALSE) {
								!empty($essay->jawaban_y) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_y.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_y" maxlength="'.strlen($essay->jawaban_y).'"><input type="hidden" id="jawaban_y" value="'. htmlentities($essay->jawaban_y) .'"><input type="hidden" id="nilai_y" name="nilai_y" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_y, $kataCek) !== FALSE) {
								!empty($essay->jawaban_y) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_y.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_y" maxlength="'.strlen($essay->jawaban_y).'"><input type="hidden" id="jawaban_y" value="'. html_entity_decode($essay->jawaban_y) .'"><input type="hidden" id="nilai_y" name="nilai_y" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_z) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_z, $kataCek) == FALSE) {
								!empty($essay->jawaban_z) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_z.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_z" maxlength="'.strlen($essay->jawaban_z).'"><input type="hidden" id="jawaban_z" value="'. htmlentities($essay->jawaban_z) .'"><input type="hidden" id="nilai_z" name="nilai_z" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_z, $kataCek) !== FALSE) {
								!empty($essay->jawaban_z) ? $html .= '<div style="margin: 10px;">'.$essay->urutan_nomor_z.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_z" maxlength="'.strlen($essay->jawaban_z).'"><input type="hidden" id="jawaban_z" value="'. html_entity_decode($essay->jawaban_z) .'"><input type="hidden" id="nilai_z" name="nilai_z" value=""></div>' : '';
							$no++;
							}
							
						}
						$html .= '';
					}
					if ($essay->jenis_program == 1) {
						$html .= '';
						if ($essay->jawaban_1) {
							!empty($essay->jawaban_1) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_1" maxlength="'.strlen($essay->jawaban_1).'"><input type="" id="jawaban_1" value="'. $essay->jawaban_1 .'"><input type="hidden" id="nilai_1" name="nilai_1" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_2) {
							!empty($essay->jawaban_2) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_2" maxlength="'.strlen($essay->jawaban_2).'"><input type="hidden" id="jawaban_2" value="'. $essay->jawaban_2 .'"><input type="hidden" id="nilai_2" name="nilai_2" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_3) {
							!empty($essay->jawaban_3) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_3" maxlength="'.strlen($essay->jawaban_3).'"><input type="hidden" id="jawaban_3" value="'. $essay->jawaban_3 .'"><input type="hidden" id="nilai_3" name="nilai_3" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_4) {
							!empty($essay->jawaban_4) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_4" maxlength="'.strlen($essay->jawaban_4).'"><input type="hidden" id="jawaban_4" value="'. $essay->jawaban_4 .'"><input type="hidden" id="nilai_4" name="nilai_4" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_5) {
							!empty($essay->jawaban_5) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_5" maxlength="'.strlen($essay->jawaban_5).'"><input type="hidden" id="jawaban_5" value="'. $essay->jawaban_5 .'"><input type="hidden" id="nilai_5" name="nilai_5" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_6) {
							!empty($essay->jawaban_6) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_6" maxlength="'.strlen($essay->jawaban_6).'"><input type="hidden" id="jawaban_6" value="'. $essay->jawaban_6 .'"><input type="hidden" id="nilai_6" name="nilai_6" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_7) {
							!empty($essay->jawaban_7) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_7" maxlength="'.strlen($essay->jawaban_7).'"><input type="hidden" id="jawaban_7" value="'. $essay->jawaban_7 .'"><input type="hidden" id="nilai_7" name="nilai_7" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_8) {
							!empty($essay->jawaban_8) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_8" maxlength="'.strlen($essay->jawaban_8).'"><input type="hidden" id="jawaban_8" value="'. $essay->jawaban_8 .'"><input type="hidden" id="nilai_8" name="nilai_8" value=""></div>' : '';
							$no++;
						}
						if ($essay->jawaban_a) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_a, $kataCek) == FALSE) {
								!empty($essay->jawaban_a) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_a" maxlength="'.strlen($essay->jawaban_a).'"><input type="hidden" id="jawaban_a" value="'. htmlentities($essay->jawaban_a) .'"><input type="hidden" id="nilai_a" name="nilai_a" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_a, $kataCek) !== FALSE) {
								!empty($essay->jawaban_a) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_a" maxlength="'.strlen($essay->jawaban_a).'"><input type="hidden" id="jawaban_a" value="'. html_entity_decode($essay->jawaban_a) .'"><input type="hidden" id="nilai_a" name="nilai_a" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_b) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_b, $kataCek) == FALSE) {
								!empty($essay->jawaban_b) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_b" maxlength="'.strlen($essay->jawaban_b).'"><input type="hidden" id="jawaban_b" value="'. htmlentities($essay->jawaban_b) .'"><input type="hidden" id="nilai_b" name="nilai_b" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_b, $kataCek) !== FALSE) {
								!empty($essay->jawaban_b) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_b" maxlength="'.strlen($essay->jawaban_b).'"><input type="hidden" id="jawaban_b" value="'. html_entity_decode($essay->jawaban_b) .'"><input type="hidden" id="nilai_b" name="nilai_b" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_c) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_c, $kataCek) == FALSE) {
								!empty($essay->jawaban_c) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_c" maxlength="'.strlen($essay->jawaban_c).'"><input type="hidden" id="jawaban_c" value="'. htmlentities($essay->jawaban_c) .'"><input type="hidden" id="nilai_c" name="nilai_c" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_c, $kataCek) !== FALSE) {
								!empty($essay->jawaban_c) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_c" maxlength="'.strlen($essay->jawaban_c).'"><input type="hidden" id="jawaban_c" value="'. html_entity_decode($essay->jawaban_c) .'"><input type="hidden" id="nilai_c" name="nilai_c" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_d) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_d, $kataCek) == FALSE) {
								!empty($essay->jawaban_d) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_d" maxlength="'.strlen($essay->jawaban_d).'"><input type="hidden" id="jawaban_d" value="'. htmlentities($essay->jawaban_d) .'"><input type="hidden" id="nilai_d" name="nilai_d" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_d, $kataCek) !== FALSE) {
								!empty($essay->jawaban_d) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_d" maxlength="'.strlen($essay->jawaban_d).'"><input type="hidden" id="jawaban_d" value="'. html_entity_decode($essay->jawaban_d) .'"><input type="hidden" id="nilai_d" name="nilai_d" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_e) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_e, $kataCek) == FALSE) {
								!empty($essay->jawaban_e) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_e" maxlength="'.strlen($essay->jawaban_e).'"><input type="hidden" id="jawaban_e" value="'. htmlentities($essay->jawaban_e) .'"><input type="hidden" id="nilai_e" name="nilai_e" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_e, $kataCek) !== FALSE) {
								!empty($essay->jawaban_e) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_e" maxlength="'.strlen($essay->jawaban_e).'"><input type="hidden" id="jawaban_e" value="'. html_entity_decode($essay->jawaban_e) .'"><input type="hidden" id="nilai_e" name="nilai_e" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_f) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_f, $kataCek) == FALSE) {
								!empty($essay->jawaban_f) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_f" maxlength="'.strlen($essay->jawaban_f).'"><input type="hidden" id="jawaban_f" value="'. htmlentities($essay->jawaban_f) .'"><input type="hidden" id="nilai_f" name="nilai_f" value=""></div>' : '';
								$no++;
							}
							if (strpos($essay->jawaban_f, $kataCek) !== FALSE) {
								!empty($essay->jawaban_f) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_f" maxlength="'.strlen($essay->jawaban_f).'"><input type="hidden" id="jawaban_f" value="'. html_entity_decode($essay->jawaban_f) .'"><input type="hidden" id="nilai_f" name="nilai_f" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_g) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_g, $kataCek) == FALSE) {
								!empty($essay->jawaban_g) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_g" maxlength="'.strlen($essay->jawaban_g).'"><input type="hidden" id="jawaban_g" value="'. htmlentities($essay->jawaban_g) .'"><input type="hidden" id="nilai_g" name="nilai_g" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_g, $kataCek) !== FALSE) {
								!empty($essay->jawaban_g) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_g" maxlength="'.strlen($essay->jawaban_g).'"><input type="hidden" id="jawaban_g" value="'. html_entity_decode($essay->jawaban_g) .'"><input type="hidden" id="nilai_g" name="nilai_g" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_h) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_h, $kataCek) == FALSE) {
								!empty($essay->jawaban_h) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_h" maxlength="'.strlen($essay->jawaban_h).'"><input type="hidden" id="jawaban_h" value="'. htmlentities($essay->jawaban_h) .'"><input type="hidden" id="nilai_h" name="nilai_h" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_h, $kataCek) !== FALSE) {
								!empty($essay->jawaban_h) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_h" maxlength="'.strlen($essay->jawaban_h).'"><input type="hidden" id="jawaban_h" value="'. html_entity_decode($essay->jawaban_h) .'"><input type="hidden" id="nilai_h" name="nilai_h" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_i) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_i, $kataCek) == FALSE) {
								!empty($essay->jawaban_i) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_i" maxlength="'.strlen($essay->jawaban_i).'"><input type="hidden" id="jawaban_i" value="'. htmlentities($essay->jawaban_i) .'"><input type="hidden" id="nilai_i" name="nilai_i" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_i, $kataCek) !== FALSE) {
								!empty($essay->jawaban_i) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_i" maxlength="'.strlen($essay->jawaban_i).'"><input type="hidden" id="jawaban_i" value="'. html_entity_decode($essay->jawaban_i) .'"><input type="hidden" id="nilai_i" name="nilai_i" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_j) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_j, $kataCek) == FALSE) {
								!empty($essay->jawaban_j) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_j" maxlength="'.strlen($essay->jawaban_j).'"><input type="hidden" id="jawaban_j" value="'. htmlentities($essay->jawaban_j) .'"><input type="hidden" id="nilai_j" name="nilai_j" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_j, $kataCek) !== FALSE) {
								!empty($essay->jawaban_j) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_j" maxlength="'.strlen($essay->jawaban_j).'"><input type="hidden" id="jawaban_j" value="'. html_entity_decode($essay->jawaban_j) .'"><input type="hidden" id="nilai_j" name="nilai_j" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_k) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_k, $kataCek) == FALSE) {
								!empty($essay->jawaban_k) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_k" maxlength="'.strlen($essay->jawaban_k).'"><input type="hidden" id="jawaban_k" value="'. htmlentities($essay->jawaban_k) .'"><input type="hidden" id="nilai_k" name="nilai_k" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_k, $kataCek) !== FALSE) {
								!empty($essay->jawaban_k) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_k" maxlength="'.strlen($essay->jawaban_k).'"><input type="hidden" id="jawaban_k" value="'. html_entity_decode($essay->jawaban_k) .'"><input type="hidden" id="nilai_k" name="nilai_k" value=""></div>' : '';
								$no++;
							}
						}
						if ($essay->jawaban_l) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_l, $kataCek) == FALSE) {
								!empty($essay->jawaban_l) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_l" maxlength="'.strlen($essay->jawaban_l).'"><input type="hidden" id="jawaban_l" value="'. htmlentities($essay->jawaban_l) .'"><input type="hidden" id="nilai_l" name="nilai_l" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_l, $kataCek) !== FALSE) {
								!empty($essay->jawaban_l) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_l" maxlength="'.strlen($essay->jawaban_l).'"><input type="hidden" id="jawaban_l" value="'. html_entity_decode($essay->jawaban_l) .'"><input type="hidden" id="nilai_l" name="nilai_l" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_m) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_m, $kataCek) == FALSE) {
								!empty($essay->jawaban_m) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_m" maxlength="'.strlen($essay->jawaban_m).'"><input type="hidden" id="jawaban_m" value="'. htmlentities($essay->jawaban_m) .'"><input type="hidden" id="nilai_m" name="nilai_m" value=""></div>' : '';
								$no++;
							}

							if (strpos($essay->jawaban_m, $kataCek) !== FALSE) {
								!empty($essay->jawaban_m) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_m" maxlength="'.strlen($essay->jawaban_m).'"><input type="hidden" id="jawaban_m" value="'. html_entity_decode($essay->jawaban_m) .'"><input type="hidden" id="nilai_m" name="nilai_m" value=""></div>' : '';
								$no++;
							}
							
						}
						if ($essay->jawaban_n) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_n, $kataCek) == FALSE) {
								!empty($essay->jawaban_n) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_n" maxlength="'.strlen($essay->jawaban_n).'"><input type="hidden" id="jawaban_n" value="'. htmlentities($essay->jawaban_n) .'"><input type="hidden" id="nilai_n" name="nilai_n" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_n, $kataCek) !== FALSE) {
								!empty($essay->jawaban_n) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_n" maxlength="'.strlen($essay->jawaban_n).'"><input type="hidden" id="jawaban_n" value="'. html_entity_decode($essay->jawaban_n) .'"><input type="hidden" id="nilai_n" name="nilai_n" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_o) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_o, $kataCek) == FALSE) {
								!empty($essay->jawaban_o) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_o" maxlength="'.strlen($essay->jawaban_o).'"><input type="hidden" id="jawaban_o" value="'. htmlentities($essay->jawaban_o) .'"><input type="hidden" id="nilai_o" name="nilai_o" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_o, $kataCek) !== FALSE) {
								!empty($essay->jawaban_o) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_o" maxlength="'.strlen($essay->jawaban_o).'"><input type="hidden" id="jawaban_o" value="'. html_entity_decode($essay->jawaban_o) .'"><input type="hidden" id="nilai_o" name="nilai_o" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_p) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_p, $kataCek) == FALSE) {
								!empty($essay->jawaban_p) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_p" maxlength="'.strlen($essay->jawaban_p).'"><input type="hidden" id="jawaban_p" value="'. htmlentities($essay->jawaban_p) .'"><input type="hidden" id="nilai_p" name="nilai_p" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_p, $kataCek) !== FALSE) {
								!empty($essay->jawaban_p) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_p" maxlength="'.strlen($essay->jawaban_p).'"><input type="hidden" id="jawaban_p" value="'. html_entity_decode($essay->jawaban_p) .'"><input type="hidden" id="nilai_p" name="nilai_p" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_q) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_q, $kataCek) == FALSE) {
								!empty($essay->jawaban_q) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_q" maxlength="'.strlen($essay->jawaban_q).'"><input type="hidden" id="jawaban_q" value="'. htmlentities($essay->jawaban_q) .'"><input type="hidden" id="nilai_q" name="nilai_q" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_q, $kataCek) !== FALSE) {
								!empty($essay->jawaban_q) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_q" maxlength="'.strlen($essay->jawaban_q).'"><input type="hidden" id="jawaban_q" value="'. html_entity_decode($essay->jawaban_q) .'"><input type="hidden" id="nilai_q" name="nilai_q" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_r) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_r, $kataCek) == FALSE) {
								!empty($essay->jawaban_r) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_r" maxlength="'.strlen($essay->jawaban_r).'"><input type="hidden" id="jawaban_r" value="'. htmlentities($essay->jawaban_r) .'"><input type="hidden" id="nilai_r" name="nilai_r" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_r, $kataCek) !== FALSE) {
								!empty($essay->jawaban_r) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_r" maxlength="'.strlen($essay->jawaban_r).'"><input type="hidden" id="jawaban_r" value="'. html_entity_decode($essay->jawaban_r) .'"><input type="hidden" id="nilai_r" name="nilai_r" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_s) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_s, $kataCek) == FALSE) {
								!empty($essay->jawaban_s) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_s" maxlength="'.strlen($essay->jawaban_s).'"><input type="hidden" id="jawaban_s" value="'. htmlentities($essay->jawaban_s) .'"><input type="hidden" id="nilai_s" name="nilai_s" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_s, $kataCek) !== FALSE) {
								!empty($essay->jawaban_s) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_s" maxlength="'.strlen($essay->jawaban_s).'"><input type="hidden" id="jawaban_s" value="'. html_entity_decode($essay->jawaban_s) .'"><input type="hidden" id="nilai_s" name="nilai_s" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_t) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_t, $kataCek) == FALSE) {
								!empty($essay->jawaban_t) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_t" maxlength="'.strlen($essay->jawaban_t).'"><input type="hidden" id="jawaban_t" value="'. htmlentities($essay->jawaban_t) .'"><input type="hidden" id="nilai_t" name="nilai_t" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_t, $kataCek) !== FALSE) {
								!empty($essay->jawaban_t) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_t" maxlength="'.strlen($essay->jawaban_t).'"><input type="hidden" id="jawaban_t" value="'. html_entity_decode($essay->jawaban_t) .'"><input type="hidden" id="nilai_t" name="nilai_t" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_u) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_u, $kataCek) == FALSE) {
								!empty($essay->jawaban_u) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_u" maxlength="'.strlen($essay->jawaban_u).'"><input type="hidden" id="jawaban_u" value="'. htmlentities($essay->jawaban_u) .'"><input type="hidden" id="nilai_u" name="nilai_u" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_u, $kataCek) !== FALSE) {
								!empty($essay->jawaban_u) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_u" maxlength="'.strlen($essay->jawaban_u).'"><input type="hidden" id="jawaban_u" value="'. html_entity_decode($essay->jawaban_u) .'"><input type="hidden" id="nilai_u" name="nilai_u" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_v) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_v, $kataCek) == FALSE) {
								!empty($essay->jawaban_v) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_v" maxlength="'.strlen($essay->jawaban_v).'"><input type="hidden" id="jawaban_v" value="'. htmlentities($essay->jawaban_v) .'"><input type="hidden" id="nilai_v" name="nilai_v" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_v, $kataCek) !== FALSE) {
								!empty($essay->jawaban_v) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_v" maxlength="'.strlen($essay->jawaban_v).'"><input type="hidden" id="jawaban_v" value="'. html_entity_decode($essay->jawaban_v) .'"><input type="hidden" id="nilai_v" name="nilai_v" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_w) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_w, $kataCek) == FALSE) {
								!empty($essay->jawaban_w) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_w" maxlength="'.strlen($essay->jawaban_w).'"><input type="hidden" id="jawaban_w" value="'. htmlentities($essay->jawaban_w) .'"><input type="hidden" id="nilai_w" name="nilai_w" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_w, $kataCek) !== FALSE) {
								!empty($essay->jawaban_w) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_w" maxlength="'.strlen($essay->jawaban_w).'"><input type="hidden" id="jawaban_w" value="'. html_entity_decode($essay->jawaban_w) .'"><input type="hidden" id="nilai_w" name="nilai_w" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_x) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_x, $kataCek) == FALSE) {
								!empty($essay->jawaban_x) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_x" maxlength="'.strlen($essay->jawaban_x).'"><input type="hidden" id="jawaban_x" value="'. htmlentities($essay->jawaban_x) .'"><input type="hidden" id="nilai_x" name="nilai_x" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_x, $kataCek) !== FALSE) {
								!empty($essay->jawaban_x) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_x" maxlength="'.strlen($essay->jawaban_x).'"><input type="hidden" id="jawaban_x" value="'. html_entity_decode($essay->jawaban_x) .'"><input type="hidden" id="nilai_x" name="nilai_x" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_y) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_y, $kataCek) == FALSE) {
								!empty($essay->jawaban_y) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_y" maxlength="'.strlen($essay->jawaban_y).'"><input type="hidden" id="jawaban_y" value="'. htmlentities($essay->jawaban_y) .'"><input type="hidden" id="nilai_y" name="nilai_y" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_y, $kataCek) !== FALSE) {
								!empty($essay->jawaban_y) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_y" maxlength="'.strlen($essay->jawaban_y).'"><input type="hidden" id="jawaban_y" value="'. html_entity_decode($essay->jawaban_y) .'"><input type="hidden" id="nilai_y" name="nilai_y" value=""></div>' : '';
							$no++;
							}
							
						}
						if ($essay->jawaban_z) {
							$kataCek = "&lt;";
							if (strpos($essay->jawaban_z, $kataCek) == FALSE) {
								!empty($essay->jawaban_z) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_z" maxlength="'.strlen($essay->jawaban_z).'"><input type="hidden" id="jawaban_z" value="'. htmlentities($essay->jawaban_z) .'"><input type="hidden" id="nilai_z" name="nilai_z" value=""></div>' : '';
							$no++;
							}

							if (strpos($essay->jawaban_z, $kataCek) !== FALSE) {
								!empty($essay->jawaban_z) ? $html .= '<div style="margin: 10px;">'.$no.'. '.'<input style="width: 300px; height: 25px;" type="text" id="jwb_z" maxlength="'.strlen($essay->jawaban_z).'"><input type="hidden" id="jawaban_z" value="'. html_entity_decode($essay->jawaban_z) .'"><input type="hidden" id="nilai_z" name="nilai_z" value=""></div>' : '';
							$no++;
							}
							
						}
						$html .= '';
					}
					$otp = '<py-script>
					'. $essay->jawaban_1.'
					'. $essay->jawaban_2.'
					'. $essay->jawaban_3.'
					'. $essay->jawaban_4.'
					'. $essay->jawaban_5.'
					'. $essay->jawaban_6.'
					'. $essay->jawaban_7.'
					'. $essay->jawaban_8.'
					'. $essay->jawaban_a.'
					'. $essay->jawaban_b.'
					'. $essay->jawaban_c.'
					'. $essay->jawaban_d.'
					'. $essay->jawaban_e.'
					'. $essay->jawaban_f.'
					'. $essay->jawaban_g.'
					'. $essay->jawaban_h.'
					'. $essay->jawaban_i.'
					'. $essay->jawaban_j.'
					'. $essay->jawaban_k.'
					'. $essay->jawaban_l.'
					'. $essay->jawaban_m.'
					'. $essay->jawaban_n.'
					'. $essay->jawaban_o.'
					'. $essay->jawaban_p.'
					'. $essay->jawaban_q.'
					'. $essay->jawaban_r.'
					'. $essay->jawaban_s.'
					'. $essay->jawaban_t.'
					'. $essay->jawaban_u.'
					'. $essay->jawaban_v.'
					'. $essay->jawaban_w.'
					'. $essay->jawaban_x.'
					'. $essay->jawaban_y.'
					'. $essay->jawaban_z.'
					</py-script>';
					$html .= '</td></tr>';
					$html .= '</tbody>
						</table>';
					// $html .= '
					// <div>
					// 	<py-script>
					// 		print("test")
					// 	</py-script>
					// </div>';

					$html .= '</div>
					
					<div id="success-alert" class="alert" style="display: none;">
					<h4>Jawaban anda benar, silahkan lanjut ke studi kasus berikutnya</h4>
					<img src="'.base_url().'template/images/success.png" alt="success" />
					<div class="form-group col-sm-12">
					<p> Output Program : </p>
					<p> '.$otp.' </p>

					</div>
					<button type="submit" class="btn btn-xs btn-info">lanjut</button>
					</div>
					<div id="fail-alert" class="alert" style="display: none;">
					<h4>Jawaban anda masihh salah, silahkan mengisi ulang</h4>
					<img src="'.base_url().'template/images/fail.jpeg" alt="fail" />
					<button type="button" onclick="python()";" class="btn btn-xs btn-info">run</button>
					<button type="button" onclick="return close_alert();" class="btn btn-xs btn-info">close</button>
					<button type="submit" class="btn btn-xs btn-danger">lanjut</button>
				</div>
				</main>';
				}
        $html .= '</div></div>';
		
		

		$timeTaken = null;
		$userId = $this->session->userdata('user_id');
		$getTimeTaken = $this->ujian->getTimeEssay($idessay,$userId);
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
			'judul'		=> 'Ujian Essay',
			'subjudul'	=> 'Lembar Ujian',
			// 'soal'		=> $detail_tes,
			'html' 		=> $html,
			'timeTaken' => $timeTaken,
			'id_tes'	=> $id,
			'idessay'	=> $idessay,
			'soalDigunakan'		=> $soalDigunakan,
		];
		$this->load->view('_templates/topnav/_header.php', $data);
		$this->load->view('ujian/essay');
		$this->load->view('_templates/topnav/_footer.php');
	}

	public function save_history($id_soal, $id_user, $id_essay)
	{
		$count_data = $this->db->query('SELECT * FROM history_essay WHERE id_soal = ? and id_user = ? and id_essay = ?', [$id_soal, $id_user, $id_essay])->num_rows();
		if ($count_data === 0) {
			$this->db->insert('history_essay', [
				'id_soal' => $id_soal,
				'id_user' => $id_user,
				'id_essay' => $id_essay
			]);
		}
	}

	public function simpan_nilai()
	{
		$method = $this->input->post('method', true);
        $id_level = $this->input->post('id_level', true);
		$id_soal = $this->input->post('id_soal', true);
		$id_user = $this->session->userdata('user_id');

		$nilai1 = $this->input->post('nilai_1', true);
		$nilai2 = $this->input->post('nilai_2', true);
		$nilai3 = $this->input->post('nilai_3', true);
		$nilai4 = $this->input->post('nilai_4', true);
		$nilai5 = $this->input->post('nilai_5', true);
		$nilai6 = $this->input->post('nilai_6', true);
		$nilai7 = $this->input->post('nilai_7', true);
		$nilai8 = $this->input->post('nilai_8', true);
		$nilaiA = $this->input->post('nilai_a', true);
		$nilaiB = $this->input->post('nilai_b', true);
		$nilaiC = $this->input->post('nilai_c', true);
		$nilaiD = $this->input->post('nilai_d', true);
		$nilaiE = $this->input->post('nilai_e', true);
		$nilaiF = $this->input->post('nilai_f', true);
		$nilaiG = $this->input->post('nilai_g', true);
		$nilaiH = $this->input->post('nilai_h', true);
		$nilaiI = $this->input->post('nilai_i', true);
		$nilaiJ = $this->input->post('nilai_j', true);
		$nilaiK = $this->input->post('nilai_k', true);
		$nilaiL = $this->input->post('nilai_l', true);
		$nilaiM = $this->input->post('nilai_m', true);
		$nilaiN = $this->input->post('nilai_n', true);
		$nilaiO = $this->input->post('nilai_o', true);
		$nilaiP = $this->input->post('nilai_p', true);
		$nilaiQ = $this->input->post('nilai_q', true);
		$nilaiR = $this->input->post('nilai_r', true);
		$nilaiS = $this->input->post('nilai_s', true);
		$nilaiT = $this->input->post('nilai_t', true);
		$nilaiU = $this->input->post('nilai_u', true);
		$nilaiV = $this->input->post('nilai_v', true);
		$nilaiW = $this->input->post('nilai_w', true);
		$nilaiX = $this->input->post('nilai_x', true);
		$nilaiY = $this->input->post('nilai_y', true);
		$nilaiZ = $this->input->post('nilai_z', true);

		$hasil = $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6 + $nilai7 + $nilai8 + $nilaiA + $nilaiB + $nilaiC + $nilaiD + $nilaiE + $nilaiF + $nilaiG + $nilaiH + $nilaiI + $nilaiJ + $nilaiK + $nilaiL + $nilaiM + $nilaiN + $nilaiO + $nilaiP + $nilaiQ + $nilaiR + $nilaiS + $nilaiT + $nilaiU + $nilaiV + $nilaiW + $nilaiX + $nilaiY + $nilaiZ;

			//push array
			$data['id_user'] = $id_user;
			$data['id_soal'] = $this->input->post('id_soal', true);
			$data['id_essay'] = $this->input->post('id_essay', true);
			$data['nilai_1'] = $this->input->post('nilai_1', true);
			$data['nilai_2'] = $this->input->post('nilai_2', true);
			$data['nilai_3'] = $this->input->post('nilai_3', true);
			$data['nilai_4'] = $this->input->post('nilai_4', true);
			$data['nilai_5'] = $this->input->post('nilai_5', true);
			$data['nilai_6'] = $this->input->post('nilai_6', true);
			$data['nilai_7'] = $this->input->post('nilai_7', true);
			$data['nilai_8'] = $this->input->post('nilai_8', true);
			$data['nilai_a'] = $this->input->post('nilai_a', true);
			$data['nilai_b'] = $this->input->post('nilai_b', true);
			$data['nilai_c'] = $this->input->post('nilai_c', true);
			$data['nilai_d'] = $this->input->post('nilai_d', true);
			$data['nilai_e'] = $this->input->post('nilai_e', true);
			$data['nilai_f'] = $this->input->post('nilai_f', true);
			$data['nilai_g'] = $this->input->post('nilai_g', true);
			$data['nilai_h'] = $this->input->post('nilai_h', true);
			$data['nilai_i'] = $this->input->post('nilai_i', true);
			$data['nilai_j'] = $this->input->post('nilai_j', true);
			$data['nilai_k'] = $this->input->post('nilai_k', true);
			$data['nilai_l'] = $this->input->post('nilai_l', true);
			$data['nilai_m'] = $this->input->post('nilai_m', true);
			$data['nilai_n'] = $this->input->post('nilai_n', true);
			$data['nilai_o'] = $this->input->post('nilai_o', true);
			$data['nilai_p'] = $this->input->post('nilai_p', true);
			$data['nilai_q'] = $this->input->post('nilai_q', true);
			$data['nilai_r'] = $this->input->post('nilai_r', true);
			$data['nilai_s'] = $this->input->post('nilai_s', true);
			$data['nilai_t'] = $this->input->post('nilai_t', true);
			$data['nilai_u'] = $this->input->post('nilai_u', true);
			$data['nilai_v'] = $this->input->post('nilai_v', true);
			$data['nilai_w'] = $this->input->post('nilai_w', true);
			$data['nilai_x'] = $this->input->post('nilai_x', true);
			$data['nilai_y'] = $this->input->post('nilai_y', true);
			$data['nilai_z'] = $this->input->post('nilai_z', true);
			$data['nilaiessay'] = $hasil;
			$data['waktu'] = $this->input->post('waktu', true);
			//insert data
			$cek = $this->db->query('select * from nilai_essay where id_user = ? and id_soal = ?', [$id_user, $id_soal])->num_rows();
			if ($cek == 0) {
				$this->master->create('nilai_essay', $data);
			}
            redirect('ujian/list_ujian/'.$id_level);
	}
}