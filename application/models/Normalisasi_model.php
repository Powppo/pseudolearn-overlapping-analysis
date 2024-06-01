<?php

class Normalisasi_model extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('tb_crawling')->result_array();
    }
}

