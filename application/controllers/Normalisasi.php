<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Essay extends CI_Controller
{

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
        $this->load->model('Normalisasi_model', 'normalisasi');
        $this->form_validation->set_error_delimiters('', '');
    }

    public function Normal()
    {
        $this->load->model('Normalisasi_model');
        $data['datas'] =   $this->Normalisasi_model->get_data();
    }
}