<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
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
        $this->load->model('Feedback_model', 'feed');
        $this->load->model('Master_model', 'master');


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
        $results = $this->feed->getAllFeedback();
        $user = $this->ion_auth->user()->row();
        $data = [
            'user' => $this->user,
			'informasi' => $results,
            'judul'    => 'Feedback',
            'subjudul' => 'Data Feedback'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('feedback/data');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Feedback',
            'subjudul'  => 'Data Feedback',
            'feedback'      => $this->feedback->getFeedbackById($id),
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('feedback/detail');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function add()
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'        => 'Feedback',
            'subjudul'  => 'Isi Data Feedback'
        ];

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('feedback/add');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function edit($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            'user'      => $user,
            'judul'    => 'Feedback',
            'subjudul' => 'Edit Data Feedback',
            'feedback'      => $this->feedback->getFeedbackById($id),
        ];

        // print_r($data);
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('feedback/edit');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function data($id = null, $dosen = null)
    {
        $this->output_json($this->feedback->getDataFeedback($id, $dosen), false);
    }

    public function validasi()
    {
        $this->form_validation->set_rules('feedback_tipedata', 'feedback tipe data', 'required');
        $this->form_validation->set_rules('feedback_algoritma', 'feedback algoritma', 'required');
    //     $this->form_validation->set_rules('bts_nilai', 'Batas nilai ', 'required');
    // }
    }
    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH . 'uploads/feedback/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function save()
    {
        $method = $this->input->post('method', true);
        $this->validasi();
        $this->file_config();
        $id_feedback = $this->input->post('id_feedback', true);


        if ($this->form_validation->run() === FALSE) {
            $method === 'add' ? $this->add() : $this->edit($id_feedback);
        } else {

            $data = [
                // 'level'      => $this->input->post('level', true),
                'feedback_tipedata'      => $this->input->post('feedback_tipedata', true),
                'feedback_algoritma'      => $this->input->post('feedback_algoritma', true),
            
            ];

            $i = 0;
            foreach ($_FILES as $key => $val) {
                $img_src = FCPATH . 'uploads/feedback/';
                $getfeedback = $this->feedback->getFeedbackById($this->input->post('id_feedback', true));
                $error = '';
                if ($key === 'image') {
                    if (!empty($_FILES['image']['name'])) {
                        if (!$this->upload->do_upload('image')) {
                            $error = $this->upload->display_errors();
                            show_error($error, 500, 'File Error');
                            exit();
                        } else {
                            if ($method === 'edit') {
                                if (!unlink($img_src . $getfeedback->image)) {
                                    show_error('Error saat delete data <br/>' . var_dump($getfeedback), 500, 'Error Update Data');
                                    exit();
                                }
                            }
                            $data['image'] = $this->upload->data('file_name');
                        }
                    }
                }
            }



            // Inputan Opsi
            $data['feedback_tipedata']    = $this->input->post('feedback_tipedata', true);
            $data['feedback_algoritma']    = $this->input->post('feedback_algoritma', true);

            if ($method === 'add') {
                //insert data
                // print_r($data);
                $this->master->create('feedback', $data);
            } else if ($method === 'edit') {
                //update data
                $id_feedback = $this->input->post('id_feedback', true);
                $this->master->update('feedback', $data, 'id_feedback', $id_feedback);
            } else {
                show_error('Method tidak diketahui', 404);
            }
            redirect('feedback');
        }
    }

    public function delete()
    {
        $chk = $this->input->post('checked', true);

        // Delete File
        foreach ($chk as $id) {
            $path = FCPATH . 'uploads/feedback/';
            $feedback = $this->feedback->getFeedbackById($id);
            // Hapus File Soal
            if (!empty($feedback->image)) {
                if (file_exists($path . $feedback->image)) {
                    unlink($path . $feedback->image);
                }
            }
        }

        if (!$chk) {
            $this->output_json(['status' => false]);
        } else {
            if ($this->feedback->delete('feedback', $chk, 'id_feedback')) {
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

   
}
