<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian_model extends CI_Model
{

    public function getDataUjian($id)
    {
        $this->datatables->select('a.id_ujian, a.token, a.nama_ujian, b.nama_matkul, a.jumlah_soal, CONCAT(a.tgl_mulai, " <br/> (", a.waktu, " Menit)") as waktu, a.jenis');
        $this->datatables->from('m_ujian a');
        $this->datatables->join('matkul b', 'a.matkul_id = b.id_matkul');
        if ($id !== null) {
            $this->datatables->where('dosen_id', $id);
        }
        return $this->datatables->generate();
    }

    public function getListUjianOld($id, $kelas)
    {
        $this->datatables->select("a.id_ujian, e.nama_dosen, d.nama_kelas, a.nama_ujian, b.nama_matkul, a.jumlah_soal, CONCAT(a.tgl_mulai, ' <br/> (', a.waktu, ' Menit)') as waktu,  (SELECT COUNT(id) FROM h_ujian h WHERE h.mahasiswa_id = {$id} AND h.ujian_id = a.id_ujian) AS ada");
        $this->datatables->from('m_ujian a');
        $this->datatables->join('matkul b', 'a.matkul_id = b.id_matkul');
        $this->datatables->join('kelas_dosen c', "a.dosen_id = c.dosen_id");
        $this->datatables->join('kelas d', 'c.kelas_id = d.id_kelas');
        $this->datatables->join('dosen e', 'e.id_dosen = c.dosen_id');
        $this->datatables->where('d.id_kelas', $kelas);
        return $this->datatables->generate();
    }

    public function getListUjian($id_level)
    {
        $id_user = $this->session->userdata('user_id');
        $this->db->select("a.id_soal, a.judul, l.nama, u.id");
        $this->db->from('tb_soal a');
        $this->db->join('tb_level l', 'a.id_level = l.id_level');
        $this->db->join('history_ujian u', 'u.idsoal = a.id_soal and u.iduser = '.$id_user, 'left');
        $this->db->where('a.id_level', $id_level);
        return $this->db->get()->result();
    }

    public function getUjianById($id)
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('dosen b', 'a.dosen_id=b.id_dosen');
        $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('id_ujian', $id);
        return $this->db->get()->row();
    }

    public function getIdDosen($nip)
    {
        $this->db->select('id_dosen, nama_dosen')->from('dosen')->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function getJumlahSoal($dosen)
    {
        $this->db->select('COUNT(id_soal) as jml_soal');
        $this->db->from('tb_soal');
        $this->db->where('dosen_id', $dosen);
        return $this->db->get()->row();
    }

    public function getIdMahasiswa($nim)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa a');
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    

    public function HslUjian($id, $mhs)
    {
        $this->db->select('*, UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('h_ujian');
        $this->db->where('ujian_id', $id);
        $this->db->where('mahasiswa_id', $mhs);
        return $this->db->get();
    }

    public function getSoal($id)
    {   
        $soal_first = $this->db->query('select * from tb_soal where id_soal = ?', $id)->row();
        return $this->db->query('select * from tb_soal where id_soal = ? union all
        select  * from tb_soal where id_soal != ? and id_level = ?', [$id, $id, $soal_first->id_soal])->result();
        // return $this->db->get()->result();
    }

    public function getSoalNew($id)
    {
        $this->db->select('*');
        $this->db->from('tb_soal');
        $this->db->where('id_level', $id);
        $this->db->order_by('rand()');
        return $this->db->get()->result();
    }

    public function ambilSoal($pc_urut_soal1, $pc_urut_soal_arr)
    {
        $this->db->select("*, {$pc_urut_soal1} AS jawaban");
        $this->db->from('tb_soal');
        $this->db->where('id_soal', $pc_urut_soal_arr);
        return $this->db->get()->row();
    }

    public function getJawaban($id_tes)
    {
        $this->db->select('list_jawaban');
        $this->db->from('h_ujian');
        $this->db->where('id', $id_tes);
        return $this->db->get()->row()->list_jawaban;
    }

    public function getHasilUjian($nip = null)
    {
        $this->datatables->select('b.id_ujian, b.nama_ujian, b.jumlah_soal, CONCAT(b.waktu, " Menit") as waktu, b.tgl_mulai');
        $this->datatables->select('c.nama_matkul, d.nama_dosen');
        $this->datatables->from('h_ujian a');
        $this->datatables->join('m_ujian b', 'a.ujian_id = b.id_ujian');
        $this->datatables->join('matkul c', 'b.matkul_id = c.id_matkul');
        $this->datatables->join('dosen d', 'b.dosen_id = d.id_dosen');
        $this->datatables->group_by('b.id_ujian');
        if ($nip !== null) {
            $this->datatables->where('d.nip', $nip);
        }
        return $this->datatables->generate();
    }

    public function HslUjianById($id, $dt = false)
    {
        if ($dt === false) {
            $db = "db";
            $get = "get";
        } else {
            $db = "datatables";
            $get = "generate";
        }

        $this->$db->select('d.id, a.nama, b.nama_kelas, c.nama_jurusan, d.jml_benar, d.nilai');
        $this->$db->from('mahasiswa a');
        $this->$db->join('kelas b', 'a.kelas_id=b.id_kelas');
        $this->$db->join('jurusan c', 'b.jurusan_id=c.id_jurusan');
        $this->$db->join('h_ujian d', 'a.id_mahasiswa=d.mahasiswa_id');
        $this->$db->where(['d.ujian_id' => $id]);
        return $this->$db->$get();
    }

    public function bandingNilai($id)
    {
        $this->db->select_min('nilai', 'min_nilai');
        $this->db->select_max('nilai', 'max_nilai');
        $this->db->select_avg('FORMAT(FLOOR(nilai),0)', 'avg_nilai');
        $this->db->where('ujian_id', $id);
        return $this->db->get('h_ujian')->row();
    }

    public function getLogAktivitas() {
        $this->db->select("CONCAT(u.first_name, ' ', u.last_name) AS nama", FALSE);
        $this->db->select("u.username as nim, sum(n.nilai) as total_poin, n.nilai as poin, s.soal as studi_kasus, s.judul as sub_soal, u.id as iduser");
        $this->db->from('nilai n');
        $this->db->join('users u', 'u.id = n.id_user');
        $this->db->join('tb_soal s', 's.id_soal = n.id_soal');
        $this->db->group_by('u.id');
        return $this->db->get()->result_array();
    }

    public function detailLogAktivitas($id) {
        $this->db->select('l.nama as levels, s.id_soal as idsoal, n.id_user as iduser, s.soal as studi_kasus, s.judul as sub_soal, n.nilai as poin, SUM(p.jumlah) AS jumlah');
        // $this->db->select_max('c.id');
        $this->db->from('history_percobaan p');
        $this->db->join('nilai n', 'n.id_soal= p.id_soal');
        $this->db->join('tb_level l', 'n.id_level=l.id_level');
        $this->db->join('tb_soal s', 's.id_soal = n.id_soal');
        $this->db->where('n.id_user', $id);
        $this->db->group_by('n.id_user');
        $this->db->group_by('n.id_soal');
        return $this->db->get()->result_array();
    }

    public function get_all_datalog()
    {
        $this->datatables->select("CONCAT(h.first_name, ' ', h.last_name) AS nama", FALSE);
        $this->datatables->select('h.nim, l.nama as levels, sum(n.nilai) as jml_poin, h.poin, h.idsoal, h.iduser, h.studi_kasus, h.sub_soal');
        $this->datatables->from('history_ujian h');
        $this->datatables->join('tb_level l', 'h.id_level=l.id_level');
        $this->datatables->join('nilai n', 'h.idsoal = n.id_soal');
        $this->datatables->group_by('h.iduser');
        return $this->datatables->generate();
    }

    public function detailLogConfidence($id, $id_soal) {
        $this->db->select('s.soal as studi_kasus, s.judul as sub_soal, c.confidence');
        // $this->db->select_max('c.id');
        $this->db->from('tb_soal as s');
        $this->db->join('confidence_tag c', 's.id_soal = c.id_soal');
        $this->db->where('c.id_user', $id);
        $this->db->where('c.id_soal', $id_soal);
        return $this->db->get()->result_array();
    }

    function input_data($data,$table){
		$this->db->insert($table,$data);
        return $this->db->get()->result_array();
	}

    function saverecords($data){
        $table = "confidence_tag";
		$this->db->insert($table,$data);
        return $this->db->get()->result_array();
	}
}
