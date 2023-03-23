<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{

    public function getDataKelas()
    {
        $this->datatables->select('*');
        $this->datatables->from('tb_kelas');
        return $this->datatables->generate();
    }

    public function getKelasById($id)
    {
        return $this->db->get_where('tb_kelas', ['id_kelas' => $id])->row();
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

    public function getAllKelas()
    {
        $this->db->select('*');
        $this->db->from('tb_kelas');
        return $this->db->get()->result();
    }

    public function getListUjian2()
    {
        $id_user = $this->session->userdata('user_id');
        return $this->db->query("select id_level, nama, image, bts_nilai, (select sum(nilai) from nilai where id_user = ?) as nilai from tb_level", $id_user)->result();
    }
}
