-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 04:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pseudolearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `soal` longtext NOT NULL,
  `judul` varchar(255) NOT NULL,
  `opsi_a` longtext DEFAULT NULL,
  `opsi_b` longtext DEFAULT NULL,
  `opsi_c` longtext DEFAULT NULL,
  `opsi_d` longtext DEFAULT NULL,
  `opsi_e` longtext DEFAULT NULL,
  `opsi_f` longtext DEFAULT NULL,
  `opsi_g` longtext DEFAULT NULL,
  `opsi_h` longtext DEFAULT NULL,
  `opsi_i` longtext DEFAULT NULL,
  `opsi_j` longtext DEFAULT NULL,
  `opsi_k` longtext DEFAULT NULL,
  `opsi_l` longtext DEFAULT NULL,
  `opsi_m` longtext DEFAULT NULL,
  `opsi_n` longtext DEFAULT NULL,
  `opsi_o` longtext DEFAULT NULL,
  `urut_a` varchar(255) DEFAULT NULL,
  `urut_b` varchar(255) DEFAULT NULL,
  `urut_c` varchar(255) DEFAULT NULL,
  `urut_d` varchar(255) DEFAULT NULL,
  `urut_e` varchar(255) DEFAULT NULL,
  `urut_f` varchar(255) DEFAULT NULL,
  `urut_g` varchar(255) DEFAULT NULL,
  `urut_h` varchar(255) DEFAULT NULL,
  `urut_i` varchar(255) DEFAULT NULL,
  `urut_j` varchar(255) DEFAULT NULL,
  `urut_k` varchar(255) DEFAULT NULL,
  `urut_l` varchar(255) DEFAULT NULL,
  `urut_m` varchar(255) DEFAULT NULL,
  `urut_n` varchar(255) DEFAULT NULL,
  `urut_o` varchar(255) DEFAULT NULL,
  `clue_a` varchar(255) DEFAULT NULL,
  `clue_b` varchar(255) DEFAULT NULL,
  `clue_c` varchar(255) DEFAULT NULL,
  `clue_d` varchar(255) DEFAULT NULL,
  `clue_e` varchar(255) DEFAULT NULL,
  `clue_f` varchar(255) DEFAULT NULL,
  `clue_g` varchar(255) DEFAULT NULL,
  `clue_h` varchar(255) DEFAULT NULL,
  `clue_i` varchar(255) DEFAULT NULL,
  `clue_j` varchar(255) DEFAULT NULL,
  `clue_k` varchar(255) DEFAULT NULL,
  `clue_l` varchar(255) DEFAULT NULL,
  `clue_m` varchar(255) DEFAULT NULL,
  `clue_n` varchar(255) DEFAULT NULL,
  `clue_o` varchar(255) DEFAULT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) DEFAULT NULL,
  `variable_1` varchar(100) DEFAULT NULL,
  `variable_2` varchar(100) DEFAULT NULL,
  `variable_3` varchar(100) DEFAULT NULL,
  `variable_4` varchar(100) DEFAULT NULL,
  `variable_5` varchar(100) DEFAULT NULL,
  `variable_6` varchar(100) DEFAULT NULL,
  `variable_7` varchar(100) DEFAULT NULL,
  `variable_8` varchar(100) DEFAULT NULL,
  `jenis_data_v1` varchar(100) DEFAULT NULL,
  `jenis_data_v2` varchar(100) DEFAULT NULL,
  `jenis_data_v3` varchar(100) DEFAULT NULL,
  `jenis_data_v4` varchar(100) DEFAULT NULL,
  `jenis_data_v5` varchar(100) DEFAULT NULL,
  `jenis_data_v6` varchar(100) DEFAULT NULL,
  `jenis_data_v7` varchar(100) DEFAULT NULL,
  `jenis_data_v8` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `id_level`, `bobot`, `soal`, `judul`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `opsi_f`, `opsi_g`, `opsi_h`, `opsi_i`, `opsi_j`, `opsi_k`, `opsi_l`, `opsi_m`, `opsi_n`, `opsi_o`, `urut_a`, `urut_b`, `urut_c`, `urut_d`, `urut_e`, `urut_f`, `urut_g`, `urut_h`, `urut_i`, `urut_j`, `urut_k`, `urut_l`, `urut_m`, `urut_n`, `urut_o`, `clue_a`, `clue_b`, `clue_c`, `clue_d`, `clue_e`, `clue_f`, `clue_g`, `clue_h`, `clue_i`, `clue_j`, `clue_k`, `clue_l`, `clue_m`, `clue_n`, `clue_o`, `created_on`, `updated_on`, `variable_1`, `variable_2`, `variable_3`, `variable_4`, `variable_5`, `variable_6`, `variable_7`, `variable_8`, `jenis_data_v1`, `jenis_data_v2`, `jenis_data_v3`, `jenis_data_v4`, `jenis_data_v5`, `jenis_data_v6`, `jenis_data_v7`, `jenis_data_v8`) VALUES
