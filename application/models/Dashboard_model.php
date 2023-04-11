<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function total($table)
    {
        $query = $this->db->get($table)->num_rows();
        return $query;
    }

    public function get_where($table, $pk, $id, $join = null, $order = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($pk, $id);

        if($join !== null){
            foreach($join as $table => $field){
                $this->db->join($table, $field);
            }
        }
        
        if($order !== null){
            foreach($order as $field => $sort){
                $this->db->order_by($field, $sort);
            }
        }

        $query = $this->db->get();
        return $query;
    }

    function get_confidence_ys()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('c.confidence', 'yakin');
        $this->db->where('c.status_jawaban', 'salah');
        $this->db->where('s.id_level', '5');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_yb()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '5');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tys()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'salah');
        $this->db->where('s.id_level', '5');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tyb()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '5');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_ys2()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('c.confidence', 'yakin');
        $this->db->where('c.status_jawaban', 'salah');
        $this->db->where('s.id_level', '6');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_yb2()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '6');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tys2()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'salah');
        $this->db->where('s.id_level', '6');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tyb2()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '6');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_ys3()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('c.confidence', 'yakin');
        $this->db->where('c.status_jawaban', 'salah');
        $this->db->where('s.id_level', '7');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_yb3()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '7');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tys3()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'salah');
        $this->db->where('s.id_level', '7');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tyb3()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '7');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_ys4()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('c.confidence', 'yakin');
        $this->db->where('c.status_jawaban', 'salah');
        $this->db->where('s.id_level', '8');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_yb4()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '8');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tys4()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'salah');
        $this->db->where('s.id_level', '8');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tyb4()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '8');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_ys5()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('c.confidence', 'yakin');
        $this->db->where('c.status_jawaban', 'salah');
        $this->db->where('s.id_level', '9');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_yb5()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_yakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '9');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tys5()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_salah");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'salah');
        $this->db->where('s.id_level', '9');
        return $this->db
          ->get()
          ->result();
    }

    function get_confidence_tyb5()
    {
        $this->db->group_by('s.id_level');
        $this->db->select('c.confidence, c.status_jawaban, s.judul AS judul');
        $this->db->select("count(*) as total_tidakyakin_benar");
        $this->db->from('conditions c');
        $this->db->join('tb_soal s', 'c.id_soal = s.id_soal');
        $this->db->where('confidence', 'tidak yakin');
        $this->db->where('status_jawaban', 'benar');
        $this->db->where('s.id_level', '9');
        return $this->db
          ->get()
          ->result();
    }
}