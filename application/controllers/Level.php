<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level extends CI_Controller
{

    public $mhs, $user;

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } else if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('dosen') && !$this->ion_auth->in_group('mahasiswa')) {
            show_error('Hanya Administrator dan dosen yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
        $this->load->helper('my'); // Load Library Ignited-Datatables
        $this->load->model('Master_model', 'master');
        $this->load->model('Level_model', 'level');
        $this->load->model('Ujian_model', 'ujian');

        $this->user = $this->ion_auth->user()->row();

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
            'judul'    => 'Kategori',
            'subjudul' => 'Kategori soal'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('level/data');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Kategori',
            'subjudul'  => 'Detail Kategori',
            'level'      => $this->level->getLevelById($id),
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('level/detail');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Kategori',
            'subjudul'  => 'Buat Kategori'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('level/add');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function edit($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'    => 'Kategori',
            'subjudul' => 'Edit Kategori',
            'level'      => $this->level->getLevelById($id),
        ];

        // print_r($data);
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('level/edit');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function data($id = null, $dosen = null)
    {
        // $data = $this->level->getDataLevel($id, $dosen);
        $data = $this->level->getDataLevel($id, $dosen);
        $json = json_decode($data,true);
        for ($i=0; $i < count($json['data']); $i++) { 
           if($json['data'][$i]['feedback_data_type'] == NULL)
           {
                $json['data'][$i]['feedback_data_type'] = 'Belum diatur';
           }

           if($json['data'][$i]['feedback_input'] == NULL)
           {
                $json['data'][$i]['feedback_input'] = 'Belum diatur';
           }

           if($json['data'][$i]['feedback_process'] == NULL)
           {
                $json['data'][$i]['feedback_process'] = 'Belum diatur';
           }

           if($json['data'][$i]['feedback_output'] == NULL)
           {
                $json['data'][$i]['feedback_output'] = 'Belum diatur';
           }
           $json['data'][$i]['feedback'] = '<ul>
            <li>Feedback Data Type : '.$json['data'][$i]['feedback_data_type'].'</li>
            <li>Feedback Input : '.$json['data'][$i]['feedback_input'].'</li>
            <li>Feedback Process : '.$json['data'][$i]['feedback_process'].'</li>
            <li>Feedback Output : '.$json['data'][$i]['feedback_output'].'</li>
           </ul>';
        }
        $back = json_encode($json);
        //echo print_r($json['data'][0]);
        $this->output_json($back, false);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('bts_nilai', 'Batas nilai ', 'required');
    }

    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH . 'uploads/level_soal/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function save()
    {
        $method = $this->input->post('method', true);
        $this->validasi();
        $this->file_config();
        $id_level = $this->input->post('id_level', true);


        if ($this->form_validation->run() === FALSE) {
            $method === 'add' ? $this->add() : $this->edit($id_level);
        } else {

            $data = [
                // 'level'      => $this->input->post('level', true),
                'nama'      => $this->input->post('nama', true),
                'feedback_data_type' => $this->input->post('feedback_data_type', true),
                'feedback_input' => $this->input->post('feedback_input', true),
                'feedback_process' => $this->input->post('feedback_process', true),
                'feedback_output' => $this->input->post('feedback_output', true),
                'bts_nilai' => $this->input->post('bts_nilai', true)
            ];

            $i = 0;
            foreach ($_FILES as $key => $val) {
                $img_src = FCPATH . 'uploads/level_soal/';
                $getlevel = $this->level->getlevelById($this->input->post('id_level', true));
                $error = '';
                if ($key === 'image') {
                    if (!empty($_FILES['image']['name'])) {
                        if (!$this->upload->do_upload('image')) {
                            $error = $this->upload->display_errors();
                            show_error($error, 500, 'File Soal Error');
                            exit();
                        } else {
                            if ($method === 'edit') {
                                if (!unlink($img_src . $getlevel->image)) {
                                    show_error('Error saat delete gambar <br/>' . var_dump($getlevel), 500, 'Error Edit Gambar');
                                    exit();
                                }
                            }
                            $data['image'] = $this->upload->data('file_name');
                        }
                    }
                }
            }



            // Inputan Opsi
            $data['bts_nilai']    = $this->input->post('bts_nilai', true);
            $data['nama']    = $this->input->post('nama', true);
            $data['feedback_data_type']    = $this->input->post('feedback_data_type', true);
            $data['feedback_input']    = $this->input->post('feedback_input', true);
            $data['feedback_process']    = $this->input->post('feedback_process', true);
            $data['feedback_output']    = $this->input->post('feedback_output', true);

            if ($method === 'add') {
                //insert data
                // print_r($data);
                $this->master->create('tb_level', $data);
            } else if ($method === 'edit') {
                //update data
                $id_level = $this->input->post('id_level', true);
                $this->master->update('tb_level', $data, 'id_level', $id_level);
            } else {
                show_error('Method tidak diketahui', 404);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert" style="position: relative; margin-left:10px; margin-right:10px; box-sizing: border-box;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data berhasil disimpan!
          </div>');
            redirect('level');
        }
    }

    public function delete()
    {
        $chk = $this->input->post('checked', true);

        // Delete File
        foreach ($chk as $id) {
            $path = FCPATH . 'uploads/level_soal/';
            $level = $this->level->getLevelById($id);
            // Hapus File Soal
            if (!empty($level->image)) {
                if (file_exists($path . $level->image)) {
                    unlink($path . $level->image);
                }
            }
        }

        if (!$chk) {
            $this->output_json(['status' => false]);
        } else {
            if ($this->master->delete('tb_level', $chk, 'id_level')) {
                $this->output_json(['status' => true, 'total' => count($chk)]);
            }
        }
    }

    public function akses_mahasiswa()
    {
        if (!$this->ion_auth->in_group('mahasiswa')) {
            show_error('Halaman ini khusus untuk mahasiswa mengikuti ujian, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
    }

    public function list_json()
    {
        //$this->akses_mahasiswa();

        $data = $this->level->getListUjian2();

        echo json_encode($data);
    }
}
