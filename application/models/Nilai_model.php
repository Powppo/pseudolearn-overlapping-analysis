<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    public function getDataNilai($id_nilaiessay)
    {
        // $this->datatables->select('a.id_nilaiessay, a.id_nilai, a.id_user, a.id_soal, a.nilaiessay, c.judul, d.first_name, b.nilai');
        // $this->datatables->from('nilai_essay a');
        // $this->datatables->join('tb_soal c', 'c.id_soal=a.id_soal');
        // $this->datatables->join('nilai b', 'b.id=a.id_nilai');
        // $this->datatables->join('users d', 'd.id=a.id_user');
        // return $this->datatables->generate();
        $this->datatables->select('a.id, a.username, a.first_name, b.nama');
        $this->datatables->from('users a');
        $this->datatables->join('mahasiswa b', 'b.nim=a.username');
        $this->datatables->join('nilai c', 'a.id=c.id_user');
        $this->datatables->join('nilai_essay d', 'a.id=c.id_user');
        $this->datatables->where('a.username !=', 'Administrator');
        $this->datatables->where('a.username !=', 'Dosen');
        $this->db->distinct();
        $this->db->order_by('a.username', 'asc');
        return $this->datatables->generate();
        // return $this->db->query('select * from users where username != Administrator and username != Dosen')->generate();
    }

    public function dataNilai()
    {
        // $this->datatables->select('a.id_nilaiessay, a.id_nilai, a.id_user, a.id_soal, a.nilaiessay, c.judul, d.first_name, b.nilai');
        // $this->datatables->from('nilai_essay a');
        // $this->datatables->join('tb_soal c', 'c.id_soal=a.id_soal');
        // $this->datatables->join('nilai b', 'b.id=a.id_nilai');
        // $this->datatables->join('users d', 'd.id=a.id_user');
        // return $this->datatables->generate();
        $this->datatables->select('a.id, a.username, a.first_name, b.nama');
        $this->datatables->from('users a');
        $this->datatables->where('username !=', 'Administrator');
        $this->datatables->where('username !=', 'Dosen');
        $this->datatables->join('mahasiswa b', 'b.nim=a.username');
        $this->datatables->join('nilai c', 'c.id_user=a.id');
        $this->datatables->join('nilai_essay d', 'd.id_user=a.id');
        return $this->datatables->generate();
        // return $this->db->query('select * from users where username != Administrator and username != Dosen')->generate();
    }

    public function getAllNilai()
    {
        return $this->db->from('nilai_essay')
          ->get()
          ->result();
    }

    public function getNilaiById($id_nilaiessay)
    {
        return $this->db->get_where('users', ['id' => $id_nilaiessay])->row();
    }

    public function getMhs($id_nilaiessay)
    {
        return $this->db->get_where('users', ['id' => $id_nilaiessay])->row();
    }

    public function leaderboard()
    {
        $this->db->select('a.id_nilaiessay, a.id_user, a.id_soal, a.id_essay, SUM(a.nilaiessay) as total_nilai, c.nama');
        $this->db->group_by('id_user');
        $this->db->order_by('total_nilai', 'DESC');
        $this->db->from('nilai_essay a');
        $this->db->join('users b', 'b.id=a.id_user');
        $this->db->join('mahasiswa c', 'c.nim=b.username');
        return $this->db->get()->result_array();
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
