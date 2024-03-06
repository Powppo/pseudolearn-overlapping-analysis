<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OverlappingAnalysis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }

        $this->load->library(['datatables']); // Load Library Ignited-Datatables
        $this->load->model('Master_model', 'master');
        $this->load->model('Ujian_model', 'ujian');

        $this->user = $this->ion_auth->user()->row();
    }

    public function output_json($data, $encode = true)
    {
        if ($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function index()
    {
        $results = $this->ujian->getOverlappingAnalysis();
        $data = [
            'user' => $this->user,
            'informasi' => $results,
            'judul'    => 'Hasil Overlapping Analysis',
            'subjudul' => 'Analisis Hasil Ujian Mahasiswa',
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('ujian/overlapping_analysis');
        $this->load->view('_templates/dashboard/_footer.php');
    }


    // public function save_history_overlapping($id_soal)
    // {
    //     $id_user = $this->session->userdata('user_id');
    //     $user = $this->db->query('select * from users where id = ?', $id_user)->row_array();
    //     $soal = $this->db->query('select * from tb_soal where id_soal = ?', $id_soal)->row_array();
    //     $count_data = $this->db->query('SELECT * FROM overlapping_analysis WHERE id_soal = ? and id_mahasiswa = ?', [$id_soal, $id_user])->num_rows();
    //     // $jawaban = json_decode($this->input->post('semuaJawaban'), true); // Assuming jawaban sent from client as JSON
    //     // print_r($jawaban);
    //     if ($count_data === 0) {
    //         $this->db->insert('overlapping_analysis', [
    //             'id_soal' => $id_soal,
    //             'id_mahasiswa' => $id_user,
    //             // 'jawaban' => json_encode($jawaban)
    //         ]);
    //     }

    //     $this->session->sess_expiration = 0; // expires in 4 hours
    // }
    // public function save_history_overlapping($id_soal)
    // {
    //     $id_user = $this->session->userdata('user_id');
    //     // $confidences = $this->session->userdata('confidence_id');
    //     // $click = $this->db->query('select * from users where id = ?', $id_user)->row_array();
    //     // $confidences = $this->db->query('SELECT DISTINCT(id) FROM confidence_tag', [$id_soal, $id_user])->row_array();
    //     $jawaban = $this->input->post('jawaban');
    //     $this->db->insert('overlapping_analysis', [
    //         'id_soal' => $id_soal,
    //         'id_user' => $id_user,
    //         'jawaban' => json_decode($jawaban, true),
    //         'status_jawaban' => $this->input->post('condition'),
    //         'waktu' => $this->session->waktu,
    //     ]);
    //     $this->session->sess_expiration = 0; // expires in 4 hours
    //     $this->output_json(['status' => true]);
    // }

    public function save_history_overlapping($id_soal)
    {
        $id_user = $this->session->userdata('user_id');
        $jawaban = $this->input->post('jawaban');
        $tipe_data_jawaban = $this->input->post('tipe_data_jawaban');
        $status_jawaban_tipedata = $this->input->post('status_jawaban_tipedata');
        $status_jawaban_algoritma = $this->input->post('status_jawaban_algoritma');

        $click = $this->db->query('select * from overlapping_analysis where id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();

        $decoded_jawaban = json_decode($jawaban, true);
        if ($decoded_jawaban === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle kesalahan jika data jawaban tidak valid
            log_message('error', 'Data jawaban tidak valid: ' . $jawaban);
            return;
        }

        $this->db->insert('overlapping_analysis', [
            'id_soal' => $id_soal,
            'id_user' => $id_user,
            'jawaban' => $jawaban,
            'tipe_data_jawaban' => $tipe_data_jawaban,
            'status_jawaban' => $this->input->post('condition'),
            'status_jawaban_tipedata' => $status_jawaban_tipedata,
            'status_jawaban_algoritma' => $status_jawaban_algoritma,
            'waktu' => $this->session->waktu,
        ]);

        $this->session->sess_expiration = 0; // expires in 4 hours
        $this->output_json(['status' => true]);
    }


    public function hapus($iduser, $idsoal)
    {
        $this->ujian->hapusData($iduser, $idsoal);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('manajemenhistory');
    }
}
