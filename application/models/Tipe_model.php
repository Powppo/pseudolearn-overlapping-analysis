<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe_model extends CI_Model
{

    public function getDataTipe()
    {
        $this->datatables->select('*');
        $this->datatables->from('tipe_data');
        return $this->datatables->generate();
    }

    public function getTipeById($id)
    {
        return $this->db->get_where('tipe_data', ['id' => $id])->row();
    }

    public function getAllTipe()
    {
        $this->db->select('*');
        $this->db->from('tipe_data');
        return $this->db->get()->result();
    }
}
