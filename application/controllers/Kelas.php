<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $this->load->model('Kelas_model', 'kelas');
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
            'judul'    => 'Kelas',
            'subjudul' => 'Daftar Kelas'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kelas/data');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Kelas',
            'subjudul'  => 'Detail Kelas',
            'kelas'      => $this->kelas->getKelasById($id),
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kelas/detail');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Kelas',
            'subjudul'  => 'Tambah Daftar Kelas'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kelas/add');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function edit($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'    => 'Kelas',
            'subjudul' => 'Edit Data Kelas',
            'kelas'      => $this->kelas->getKelasById($id),
        ];

        // print_r($data);
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('kelas/edit');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function data($id = null, $dosen = null)
    {
        $this->output_json($this->kelas->getDataKelas($id, $dosen), false);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');
    }

    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH . 'uploads/kelas_daftar/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function save()
    {
        $method = $this->input->post('method', true);
        $this->validasi();
        $this->file_config();
        $id_kelas = $this->input->post('id_kelas', true);


        if ($this->form_validation->run() === FALSE) {
            $method === 'add' ? $this->add() : $this->edit($id_kelas);
        } else {

            $data = [
                // 'level'      => $this->input->post('level', true),
                'nama'      => $this->input->post('nama', true),
            ];

            $i = 0;
            foreach ($_FILES as $key => $val) {
                $img_src = FCPATH . 'uploads/kelas_daftar/';
                $getkelas = $this->kelas->getkelasById($this->input->post('id_kelas', true));
                $error = '';
                if ($key === 'image') {
                    if (!empty($_FILES['image']['name'])) {
                        if (!$this->upload->do_upload('image')) {
                            $error = $this->upload->display_errors();
                            show_error($error, 500, 'File Soal Error');
                            exit();
                        } else {
                            if ($method === 'edit') {
                                if (!unlink($img_src . $getkelas->image)) {
                                    show_error('Error saat delete gambar <br/>' . var_dump($getkelas), 500, 'Error Edit Gambar');
                                    exit();
                                }
                            }
                            $data['image'] = $this->upload->data('file_name');
                        }
                    }
                }
            }



            // Inputan Opsi
            $data['nama']    = $this->input->post('nama', true);

            if ($method === 'add') {
                //insert data
                // print_r($data);
                $this->master->create('tb_kelas', $data);
            } else if ($method === 'edit') {
                //update data
                $id_kelas = $this->input->post('id_kelas', true);
                $this->master->update('tb_kelas', $data, 'id_kelas', $id_kelas);
            } else {
                show_error('Method tidak diketahui', 404);
            }
            redirect('kelas');
        }
    }

    public function delete()
    {
        $chk = $this->input->post('checked', true);

        // Delete File
        foreach ($chk as $id) {
            $path = FCPATH . 'uploads/kelas_daftar/';
            $kelas = $this->kelas->getKelasById($id);
            // Hapus File Soal
            if (!empty($kelas->image)) {
                if (file_exists($path . $kelas->image)) {
                    unlink($path . $kelas->image);
                }
            }
        }

        if (!$chk) {
            $this->output_json(['status' => false]);
        } else {
            if ($this->master->delete('tb_kelas', $chk, 'id_kelas')) {
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

        $data = $this->kelas->getListUjian2();

        echo json_encode($data);
    }
}
