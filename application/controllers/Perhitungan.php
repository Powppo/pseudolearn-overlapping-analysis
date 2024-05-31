<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{

	protected $hasilNya;
	protected $randomNya;
	protected $totalNya;
	protected $iterasi = 2;
	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->user = $this->ion_auth->user()->row();
		$this->load->model('Perhitungan_model', 'perhitungan');
	}

	//PERHITUNGAN BARU
	function indexDebug($cluster)
	{
		if ($cluster < 2) {
			echo "Cluster tidak boleh kurang dari 2";
			exit();
		}
		$dataCondition = $this->perhitungan->getDataCondition();
		$normalisasi = $this->normalisasiData($dataCondition);
		$data = $this->perhitunganMedoid($dataCondition, $normalisasi, $cluster);
		// print_r($data);
		// exit();
		echo "<table border='1' cellpadding=5>";
		echo "<tr>";
		echo "<td valign='top'><pre>";
		print_r($data);
		echo "</pre></td>";
		echo "<td valign='top'>Memory Usage : " . memory_get_usage() . "</td>";
		echo "<td valign='top'>Allowed Memory : " . memory_get_peak_usage() . "</td></tr>";
		echo "</table>";
	}
	function index()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Clustering',
			'subjudul' => 'Perhitungan',
		];
		$hitung = [];
		$clustering = $this->input->get('clustering');
		$kelas = $this->input->get('kelas');
		$level = $this->input->get('level');
		$hitung['clustering'] = $clustering;
		$hitung['dataConditions'] = $this->perhitungan->getDataCondition($kelas, $level);
		$hitung['dataKelas'] = $this->perhitungan->getKelas();
		$hitung['dataLevel'] = $this->perhitungan->getLevel();
		if ($clustering != null) {
			if ($hitung['dataConditions']) {
				$normalisasi = $this->normalisasiData($hitung['dataConditions']);
				$perhitungan = $this->perhitunganMedoid($hitung['dataConditions'], $normalisasi, $clustering);
				$hitung['jumlahLangkah'] = array_column($hitung['dataConditions'], 'jumlah_langkah', 'id_user');
				$hitung['jumlahWaktu'] = array_column($hitung['dataConditions'], 'jumlah_waktu', 'id_user');
				$hitung['perhitungan'] = $perhitungan;
				$hitung['mahasiswaCluster'] = $this->groupingMahasiswaCluster($hitung['dataConditions'], $perhitungan['arrCluster']);
			}
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('perhitungan', $hitung);
			$this->load->view('_templates/dashboard/_footer.php');
		} else {
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('perhitungan', $hitung);
			$this->load->view('_templates/dashboard/_footer.php');
		}
	}

	function normalisasiData($dataCondition)
	{
		error_reporting(0);
		$arrJumlahLangkah = array_column($dataCondition, 'jumlah_langkah');
		$arrJumlahWaktu = array_column($dataCondition, 'jumlah_waktu');
		$minJumlahLangkah = min($arrJumlahLangkah);
		$maxJumlahLangkah = max($arrJumlahLangkah);
		$minJumlahWaktu = min($arrJumlahWaktu);
		$maxJumlahWaktu = max($arrJumlahWaktu);
		//normalisasi data conditions
		$normalisasi = [];
		foreach ($dataCondition as $condition) {
			$normalisasi[$condition['id_user']]['id_user'] = $condition['id_user'];
			$normalisasi[$condition['id_user']]['jumlah_langkah'] = number_format(($condition['jumlah_langkah'] - $minJumlahLangkah) / ($maxJumlahLangkah - $minJumlahLangkah), 4);
			$normalisasi[$condition['id_user']]['jumlah_waktu'] = number_format(($condition['jumlah_waktu'] - $minJumlahWaktu) / ($maxJumlahWaktu - $minJumlahWaktu), 4);
		}
		return $normalisasi;
	}
	function perhitunganMedoid($dataCondition, $normalisasi, $cluster)
	{
		$medoids = [];
		for ($medoid = 0; $medoid < 2; $medoid++) {
			$random = array_rand($normalisasi, $cluster);
			// hitung jarak masing" objek ke medoid 
			$jarak = [];
			foreach ($normalisasi as $key => $value) {
				foreach ($random as $randomKey => $randomVal) {
					$v = $normalisasi[$randomVal];
					$jarak[$key][$randomKey] = sqrt(pow($value['jumlah_langkah'] - $v['jumlah_langkah'], 2) + pow($value['jumlah_waktu'] - $v['jumlah_waktu'], 2));
				}
				//get minimum distance
				$jarak[$key]['cluster'] = array_search(min($jarak[$key]), $jarak[$key]) + 1;
				$jarak[$key]['id_user'] = $key;
				$jarak[$key]['jumlah_langkah'] = $value['jumlah_langkah'];
				$jarak[$key]['jumlah_waktu'] = $value['jumlah_waktu'];
			}
			$medoids[] = [
				'random' => $random,
				'jarak' => $jarak,
			];
		}

		$clusterMedoid1 = array_column($medoids[0]['jarak'], 'cluster', 'id_user');
		$clusterMedoid2 = array_column($medoids[1]['jarak'], 'cluster', 'id_user');

		//cek apakah cluster medoid 1 dan cluster medoid 2 berbeda
		if ($clusterMedoid1 != $clusterMedoid2) {
			$this->iterasi += 2;
			return $this->perhitunganMedoid($dataCondition, $normalisasi, $cluster);
		} else {
			return [
				'iterasi' => $this->iterasi,
				'medoids' => $medoids,
				'arrCluster' => $clusterMedoid1,
			];
		}
	}
	function groupingMahasiswaCluster($dataCondition, $arrCluster)
	{
		$grouping = [];
		foreach ($dataCondition as $condition) {
			$grouping[$arrCluster[$condition['id_user']]][] = $condition;
		}
		ksort($grouping);
		return $grouping;
	}
	//END PERHITUNGAN BARU


	//perhitungan yang lama
	public function index_old()
	{
		$data = [
			'user' => $this->user,
			'judul'	=> 'Clustering',
			'subjudul' => 'Perhitungan',
		];
		$hitung = [];
		$hitung['conditions'] = $this->perhitungan->getDataCondition();
		if ($this->input->get('clustering') != null) {
			$result = $this->hitungCluster($hitung, 1, 2, 1, 2);
			$hitung['result'] = $result['data'];
			$hitung['random'] = $result['random'];
			$hitung['total'] = $result['total'];
			$indexs = ['jumlah_langkah', 'jumlah_waktu'];
			$hitung['indexs'] = $indexs;
			// $encode = true;
			// if ($encode) $test = json_encode($result['random']);
			// $this->output->set_content_type('application/json')->set_output($test);

			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('perhitungan', $hitung);
			$this->load->view('_templates/dashboard/_footer.php');
		} else {
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('perhitungan', $hitung);
			$this->load->view('_templates/dashboard/_footer.php');
		}
	}

	function hitungCluster($hitung, $start, $loop, $index1, $index2)
	{
		$result = [];
		$randomArr = [];
		$indexs = ['jumlah_langkah', 'jumlah_waktu'];
		$arr = [];
		foreach ($indexs as $key => $value) {
			$arr[$value] = $this->perhitungan->parseToArray($hitung['conditions'], $value);
		}

		$variable = ['x', 'y']; //x adalah langkah, y adalah waktu
		for ($i = $start; $i <= $loop; $i++) {
			$random = $this->perhitungan->getRandomBaseOncluster($arr, $this->input->get('clustering'), 1);
			$varSqrt = $this->perhitungan->calCost($arr, $random, $indexs, $variable, $this->input->get('clustering'));
			$result[$i] = $varSqrt;
			$randomArr[$i] = $random;
		}
		$this->randomNya[] = $randomArr;
		$this->hasilNya[] = $result;

		if ($this->compareArrays($result[$index1], $result[$index2])) {
			$lastTen = [];
			$end = count($this->hasilNya) - 1;
			$this->totalNya = $end;
			$lastTen['data'] = array_slice($this->hasilNya, -1);
			//return $this->hasilNya[$end];
			$lastTen['random'] = array_slice($this->randomNya, -1);
			$lastTen['total'] = $this->totalNya;
			return $lastTen;
		}
		$start += count($result);
		$loop += 2;
		$index1 += 2;
		$index2 += 2;
		return $this->hitungCluster($hitung, $start, $loop, $index1, $index2);
	}

	function compareArrays($array1, $array2)
	{
		sort($array1);
		sort($array2);
		return $array1 == $array2;
	}

	public function add()
	{
		// Menghitung ekspresi SQRT((18-2)^2+(22-7)^2+(2-7)^2+(1-2)^2)

		// Deklarasi variabel
		$x1 = 37;
		$y1 = 102;

		$x2 = 10;
		$y2 = 58;



		// Menghitung jumlah kuadrat perbedaan
		$sum_of_squares = pow($x1 - $x2, 2) + pow($y1 - $y2, 2);

		// Menghitung akar kuadrat
		$result = round(sqrt($sum_of_squares), 7); // Pembulatan 7 digit

		// Menampilkan hasil
		echo "Hasil perhitungan: " . $result;
	}

	// private function recursiveFunction($array1, $array2) {
	//     // Jika kedua array sama, maka berhenti
	//     if ($this->compareArrays($array1, $array2)) {
	//         return "Array sama ditemukan: " . json_encode($array1);
	//     }

	//     // Panggil fungsi lain untuk mendapatkan array baru
	//     $newArray1 = generateArray($array1);
	//     $newArray2 = generateArray($array2);

	//     // Panggil fungsi rekursif kembali dengan array baru
	//     return recursiveFunction($newArray1, $newArray2);
	// }
}
