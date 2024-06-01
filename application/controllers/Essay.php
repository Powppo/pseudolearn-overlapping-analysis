<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Essay extends CI_Controller
{
    private $kata = 'jawaban ini jawaban';
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } else if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('dosen')) {
            show_error('Hanya Administrator dan dosen yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
        $this->load->helper('my'); // Load Library Ignited-Datatables
        $this->load->model('Master_model', 'master');
        $this->load->model('Essay_model', 'essay');
        $this->load->model('Soal_model', 'soal');
        $this->load->model('Level_model', 'level');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function output_json($data, $encode = true)
    {
        if ($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function index()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user' => $user,
            'judul'    => 'Essay',
            'subjudul' => 'Bank Essay'
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('essay/data');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function normalisasi()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user' => $user,
            'judul'    => 'Essay',
            'subjudul' => 'Bank Essay'
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }

        $this->load->model('Normalisasi_model');
        $datax['datas'] = $this->Normalisasi_model->get_data();
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('essay/normalisasi', $datax);
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail($id_essay)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'     => 'Essay',
            'subjudul'  => 'Detail Essay',
            'essay'      => $this->essay->getEssayById($id_essay),
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('essay/detail');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Essay',
            'subjudul'  => 'Buat Essay',
            'essay' => $this->essay->getAllEssay(),
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            // $data['dosen'] = $this->soal->getAllDosen();
            $data['tb_level'] = $this->level->getAlllevel();
        } else {
            //Jika bukan maka matkul dipilih otomatis sesuai matkul dosen
            // $data['dosen'] = $this->soal->getMatkulDosen($user->username);
            $data['tb_level'] = $this->level->getAlllevel();
        }

        if ($this->ion_auth->is_admin()) {
            $data['tb_soal'] = $this->soal->getAllSoal();
        }

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('essay/add');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function edit($id)
    {
        $user = $this->ion_auth->user()->row();
        // $idsoal = $this->input->post('id_soal', true);
        // $tabelsoal = $this->db->query('select * from tb_essay join tb_soal on tb_essay.id_soal = tb_soal.id_soal where tb_essay.id_essay = ?', $id)->result();
        $data = [
            'user'      => $user,
            'judul'        => 'Essay',
            'subjudul'  => 'Edit Essay',
            'essay'      => $this->essay->getEssayById($id),
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            // $data['dosen'] = $this->soal->getAllDosen();
            $data['tb_level'] = $this->level->getAlllevel();
        } else {
            //Jika bukan maka matkul dipilih otomatis sesuai matkul dosen
            // $data['dosen'] = $this->soal->getMatkulDosen($user->username);
            $data['tb_level'] = $this->level->getAlllevel();
        }

        if ($this->ion_auth->is_admin()) {
            $data['tb_soal'] = $this->soal->getAllSoal();
        }

        $this->load->view('_templates/dashboard/_headeressay.php', $data);
        $this->load->view('essay/edit');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function data($id_essay = null, $dosen = null)
    {
        $this->output_json($this->essay->getDataEssay($id_essay, $dosen), false);
    }

    public function datalevel($id)
    {
        $this->output_json($this->Essay_model->getDataEssayLevel($id), false);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('bobot', 'Bobot Essay', 'required');
    }

    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function save()
    {
        $method = $this->input->post('method', true);
        $this->validasi();
        $this->file_config();
        $id_essay = $this->input->post('id_essay', true);

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

        if ($this->form_validation->run() === FALSE) {
            $method === 'add' ? $this->add() : $this->edit($id_essay);
        } else {
            $data = [
                'bobot' => $hasil,
                'urutan_nomor_1' =>$this->input->post('urutan_nomor_1', true),
                'urutan_nomor_2' =>$this->input->post('urutan_nomor_2', true),
                'urutan_nomor_3' =>$this->input->post('urutan_nomor_3', true),
                'urutan_nomor_4' =>$this->input->post('urutan_nomor_4', true),
                'urutan_nomor_5' =>$this->input->post('urutan_nomor_5', true),
                'urutan_nomor_6' =>$this->input->post('urutan_nomor_6', true),
                'urutan_nomor_7' =>$this->input->post('urutan_nomor_7', true),
                'urutan_nomor_8' =>$this->input->post('urutan_nomor_8', true),
                'urutan_nomor_a' =>$this->input->post('urutan_nomor_a', true),
                'urutan_nomor_b' =>$this->input->post('urutan_nomor_b', true),
                'urutan_nomor_c' =>$this->input->post('urutan_nomor_c', true),
                'urutan_nomor_d' =>$this->input->post('urutan_nomor_d', true),
                'urutan_nomor_e' =>$this->input->post('urutan_nomor_e', true),
                'urutan_nomor_f' =>$this->input->post('urutan_nomor_f', true),
                'urutan_nomor_g' =>$this->input->post('urutan_nomor_g', true),
                'urutan_nomor_h' =>$this->input->post('urutan_nomor_h', true),
                'urutan_nomor_i' =>$this->input->post('urutan_nomor_i', true),
                'urutan_nomor_j' =>$this->input->post('urutan_nomor_j', true),
                'urutan_nomor_k' =>$this->input->post('urutan_nomor_k', true),
                'urutan_nomor_l' =>$this->input->post('urutan_nomor_l', true),
                'urutan_nomor_m' =>$this->input->post('urutan_nomor_m', true),
                'urutan_nomor_n' =>$this->input->post('urutan_nomor_n', true),
                'urutan_nomor_o' =>$this->input->post('urutan_nomor_o', true),
                'urutan_nomor_p' =>$this->input->post('urutan_nomor_p', true),
                'urutan_nomor_q' =>$this->input->post('urutan_nomor_q', true),
                'urutan_nomor_r' =>$this->input->post('urutan_nomor_r', true),
                'urutan_nomor_s' =>$this->input->post('urutan_nomor_s', true),
                'urutan_nomor_t' =>$this->input->post('urutan_nomor_t', true),
                'urutan_nomor_u' =>$this->input->post('urutan_nomor_u', true),
                'urutan_nomor_v' =>$this->input->post('urutan_nomor_v', true),
                'urutan_nomor_w' =>$this->input->post('urutan_nomor_w', true),
                'urutan_nomor_x' =>$this->input->post('urutan_nomor_x', true),
                'urutan_nomor_y' =>$this->input->post('urutan_nomor_y', true),
                'urutan_nomor_z' =>$this->input->post('urutan_nomor_z', true),
                'output' => $this->input->post('output', true),
            ];

            $abjad = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o', 'p','q','r','s','t','u','v','w','x','y','z'];

            // Inputan Opsi
            foreach ($abjad as $abj) {
                $data['jawaban_' . $abj] = $this->input->post('jawaban_' . $abj, true);
            }

            $nomer = [1, 2, 3, 4, 5, 6, 7, 8];

            foreach ($nomer as $nomor) {
                $data['jawaban_' . $nomor] = $this->input->post('jawaban_' . $nomor, true);
            }

            if ($this->ion_auth->is_admin()) {
                $pecah = $this->input->post('dosen_id', true);
                $pecah = explode(':', $pecah);
                // $data['dosen_id'] = $pecah[0];
                // $data['matkul_id'] = end($pecah);
                $data['id_soal'] = $this->input->post('id_soal', true);
                $data['id_level'] = $this->input->post('id_level', true);
            } else {
                // $data['dosen_id'] = $this->input->post('dosen_id', true);
                // $data['matkul_id'] = $this->input->post('matkul_id', true);
                $data['id_soal'] = $this->input->post('id_soal', true);
                $data['id_level'] = $this->input->post('id_level', true);
            }
            
            if ($method === 'add') {
                //push array
                $data['created_on'] = time();
                $data['updated_on'] = time();
                //insert data
                $this->master->create('tb_essay', $data);
            } else if ($method === 'edit') {
                //push array
                $data['updated_on'] = time();
                //update data
                $data['status'] = $this->input->post('status', true);
                $id_essay = $this->input->post('id_essay', true);
                $this->master->update('tb_essay', $data, 'id_essay', $id_essay);
            } else {
                show_error('Method tidak diketahui', 404);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert" style="position: relative; margin-left:10px; margin-right:10px; box-sizing: border-box;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data berhasil disimpan!
          </div>');
            redirect('essay/edit/'.$id_essay.'');
    }
}

    public function delete()
    {
        $chk = $this->input->post('checked', true);

        // Delete File
        foreach ($chk as $id) {
            $abjad = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
            $path = FCPATH . 'uploads/bank_essay/';
            $essay = $this->essay->getEssayById($id);
            // Hapus File Soal
            if (!empty($essay->file)) {
                if (file_exists($path . $essay->file)) {
                    unlink($path . $essay->file);
                }
            }
            //Hapus File Opsi
            $i = 0; //index
            foreach ($abjad as $abj) {
                $file_opsi = 'file_' . $abj;
                if (!empty($essay->$file_opsi)) {
                    if (file_exists($path . $essay->$file_opsi)) {
                        unlink($path . $essay->$file_opsi);
                    }
                }
            }
        }

        if (!$chk) {
            $this->output_json(['status' => false]);
        } else {
            if ($this->master->delete('tb_essay', $chk, 'id_essay')) {
                $this->output_json(['status' => true, 'total' => count($chk)]);
            }
        }
    }

    public function essay()
	{
		$this->akses_mahasiswa();
		$id = $this->input->get('key', true);

		$soal 		= $this->ujian->getSoal($id);

		$mhs		= $this->mhs;

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
		$this->load->view('ujian/essay');
		$this->load->view('_templates/topnav/_footer.php');
	}
}
