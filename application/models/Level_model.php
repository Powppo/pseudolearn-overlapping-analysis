<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_model extends CI_Model
{

    public function getDataLevel($id, $dosen)
    {
        $this->datatables->select('id_level, nama, image, bts_nilai, feedback_data_type, feedback_input, feedback_process, feedback_output, CONCAT(feedback_data_type, feedback_input, feedback_process, feedback_output) AS feedback');
        $this->datatables->from('tb_level');
        return $this->datatables->generate();
    }

    // public function getAllDataLevel()
    // {
    //     $this->datatables->select('*');
    //     $this->datatables->from('tb_level');
    //     return $this->db->get()->result_array();
    // }

    public function getLevelById($id)
    {
        return $this->db->get_where('tb_level', ['id_level' => $id])->row();
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

    public function getAlllevel()
    {
        $this->db->select('*');
        $this->db->from('tb_level');
        return $this->db->get()->result();
    }

    public function getListUjian2()
    {
        $id_user = $this->session->userdata('user_id');
        $query =  $this->db->query("select id_level, nama, image, bts_nilai, (select sum(nilai) from nilai where id_user = ?) as nilai from tb_level", $id_user)->result();
        $data = [];
        //assign array
        foreach ($query as $key => $value) 
        {
            $data[$key]['id_level'] = $value->id_level;
            $data[$key]['nama'] = $value->nama;
            $data[$key]['image'] = $value->image;
            $data[$key]['bts_nilai'] = $value->bts_nilai;
            $data[$key]['nilai'] = $value->nilai;
        }
        //checkvalidate
        foreach ($data as $dataKey => $dataValue) 
        {
            $checkSoal = $this->db->query('select count(*) as total from tb_soal where id_level='.$dataValue['id_level'].'')
            ->result_array();
            $hasilPengerjaan = $this->db->query('select count(*) as total from nilai where id_level='.$dataValue['id_level'].' and id_user='.$id_user.'')
            ->result_array();
            $data[$dataKey]['soal'] = $checkSoal[0]['total'];
            $data[$dataKey]['hasil'] = $hasilPengerjaan[0]['total'];
        }
        return $data;
    }
}
