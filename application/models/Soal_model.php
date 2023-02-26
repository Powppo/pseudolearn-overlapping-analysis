<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{
    public function getDataSoal($id)
    {
        $this->datatables->select('a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, d.nama');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('tb_level d', 'd.id_level=a.id_level');
        if ($id !== null) {
            $this->datatables->where('a.id_level', $id);
        }
        return $this->datatables->generate();
    }

    public function getDataSoalLevel($id)
    {
        $this->datatables->select('a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, d.nama');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('tb_level d', 'd.id_level=a.id_level');
        if ($id !== null) {
            $this->datatables->where('a.id_level', $id);
        }
        return $this->datatables->generate();
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('tb_soal', ['id_soal' => $id])->row();
    }

    public function getMatkulDosen($nip)
    {
        $this->db->select('matkul_id, nama_matkul, id_dosen, nama_dosen');
        $this->db->join('matkul', 'matkul_id=id_matkul');
        $this->db->from('dosen')->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function getAllDosen()
    {
        $this->db->select('*');
        $this->db->from('dosen a');
        $this->db->join('matkul b', 'a.matkul_id=b.id_matkul');
        return $this->db->get()->result();
    }
}
