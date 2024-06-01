<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Essay_jawaban_siswa_model extends CI_Model
{
    public function getDataEssay($id_essay)
    {
        $this->datatables->select('a.id_essay, a.id_soal, a.id_level, a.bobot, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, a.status, d.nama, b.judul');
        $this->datatables->from('tb_essay a');
        $this->datatables->join('tb_soal b', 'b.id_soal=a.id_soal');
        $this->datatables->join('tb_level d', 'd.id_level=a.id_level');
        if ($id_essay !== null) {
            $this->datatables->where('a.id_level', $id_essay);
        }
        return $this->datatables->generate();
    }

    public function getEssaySoal($id)
    {   
        $soalessay = $this->db->query('select * from tb_soal where id_soal = ?', $id)->row();
        return $this->db->query('select * from tb_essay where id_soal = ? union all
        select  * from tb_essay where id_soal != ? and id_soal = ?', [$id, $id, $soalessay->id_soal])->result();
    }

    public function getAllEssay()
    {
        return $this->db->from('tb_essay')
          ->get()
          ->result();
    }

    public function getDataEssayLevel($id_essay)
    {
        $this->datatables->select('a.id_essay, a.essay, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, d.nama');
        $this->datatables->from('tb_essay a');
        return $this->datatables->generate();
    }

    public function getEssayById($id_essay)
    {
        return $this->db->get_where('tb_essay', ['id_essay' => $id_essay])->row();
    }

    public function getDataEssayBaru()
    {
        $this->datatables->select('a.id_essay, a.id_soal, a.id_level, a.bobot, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, d.nama, b.judul');
        $this->datatables->from('tb_essay a');
        $this->datatables->join('tb_soal b', 'b.id_soal=a.id_soal');
        $this->datatables->join('tb_level d', 'd.id_level=a.id_level');
        return $this->datatables->generate();
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
