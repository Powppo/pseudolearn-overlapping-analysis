<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan_model extends CI_Model
{

	public function getDataCondition($kelas = 999, $level = 999)
	{
		// $conditions =$this->db->query("
		// 	SELECT id_user,id_soal, count(*) as jumlah_langkah 
		// 	FROM `conditions` 
		// 	GROUP by id_soal,id_user
		// 	LIMIT 15;
		// ");

		$this->db->select('c.id, c.id_user, COUNT(c.id_user) as jumlah_langkah,SEC_TO_TIME(SUM(TIME_TO_SEC(c.waktu))) as total_waktu, m.nim, m.nama, t.post_test, t.pre_test, k.nama as nama_kelas');
		$this->db->from('conditions c');
		$this->db->join('users u', 'u.id = c.id_user');
		$this->db->join('mahasiswa m', 'u.username = m.nim');
		$this->db->join('test_nilai t', 't.id_user = c.id_user', 'left');
		$this->db->join('tb_kelas k', 'm.id_kelas = k.id_kelas', 'left');
		$this->db->join('tb_soal s', 's.id_soal = c.id_soal');
		if ($kelas != 999) {
			$this->db->where('m.id_kelas', $kelas);
		}

		if ($level != 999) {
			$this->db->where('s.id_level', $level);
		}
		$this->db->group_by('c.id_user');

		$query = $this->db->get();
		$conditions = $query->result_array();
		foreach ($conditions as $key => $value) {
			// $times = $this->getTime2($value['id_user']);
			// $totalTime = 0;
			// foreach ($times as $tKey => $time) {
			// $totalTime += $this->timeToSeconds($time['waktu']);
			// }
			$totalTime = $this->timeToSeconds($value['total_waktu']);
			$conditions[$key]['jumlah_waktu'] = $totalTime;

			//test random 
			//$conditions[$key]['jumlah_langkah'] = rand(10,100);
		}
		return $conditions;
	}

	function getTime($id_soal, $id_user)
	{
		$this->db->select('waktu');
		$this->db->from('conditions');
		$this->db->where('id_soal', $id_soal);
		$this->db->where('id_user', $id_user);
		$query = $this->db->get()->result_array();
		return $query;
	}
	function getTime2($id_user)
	{
		$this->db->select('waktu');
		$this->db->from('conditions');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get()->result_array();
		return $query;
	}

	function timeToSeconds($time)
	{
		// Pecah waktu menjadi jam, menit, dan detik
		$parts = explode(':', $time);

		// Konversi setiap bagian waktu menjadi detik
		$hours = (int)$parts[0] * 3600; // 1 jam = 3600 detik
		$minutes = (int)$parts[1] * 60; // 1 menit = 60 detik
		$seconds = (int)$parts[2];

		// Jumlahkan semua bagian waktu menjadi total detik
		$totalSeconds = $hours + $minutes + $seconds;

		return $totalSeconds;
	}

	function parseToArray($data, $index)
	{
		$result = [];
		foreach ($data as $key => $value) {
			$result[$key] = $value[$index];
		}

		return $result;
	}

	function getRandomBaseOncluster($data, $cluster, $loop)
	{
		$result = [];
		// Perulangan untuk mengambil data secara acak sebanyak 5 kali
		for ($i = 0; $i < $loop; $i++) {
			// Mengambil indeks acak dari array jumlah_langkah
			$randomIndex = array_rand($data['jumlah_langkah'], $cluster);
			// Mengambil nilai dari array jumlah_langkah berdasarkan indeks yang dipilih secara acak
			$ackLangkah = [];
			for ($k = 0; $k < $cluster; $k++) {
				$ackLangkah[$k] = $data['jumlah_langkah'][$randomIndex[$k]];
			}
			$selectedLangkah = $ackLangkah;

			// Mengambil nilai dari array jumlah_waktu berdasarkan indeks yang dipilih secara acak
			$ackWaktu = [];
			for ($v = 0; $v < $cluster; $v++) {
				$ackWaktu[$v] = $data['jumlah_waktu'][$randomIndex[$v]];
			}
			$selectedWaktu = $ackWaktu;

			$result['jumlah_langkah'][$i] = $selectedLangkah;
			$result['jumlah_waktu'][$i] = $selectedWaktu;
		}
		return $result;
	}

	function calCost($data, $random, $indexs, $variable, $cluster)
	{
		$var = [];
		//penataan variable
		$nr = -1;
		$fr = 0;
		foreach ($indexs as $indexsKey => $indexsValue) {
			$nr++;
			$no = 0;
			foreach ($data[$indexsValue] as $dataKey => $dataValue) {
				$fr++;
				$no++;
				$vvn = 0;
				for ($v = 0; $v < $cluster; $v++) {
					$vvn++;
					$x1 = $random[$indexsValue][0][$v];
					$x2 = $dataValue;
					$var[$variable[$nr]]['1'][$vvn] = $x1;
					$var[$variable[$nr]]['2'][$no] = $x2;
				}
			}
		}

		$fr = $fr / 2;
		$cost = [];
		$vcn = 0;
		for ($vc = 0; $vc < $cluster; $vc++) {
			$vcn++;
			for ($z = 1; $z <= $fr; $z++) {
				$vr = 0;
				foreach ($variable as $variableKey => $varibleValue) {
					$vr++;
					$xy = [];

					foreach ($variable as $variableKey1 => $varibleValue1) {
						$xyn = 0;
						foreach ($variable as $variableKey2 => $varibleValue2) {
							$xyn++;
							if ($xyn > 1) {
								$xy[$varibleValue1][$xyn] = $var[$varibleValue1][$xyn][$z];
							} else {
								$xy[$varibleValue1][$xyn] = $var[$varibleValue1][$xyn][$vcn];
							}
						}
					}
					$cost['cost-' . $vcn . '-' . $z] = $xy;
					$cost['cost-' . $vcn . '-' . $z]['hasil'] = 0;
				}
			}
		}

		foreach ($cost as $costKey => $costValue) {
			$hasil = 0;
			$temp = [];
			foreach ($variable as $variableKey3 => $varibleValue3) {
				$tempNo = 0;
				foreach ($cost[$costKey][$varibleValue3] as $cck3Key => $cck3Value) {
					$tempNo++;
					$temp[$varibleValue3 . $tempNo] = $cck3Value;
				}
			}
			$hasil = $this->calSqrtOk($temp);
			$cost[$costKey]['hasil'] = $hasil;
		}
		$result = [];
		$result['cost'] = $cost;
		$result['kedekatan'] = [];
		$result['cluster'] = [];

		for ($zx = 1; $zx <= $fr; $zx++) {
			$tempZx = [];
			$vbx = 0;
			for ($vb = 0; $vb < $cluster; $vb++) {
				$vbx++;
				$tempZx[$vb] = $cost['cost-' . $vbx . '-' . $zx]['hasil'];
			}
			$result['kedekatan'][$zx]['data'] = $tempZx;
			$hasil = min($tempZx);
			$result['kedekatan'][$zx]['hasil'] = $hasil;
			$result['cluster'][$zx] = array_search($hasil, $tempZx) + 1;
		}
		return $result;
	}

	function calSqrtOk($data)
	{
		// Deklarasi variabel
		$x1 = $data['x1'];
		$y1 = $data['y1'];

		$x2 = $data['x2'];
		$y2 = $data['y2'];

		// Menghitung jumlah kuadrat perbedaan
		$sum_of_squares = pow($x1 - $x2, 2) + pow($y1 - $y2, 2);

		// Menghitung akar kuadrat
		$result = round(sqrt($sum_of_squares), 7); // Pembulatan 7 digit

		return $result;
	}
	function updateTestNilai($nilai)
	{
		$data = $this->db->get_where('test_nilai', ['id_user' => $nilai['id_user']])->row_array();
		if ($data) {
			$this->db->where('id_user', $nilai['id_user']);
			$this->db->update('test_nilai', $nilai);
		} else {
			$this->db->insert('test_nilai', $nilai);
		}
	}
	function getKelas()
	{
		return $this->db->get('tb_kelas')->result();
	}
	function getLevel()
	{
		return $this->db->get('tb_level')->result();
	}
}