(32, 5, 20, '<p><span xss=removed> Sebuah tanah berbentuk persegi panjang akan ditanami tanaman bunga. Buatlah algoritma untuk membantu dalam menghitung luas tanah tersebut!</span></p>', 'program hitung_luas_tanah', '<p>END</p>', '<p>read panjang, lebar</p>', '<p>START</p>', '<p>print (luas)</p>', '<p>luas = panjang * lebar</p>', '', '', '', '', '', '', '', '', '', '', 'c', 'b', 'e', 'd', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658812917, 1658812917, 'panjang', 'lebar', '', '', NULL, NULL, NULL, NULL, 'int', 'int', '', '', NULL, NULL, NULL, ''),
(36, 5, 20, '<ol xss=removed><li><span xss=removed>Terdapat sebuah taman berbentuk persegi dengan panjang sisi adalah 14 m. Kemudian akan dibangun sebuah kolam renang didalam taman tersebut berbentuk lingkaran dengan diameter sama dengan panjang sisi. Buatlah algoritma untuk menghitung sisa tanah yang tidak dbangun kolam renang!</span></li></ol>', 'program hitung_sisa_tanah', '<p>luas_taman = sisi*sisi </p>', '<p>END</p>', '<p>luas_lingkaran = phi* (0.5 * sisi)*(0.5*sisi) </p>', '<p>read sisi, phi </p>', '<p>print (luas_sisa) </p>', '<p><span xss=removed>luas_sisa = luas_tman – luas_lingkaran </span></p>', '<p>START</p>', '', '', '', '', '', '', '', '', 'g', 'd', 'a', 'c', 'f', 'e', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1658888351, 1658888351, 'sisi = 14 m', 'phi = 3,14', 'luas_taman', 'luas_lingkaran', 'luas_sisa', '', '', NULL, 'int', 'double', 'float', 'float', 'float', NULL, '', ''),
(38, 5, 20, '<p>Sebuah rumah makan baru telah dbuka di Jl. Borobudur Malang. Berdasarkan peraturan pemerintah daerah maka rumah makan tersebut dikenakan pajak berdasarkan makanan yang dijual. Bantulah pemilik toko untuk menentukan harga yang harus dijual per item produk yang sudah termasuk pajaknya dengan membuatkan algoritmanya!</p>', 'program hitung_harga_jual\r\n', '<p>write \"masukkan besaran prosentase pajak\"</p>', '<p>harga_jual = harga_dasar + pajak</p>', '<p>read harga_dasar</p>', '<p>print \"Harga Jual =\"+harga_jual</p>', '<p>END</p>', '<p>read prosentasi_pajak</p>', '<p>START</p>', '<p>pajak =harga_dasar* (prosentasi_pajak/100)</p>', '<p>write \"masukkan harga dasar produk\"</p>', '<p>print \"Pajak sebesar=\"+pajak</p>', '', '', '', '', '', 'g', 'i', 'c', 'a', 'f', 'h', 'b', 'j', 'd', NULL, 'e', NULL, NULL, NULL, NULL, NULL, 'urut_b', NULL, NULL, NULL, NULL, 'urut_g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658889229, 1659031301, 'harga_jual', 'harga_dasar', 'prosentasi_pajak', 'pajak', '', '', '', '', 'int', 'int', 'int', 'double', '', '', '', ''),
(40, 5, 20, '<p>Pak Budi mempunyai kolam renang berbentuk balok berukuran panjang 10 m, lebar 6 m, dan kedalaman 1,5 m. Sisi bagian dalam kolam renang dikeramik. Luas bagian kolam renang yang dikeramik adalah</p>', 'program hitung_luas_kolam', '<p>read panjang, lebar, tinggi </p>', '<p>print (luas_bagian) </p>', '<p>END</p>', '<p>START  </p>', '<p>luas_bagian = <strong>2 * ((p*l) + (p*t) + (l*t)) </strong></p>', '', '', '', '', '', '', '', '', '', '', 'd', 'a', 'e', 'b', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658889813, 1658889813, 'panjang = 10m', 'lebar = 6m', 'tinggi = 1,5m', 'luas_bagian', '', '', '', NULL, 'int', 'int', 'double', 'double', '', '', '', ''),
(44, 5, 20, '<p>Pak Hari membeli sepeda motor dengan harga 25.000.000 dan dikenakan pajak penjualan sebesar 10%. Uang yang harus dibayar pak Hari sebesar…</p>', 'program hitung_harga_motor', '<p>END</p>', '<p>pajak_jual = pajak*harga_motor </p>', '<p>print (uang_bayar) </p>', '<p>START</p>', '<p>read pajak, harga_motor </p>', '<p>uang_bayar = harga_motor + pajak_jual </p>', '', '', '', '', '', '', '', '', '', 'd', 'e', 'b', 'f', 'c', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658892616, 1658892616, 'pajak = 10%', 'harga_motor ', 'uang_bayar', '', '', '', '', NULL, 'double', 'int', 'int', '', '', '', '', ''),
(45, 6, 20, '<ol><li>Buatlah algoritma untuk menentukan batas umur pembutan SIM kendaraan bermotor </li></ol>', '<p>program hitung_batas_umur</p>', '<p>IF age>=16  </p>', '<p>ELSE</p>', '<p>START</p>', '<p>END</p>', '<p>PRINT \"anda tidak dapat melanjutkan tes pembuatan SIM \"</p>', '<p>PRINT \"masukkan umur anda\"</p>', '<p>PRINT \"anda dapat melanjutkan tes pembuatan SIM\"</p>', '<p>READ age</p>', '<p>ENDIF</p>', '', '', '', '', '', '', 'c', 'f', 'h', 'a', 'g', 'b', 'e', 'i', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658967351, 1659034423, 'age', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(46, 6, 20, '<ol><li>Buatlah algoritma untuk menentukan apakah sebuah bilangan termasuk bilangan positif atau negatif </li></ol>', '<p>program hitung_bilangan</p>', '<p>END</p>', '<p>PRINT \"angka tersebut 0\"</p>', '<p>IF num>0THEN</p>', '<p>PRINT \" angka tersebut adalah negative\"</p>', '<p>START</p>', '<p>READ num</p>', '<p>PRINT \"Masukkan bilangan\"</p>', '<p>PRINT \"angka tersebut adalah positif\"</p>', '<p>ELSE</p>', '<p>ENDIF</p>', '<p>ELSE IF num <0></p>', '', '', '', '', 'e', 'g', 'f', 'c', 'h', 'k', 'd', 'i', 'b', 'j', 'a', NULL, NULL, NULL, NULL, 'urut_a', NULL, NULL, NULL, 'urut_e', NULL, NULL, 'urut_h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658967687, 1659034561, 'num', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(47, 6, 20, '<ol><li>Terdapat sebuah bilangan yaitu a, b,   dan c. Buatlah algoritma untuk menemukan angka terbesar dari 3 bilangan tersebut!</li></ol>', '<p>program hitung_bilangan</p>', '<p>PRINT “Masukkan angka b”</p>', '<p>IF a>b AND a>c THEN</p>', '<p>READ c</p>', '<p>READ b</p>', '<p>START</p>', '<p>END</p>', '<p>ELSE</p>', '<p>PRINT c+ \" lebih besar \"</p>', '<p>ELSE IF b > c THEN</p>', '<p>PRINT b + \" lebih besar \"</p>', '<p>PRINT “Masukkan angka c”</p>', '<p>PRINT “Masukkan angka a”</p>', '<p>ENDIF</p>', '<p>PRINT a+ \"lebih besar\"</p>', '<p>READ a</p>', 'e', 'l', 'o', 'a', 'd', 'k', 'c', 'b', 'n', 'i', 'j', 'g', 'h', 'm', 'f', 'urut_a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_i', NULL, NULL, 'urut_l', NULL, NULL, NULL, 1658968383, 1659033762, 'a, b, c', '', '', '', '', '', '', '', 'int', 'long', 'double', '', '', '', '', ''),
(48, 6, 20, '<p>Sebuah sistem dibuat untuk menentukan pakaian dan peralatan yang harus dibawa pengguna sesuai dengan kondisi cuaca. Jika suhu lebih dari 27<sup>o</sup>C, maka pengguna disarankan memakai dress, kemudian dilakukan pengecekan apakah saat ini hujan, jika hujan maka pengguna disarankan untuk membawa payung, sedangkan jika tidak hujan maka pengguna disarankan untuk memakai sunscreen. Namun, jika suhu kurang dari atau sama dengan 27<sup>o</sup>C, maka pengguna disarankan memakai celana panjang.</p>', '<p>program penentuan_suhu</p>', '<p>PRINT “membawa payung”</p>', '<p>READ suhu</p>', '<p>ELSE</p>', '<p>START</p>', '<p>PRINT “Gunakan pakaian celana panjang”</p>', '<p>PRINT “Gunakan Sunscreen”</p>', '<p>END</p>', '<p>IF suhu>27</p>', '<p>PRINT “masukkan suhu”</p>', '<p>ELSE</p>', '<p>PRINT “Gunakan pakaian dress”</p>', '<p>ENDIF</p>', '<p>IF hujan==’y’</p>', '', '', 'd', 'i', 'b', 'h', 'k', 'm', 'a', 'c', 'f', 'j', 'e', 'l', 'g', NULL, NULL, 'urut_a', NULL, NULL, NULL, NULL, 'urut_f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658968885, 1681702511, 'suhu', 'hujan', '', '', '', '', '', '', 'int', 'char', 'long', 'double', '', '', '', ''),
(49, 6, 20, '<ol><li>Kamu adalah pengendara sepeda motor yang sedang melintas di jalan raya dan bertemu lampu lalu lintas. Susunlah algoritma pseudocode untuk menentukan apa yang harus kamu lakukan untuk setiap kondisi lampu lalu lintas!</li></ol>', '<p>program kondisi_lampu</p>', '<p>break</p>', '<p>case “merah”</p>', '<p>break</p>', '<p>break</p>', '<p>tindakan = “warna yang anda inputkan salah”</p>', '<p>case “kuning”</p>', '<p>tindakan = “jalan”</p>', '<p>PRINT +tindakan</p>', '<p>PRINT “masukkan warna”</p>', '<p>tindakan = “berhenti”</p>', '<p>READ warna</p>', '<p>case “hijau”</p>', '<p>Switch (warna)</p>', '<p>Default</p>', '<p>tindakan = “hati-hati”  </p>', 'i', 'k', 'm', 'b', 'j', 'a', 'f', 'o', 'c', 'l', 'g', 'd', 'n', 'e', 'h', NULL, NULL, NULL, NULL, NULL, 'urut_f', NULL, NULL, NULL, NULL, NULL, 'urut_l', 'urut_m', NULL, NULL, 1658969414, 1659034199, 'warna, tindakan', '', '', '', '', '', '', '', 'string', 'char', 'long', '', '', '', '', ''),
(50, 7, 20, '<p>Buatlah algoritma untuk menampilkan angka dari 1 sampai 100</p>', 'program tampil_angka', '<p>READ counter </p>', '<p>END </p>', '<p>ENDFOR </p>', '<p>FORcounter = 1 TO100 STEP 1 DO </p>', '<p>START</p>', '<p>PRINT counter </p>', '', '', '', '', '', '', '', '', '', 'e', 'a', 'd', 'f', 'c', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658969790, 1658969790, 'counter', '', '', '', '', '', '', NULL, 'int', 'double', 'float', 'string', '', '', '', ''),
(51, 7, 20, '<ol><li>Buatlah algortitma untuk menghitung jumlah bilangan dari 1 sampai 100 </li></ol>', 'program hitung_jumlah', '<p>END</p>', '<p>ENDFOR</p>', '<p>READ counter, sum </p>', '<p>sum=sum+counter </p>', '<p>START</p>', '<p>PRINT sum </p>', '<p>FOR counter=1 TO 100 STEP 1 DO </p>', '', '', '', '', '', '', '', '', 'e', 'c', 'g', 'd', 'b', 'f', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658969999, 1658969999, 'counter', 'sum = 0', '', '', '', '', '', NULL, 'int', 'int', 'double', '', '', '', '', ''),
(52, 7, 20, '<ol><li>Membaca 50 angka dan menemukan jumlah dan rata-ratanya </li></ol>', 'program jumlah_mean', '<p>READ num </p>', '<p>FOR counter=1 TO 50 STEP counter DO </p>', '<p>END </p>', '<p>PRINT \"Enter a Number\" </p>', '<p>START</p>', '<p>PRINT sum </p>', '<p>sum=sum+num </p>', '<p>read counter, sum, num </p>', '<p>ENDFOR </p>', '', '', '', '', '', '', 'e', 'h', 'b', 'd', 'a', 'g', 'i', 'f', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658970471, 1658970471, 'counter', 'sum = 0', 'num', '', '', '', '', NULL, 'int', 'int', 'int', '', '', '', '', ''),
(53, 7, 20, '<ol><li>Buatlah algoritma untuk menjumlahkan bilangan genap pada n bilangan tertentu</li></ol>', 'program jumlah_bilangan_genap', '<p>read counter, sum, num </p>', '<p>IF counter % 2 == 0 THEN </p>', '<p>PRINT sum </p>', '<p>ENDIF</p>', '<p>START</p>', '<p>END</p>', '<p>sum=sum+counter </p>', '<p>FOR counter=1 TO num STEP 1 DO </p>', '<p>PRINT “masukkan angka” </p>', '<p>ENDFOR </p>', '', '', '', '', '', 'e', 'i', 'a', 'h', 'b', 'g', 'd', 'j', 'c', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658971043, 1658971043, 'counter', 'sum=0', 'num ', '', '', '', '', NULL, 'int', 'int', 'int', '', '', '', '', ''),
(54, 7, 20, '<p>Buatlah algoritma untuk menghitung rata-rata dari sebuah bilangan</p>', '<p>program hitung_mean</p>', '<p>ENDFOR</p>', '<p>FORcounter = 1 TObil STEP 1 DO</p>', '<p>START</p>', '<p>PRINT \"rata-rata dari angka adalah :\"+avg</p>', '<p>sum=sum+counter</p>', '<p>read counter,bil,sum,avg</p>', '<p>END</p>', '<p>avg=sum/bil</p>', '', '', '', '', '', '', '', 'c', 'f', 'b', 'e', 'a', 'h', 'd', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658971631, 1677164117, 'bil', 'avg', 'sum', 'counter', '', '', '', '', 'int', 'int', 'int', 'int', 'float', 'double', 'char', ''),
(55, 8, 20, '<ol><li>Mencari jumlah semua elemen dalam array</li></ol>', 'program jml_elemen_array', '<p>ARRAY numbers={65,45,10,7,125} </p>', '<p>sum = sum + numbers[i] </p>', '<p>END</p>', '<p>read i=0, n=5, sum=0 </p>', '<p>START</p>', '<p>PRINT\"jumlah semua angka dalam aray adalah \"+sum </p>', '<p>ENDFOR</p>', '<p>FOR i=0 TO n-1 STEP 1 DO </p>', '', '', '', '', '', '', '', 'e', 'd', 'a', 'h', 'b', 'g', 'f', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660033870, 1660033870, 'numbers', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(56, 8, 20, '<p>Susunlah algoritma pseudocode dalam menentukan kelulusan nilai mahasiswa</p>', '<p>program kelulusan_nilai</p>', '<p>print(\"Masukan nilai UAS ke-\"+i+\": \");</p>', '<p>END</p>', '<p>Read nilaiUAS[] = new int[6]</p>', '<p>if(nilaiUAS[i] > 70)</p>', '<p>START</p>', '<p>for(int i=0; i</p>', '<p>print(\"Nilai ke-\"+i+\" lulus\");</p>', '', '', '', '', '', '', '', '', 'e', 'c', 'f', 'a', 'd', 'g', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660034101, 1681703012, 'nilai', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(57, 8, 20, '<p>Buatlah algoritma pseudocode untuk menghitung nilai rata-rata mahasiswa</p>', '<p>program hitung_nilai</p>', '<p><span>for ( int i = 0; i < nilaiMHS></p>', '<p>rata = total/nilaiMHS;</p>', '<p>Read nilaiUAS[]</p>', '<p>START</p>', '<p>print (rata)</p>', '<p>for ( int i = 0; i < nilaiUAS>', '<p><span>END</span></p>', '<p>total += nilaiMHS</p>', '<p><span>print(\"Masukan nilai UAS ke-\"+i+\"</span><span>: \");</span><code><span></span></code></p>', '', '', '', '', '', '', 'd', 'c', 'f', 'i', 'a', 'h', 'b', 'e', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_c', NULL, NULL, 'urut_f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660035770, 1660487731, 'nilai', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(58, 8, 20, '<ol><li>Menghitung jumlah nilai pada array</li></ol>', '<p>program nilai_array</p>', '<p>sum = sum + angka[i]</p>', '<p>read angka i=0, n=5, sum=0</p>', '<p>START</p>', '<p>ENDFOR</p>', '<p>FOR i=0 TO n-1 STEP 1 DO</p>', '<p>END</p>', '<p>print\"Jumlah nilai pada array adalah\"+sum</p>', '<p>ARRAY angka={65,45,10,7,125}</p>', '', '', '', '', '', '', '', 'c', 'b', 'h', 'e', 'a', 'd', 'g', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_d', NULL, NULL, NULL, 'urut_h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660036067, 1660487784, 'angka', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(59, 8, 20, '<ol><li>Buatlah sebuah program untuk mencari nilai terbesar dalam array</li></ol>', '<p>program nilai_terbesar</p>', '<p>max_num = arr[0];</p>', '<p>print “input angka ke dalam array:”</p>', '<p>START</p>', '<p>for(i = 0; i < arr>', '<p>read arr_count</p>', '<p>END</p>', '<p>max_num = arr[i];</p>', '<p>print “input jumlah elemen array :\"</p>', '<p>print (\"Angka terbesar adalah: \" + max_num);</p>', '<p>if(arr[i] > max_num)</p>', '<p>arr[i] = input.nextInt();</p>', '<p>for(i = 0; i < arr>', '', '', '', 'c', 'h', 'e', 'b', 'l', 'k', 'a', 'd', 'j', 'g', 'i', 'f', NULL, NULL, NULL, 'urut_a', NULL, 'urut_c', NULL, NULL, NULL, NULL, NULL, 'urut_i', NULL, NULL, NULL, NULL, NULL, NULL, 1660036495, 1660487922, 'jumlah', 'angka', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(60, 9, 20, '<ol><li>Buatlah program untuk menghitung pangkat dari suatu angka</li></ol>', '<p>program hitung_pangkat</p>', '<p>if (pangkat == 0)</p>', '<p>Print “masukkan pangkat”</p>', '<p>return angka * hitungPangkat(angka, pangkat - 1)</p>', '<p>START</p>', '<p>Read pangkat</p>', '<p>END</p>', '<p>return angka</p>', '<p>print (hitungPangkat (angka, pangkat));</p>', '<p>Print “masukkan angka=”  </p>', '<p>else</p>', '<p>Read angka</p>', '', '', '', '', 'd', 'i', 'k', 'b', 'e', 'a', 'g', 'j', 'c', 'h', 'f', NULL, NULL, NULL, NULL, 'urut_a', NULL, NULL, NULL, NULL, NULL, NULL, 'urut_h', NULL, NULL, 'urut_k', NULL, NULL, NULL, NULL, 1660036848, 1660488176, 'angka', 'pangkat', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(61, 9, 20, '<ol><li>Pembuatan program untuk menghitung jumlah uang nasabah yang disimpan di Bank setelah mendapatkan bunga selama beberapa tahun dengan menggunakan fungsi rekursif. Pada kasus ini dianggap bunga yang ditentukan oleh bank adalah 11% per tahun. Karena perhitungan bunga adalah bunga <em>saldo, sehingga untuk menghitung besarnya uang setelah ditambah bunga adalah saldo + bunga </em>saldo. Dalam hal ini, besarnya bunga adalah 0.11 <em>saldo, dan saldo dianggap 1 </em>saldo, sehingga 1 <em>saldo + 0.11 </em>saldo dapat diringkas menjadi 1.11 * saldo untuk perhitungan saldo setelah ditambah bunga (dalam setahun).</li></ol>', '<p>program hitung_tabungan</p>', '<p>Read Saldo</p>', '<p>ELSE</p>', '<p>Read saldo, tahun</p>', '<p>print \"lamanya menabung (tahun) : \"</p>', '<p>START</p>', '<p><span>print(\"Jumlah uang </span><span>a</span><span>dalah</span><span>\" + (hitungBunga (saldoAwal, tahun)) )</span></p>', '<p>return saldo;</p>', '<p>print \"masukkan jumlah saldo awal : \"</p>', '<p>END</p>', '<p>Read tahun</p>', '<p><span>return ( 1,11* hitungBunga(saldo, tahun -1 ) ) ;</span></p>', '<p>if (tahun ==0)</p>', '', '', '', 'e', 'c', 'l', 'g', 'b', 'k', 'h', 'a', 'd', 'j', 'f', 'i', NULL, NULL, NULL, 'urut_a', NULL, NULL, NULL, 'urut_e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660037366, 1660488137, 'saldo', 'tahun', '', '', '', '', '', '', 'double', 'int', '', '', '', '', '', ''),
(62, 9, 20, '<p>Dian akan membuat kalung dengan menggunakan manik-manik yang beragam. Terdapat manik-manik dengan warna merah sebanyak 18 buah dan warna biru sebanyak 30 buah. Berapakah jumlah manik-manik terbanyak yang bisa dibuat oleh Dian jika diisyaratkan kalung yang buat dengan jumlah dan warna yang sama?</p>', '<p>program hitung_fpb</p>', '<p>return bil1;</p>', '<p>return cariFPB (bil2, bil1 % bil2);</p>', '<p>read bil1, bil2</p>', '<p>print (\"FPB dari \"+bil1 +\" dan \"+bil2+\" adalah \"+ fpb);</p>', '<p>START</p>', '<p>END</p>', '<p>if (bil2 == 0){</p>', '<p>read fpb = cariFPB(bil1, bil2);</p>', '', '', '', '', '', '', '', 'e', 'c', 'g', 'a', 'b', 'h', 'd', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660037663, 1660487993, 'bil1', 'bil2', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(63, 9, 20, '<p>Dino bisa menyelesaikan satu pekerjaaan setiap 6 menit dan Tio setiap 10 menit. Setelah berapa menitkah keduanya akan dapat menyelesaikan secara bersamaan?</p>', '<p>program hitung_kpk</p>', '<p>return kpk = (bil1 * bil2) / cariFPB</p>', '<p>return cariFPB(bil2, bil1 % bil2);</p>', '<p>read bil1, bil2</p>', '<p>return bil1</p>', '<p>START</p>', '<p>print (\"kpk dari \"+bil1 +\" dan \"+bil2+\" adalah \"+ kpk);</p>', '<p>END</p>', '<p>read cariFPB</p>', '<p>if(bil2 == 0)</p>', '<p>read kpk</p>', '', '', '', '', '', 'e', 'c', 'i', 'd', 'b', 'h', 'a', 'j', 'f', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660039486, 1660487978, 'bil1', 'bil2', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(64, 9, 20, '<ol><li>Buatlah algoritma pseudocode nilai factorial rekursif</li></ol>', '<p>program rekusif_nilai</p>', '<p>return bil</p>', '<p>return (bil * faktorial(bil-1))</p>', '<p>END</p>', '<p>START</p>', '<p>ELSE</p>', '<p>if(bil == 0)</p>', '<p>Read bil</p>', '<p>Print “masukkan bilangan:”</p>', '', '', '', '', '', '', '', 'd', 'h', 'g', 'f', 'a', 'e', 'b', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660039687, 1660488187, 'bilangan', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(66, 9, 20, '<p>Buatlah algoritma pseudocode nilai factorial rekursif</p>', 'program rekusif_nilai', '<p>return bil</p>', '<p>return (bil * faktorial(bil-1))</p>', '<p>END</p>', '<p>START</p>', '<p>ELSE</p>', '<p>if(bil == 0)</p>', '<p>Read bil</p>', '<p>Print “masukkan bilangan:”</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd', 'h', 'g', 'f', 'a', 'e', 'b', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1677115832, 1677115832, 'bilangan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'int', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `fk_soal_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `fk_soal_level` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
