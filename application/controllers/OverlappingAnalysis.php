<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
            'judul'    => 'Overlapping Analysis',
            'subjudul' => 'Analisis Hasil Ujian Mahasiswa',
        ];

        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
            $data['level'] = $this->db->query('select * from tb_level')->result();
        }
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('ujian/overlapping_analysis');
        // $this->load->view('ujian/soal');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail($id_soal)
    {
        $id_kelas = $this->input->post('id_kelas');

        if ($id_kelas) {
            $results = $this->ujian->get_filtered_data($id_soal, $id_kelas);
        } else {
            $results = $this->ujian->detailOverlappingAnalysis($id_soal);
        }

        $data = [
            'user' => $this->user,
            'informasi' => $results,
            'judul' => 'Hasil Overlapping Analysis',
            'subjudul' => 'Analisis Hasil Ujian Mahasiswa',
            'selected_kelas' => $id_kelas, // Tambahkan ini untuk mengatur nilai terpilih pada dropdown
            'id_soal' => $id_soal // Tambahkan ini untuk memastikan $id_soal tersedia di view
        ];

        if ($this->ion_auth->is_admin()) {
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }

        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('ujian/detail_overlapping_analysis');
        $this->load->view('_templates/dashboard/_footer.php');
    }

    public function detail_jawaban($id_soal, $encodedUniqueKey, $id_kelas = 'all')
    {

        $decodedUniqueKey = base64_decode(urldecode($encodedUniqueKey));

        if ($id_kelas == 'all') {
            $results = $this->ujian->getAllMhsOverlappingAnalysis($id_soal, array($decodedUniqueKey));
        } else {
            $results = $this->ujian->detailMhsOverlappingAnalysis($id_soal, array($decodedUniqueKey), $id_kelas);
        }

        $data = [
            'user'      => $this->user,
            'informasi' => $results,
            'judul'    => 'Detail Hasil Overlapping Analysis',
            'subjudul' => 'Analisis Hasil Ujian Mahasiswa',
        ];
        if ($this->ion_auth->is_admin()) {
            //Jika admin maka tampilkan semua matkul
            $data['kelas'] = $this->db->query('select * from tb_kelas')->result();
        }
        $this->load->view('_templates/dashboard/_header.php', $data);
        $this->load->view('ujian/detail_mhs_overlapping_analysis');
        $this->load->view('_templates/dashboard/_footer.php');
    }




    // public function getUsersByAnswer()
    // {
    //     // Ambil data jawaban yang dikirim dari permintaan POST
    //     $jawaban = $this->input->post('jawaban');

    //     // Dekode jawaban menjadi array asosiatif
    //     $jawabanArray = json_decode($jawaban, true);

    //     // Buat array untuk menyimpan ID pengguna berdasarkan jawaban
    //     $userIds = [];

    //     // Loop through each answer type in the provided answer array
    //     foreach ($jawabanArray as $jenis => $data) {
    //         if (isset($data['jawaban'])) {
    //             $selectedAnswer = $data['jawaban'];

    //             // Query database untuk mencari ID pengguna yang memberikan jawaban tertentu
    //             $query = $this->db->select('id_user')
    //                 ->from('log_data')
    //                 ->like('detail_jawaban_tipedata', '"jawaban":"' . $selectedAnswer . '"', 'both')
    //                 ->get();

    //             // Ambil hasil query dan tambahkan ID pengguna ke dalam array userIds
    //             $results = $query->result_array();
    //             foreach ($results as $result) {
    //                 $userIds[] = $result['id_user'];
    //             }
    //         }
    //     }

    //     // Query database untuk mendapatkan informasi pengguna berdasarkan ID
    //     $this->db->select("CONCAT(u.first_name, ' ', u.last_name) AS nama_mahasiswa", FALSE);
    //     $this->db->from('users u');
    //     $this->db->where_in('id', $userIds);
    //     $userData = $this->db->get()->result_array();

    //     // Data yang akan dikirim ke view
    //     $data['users'] = $userData;

    //     // Memuat view yang diinginkan
    //     $this->load->view('_templates/dashboard/_header.php', $data);
    //     $this->load->view('ujian/detail_mhs_overlapping_analysis');
    //     $this->load->view('_templates/dashboard/_footer.php');
    // }




    public function save_history_overlapping($id_soal)
    {
        $id_user = $this->session->userdata('user_id');
        $jawaban = $this->input->post('jawaban');
        $tipe_data_jawaban = $this->input->post('tipe_data_jawaban');
        $status_jawaban_tipedata = $this->input->post('status_jawaban_tipedata');
        $status_jawaban_algoritma = $this->input->post('status_jawaban_algoritma');
        $is_submit = $this->input->post('is_submit');
        $detail_jawaban_algoritma = $this->input->post('detail_jawaban_algoritma');
        $detail_jawaban_tipedata = $this->input->post('detail_jawaban_tipedata');
        $is_submit = $this->input->post('is_submit');
        $click = $this->db->query('select * from log_data where id_soal = ? and id_user = ?', [$id_soal, $id_user])->num_rows();

        $decoded_jawaban = json_decode($jawaban, true);
        if ($decoded_jawaban === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle kesalahan jika data jawaban tidak valid
            log_message('error', 'Data jawaban tidak valid: ' . $jawaban);
            return;
        }

        $this->db->insert('log_data', [
            'id_soal' => $id_soal,
            'id_user' => $id_user,
            'jawaban' => $jawaban,
            'tipe_data_jawaban' => $tipe_data_jawaban,
            'status_jawaban' => $this->input->post('condition'),
            'status_jawaban_tipedata' => $status_jawaban_tipedata,
            'status_jawaban_algoritma' => $status_jawaban_algoritma,
            'detail_jawaban_tipedata' => $detail_jawaban_tipedata,
            'detail_jawaban_algoritma' => $detail_jawaban_algoritma,
            'is_submit' => $is_submit,
            'waktu' => $this->input->post('waktu')
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
