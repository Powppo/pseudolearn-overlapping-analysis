<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback_model extends CI_Model
{

    public function getDataFeedback()
    {
        $this->datatables->select('*');
        $this->datatables->from('feedback');
        return $this->datatables->generate();
    }

    public function getFeedbackById($id)
    {
        return $this->db->get_where('feedback', ['id_feedback' => $id])->row();
    }


    public function getAllFeedback()
    {
        $this->db->select('*');
        $this->db->from('feedback');
        return $this->db->get()->result_array();
    }

   
}
