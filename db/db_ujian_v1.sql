-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 04:53 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'mahasiswa', 'Peserta Ujian');

-- --------------------------------------------------------

--
-- Table structure for table `history_ujian`
--

CREATE TABLE `history_ujian` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idsoal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_ujian`
--

INSERT INTO `history_ujian` (`id`, `iduser`, `idsoal`) VALUES
(13, 33, 32),
(14, 33, 36),
(15, 33, 38),
(16, 33, 40),
(17, 33, 44),
(18, 33, 45),
(19, 33, 46),
(20, 33, 47),
(21, 33, 48),
(22, 33, 49),
(23, 33, 50),
(24, 33, 51),
(25, 33, 52),
(26, 33, 53),
(27, 33, 54),
(28, 33, 55),
(29, 33, 59),
(30, 33, 57),
(31, 33, 58);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` char(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `email`, `jenis_kelamin`) VALUES
(1, 'nia', '1234567890', 'nia@mail.com', 'P'),
(13, 'BANGKIT MAULANA CANIAGO', '2131710143', '2131710143@gmail.com', 'L'),
(14, 'EGA FADHILLA FEBRYANA', '2131710072', '2131710072@gmail.com', 'P'),
(15, 'FABLO AIMAR', '2131710118', '2131710118@gmail.com', 'L'),
(16, 'FADLY ULYA SATRIADI', '2131710110', '2131710110@gmail.com', 'L'),
(17, 'FERLY YANUAR PRASETYO', '2131710081', '2131710081@gmail.com', 'L'),
(18, 'FITRAH RAHMADHANI AHMAD', '2131710092', '2131710092@gmail.com', 'L'),
(19, 'HALIM TEGUH SAPUTRO', '2131710122', '2131710122@gmail.com', 'L'),
(20, 'INDAH RETNO IRIANI', '2131710104', '2131710104@gmail.com', 'P'),
(21, 'JATI WAHYU KUSUMA', '2131710139', '2131710139@gmail.com', 'L'),
(22, 'KANSHA MAULIDYA SHYFA', '2131710148', '2131710148@gmail.com', 'P'),
(23, 'KHOSYI NASYWA IMANDA', '2131710103', '2131710103@gmail.com', 'P'),
(24, 'NAFIATUL FADLILAH', '2131710030', '2131710030@gmail.com', 'P'),
(25, 'NANDA SHABRINA PUTRI KURNIA', '2131710064', '2131710064@gmail.com', 'P'),
(26, 'NEDDY PRATAMA WIRYAWAN', '2131710101', '2131710101@gmail.com', 'L'),
(27, 'NUR ALIMAH', '2131710004', '2131710004@gmail.com', 'P'),
(28, 'RAHMAT HIDAYAT', '2131710043', '2131710043@gmail.com', 'L'),
(29, 'RASYID RAZEKA ALAMSYAH', '2131710077', '2131710077@gmail.com', 'L'),
(30, 'RIZQI HENDRA ARDIANSYAH', '2131710145', '2131710145@gmail.com', 'L'),
(31, 'RIZQI ZAMZAMI JAMIL', '2131710089', '2131710089@gmail.com', 'L'),
(32, 'SABILA NADIA ISLAMIA', '2131710046', '2131710046@gmail.com', 'P'),
(33, 'WIRASWANTI RISMANDA PUTRI', '2131710021', '2131710021@gmail.com', 'P'),
(34, 'WISANG GARNIES RINEKSA PANGGALIH', '2131710079', '2131710079@gmail.com', 'L'),
(35, 'ABDURRAHMAN HARITS WUQUFIAN WINARDI', '2141720200', '2141720200@gmail.com', 'L'),
(36, 'AFIFAH SALSABILA YUSWANTI', '2141720118', '2141720118@gmail.com', 'P'),
(37, 'AGILAR GUMILAR', '2141720106', '2141720106@gmail.com', 'L'),
(38, 'AHMAD FATHAN AQIL FA\"IQ', '2141720172', '2141720172@gmail.com', 'L'),
(39, 'ALFAN FARCHI AL-HADI', '2141720084', '2141720084@gmail.com', 'L'),
(40, 'ALFAN OLIVAN', '2141720078', '2141720078@gmail.com', 'L'),
(41, 'ALVINA MARCY SYAKIRAH PERMATA', '2141720017', '2141720017@gmail.com', 'P'),
(42, 'ANANDA GALIH PRATIWI', '2141720045', '2141720045@gmail.com', 'P'),
(43, 'ANDI DWI PRASTYO', '2141720046', '2141720046@gmail.com', 'L'),
(44, 'ANISA RAHMASARI', '2141720216', '2141720216@gmail.com', 'P'),
(45, 'ARHAN WINDU RIZKI PUTRA BUDIANTO', '2141720227', '2141720227@gmail.com', 'L'),
(46, 'ARSYANDA IRZA RABBANI YUARDHINO', '2141720245', '2141720245@gmail.com', 'L'),
(47, 'BAGUS REZKY ADHYAKSA', '2141720210', '2141720210@gmail.com', 'L'),
(48, 'GABRIEL DIMAS WICAKSONO', '2141720181', '2141720181@gmail.com', 'L'),
(49, 'HANS ANDI WIJAYA', '2141720082', '2141720082@gmail.com', 'L'),
(50, 'HILMI MUGHID', '2141720081', '2141720081@gmail.com', 'L'),
(51, 'ILHAM YUDANTYO', '2141720091', '2141720091@gmail.com', 'L'),
(52, 'JUNIAR ANDRA PERMANA', '2141720214', '2141720214@gmail.com', 'L'),
(53, 'MIRABELL JOICE LAURA', '2141720174', '2141720174@gmail.com', 'P'),
(54, 'MOCHAMMAD ZAKY ZAMRONI', '2141720173', '2141720173@gmail.com', 'L'),
(55, 'MOHAMAD EDWIN ISA ALFAIS', '2141720193', '2141720193@gmail.com', 'L'),
(56, 'MUHAMAD SYAROFUL ANAM', '2141720108', '2141720108@gmail.com', 'L'),
(57, 'MUHAMMAD \'ALI MURROFID', '2141720191', '2141720191@gmail.com', 'L'),
(58, 'MUHAMMAD ALI ZULFIKAR', '2141720088', '2141720088@gmail.com', 'L'),
(59, 'RYAN SYAPUTRA ARTY WIJAYA', '2141720089', '2141720089@gmail.com', 'L'),
(60, 'SALWA LABIBAH CANORA', '2141720261', '2141720261@gmail.com', 'P'),
(61, 'SANG RAGA RASENDRIYA WIRAWAN', '2141720240', '2141720240@gmail.com', 'L'),
(62, 'SATIAN FERDIANSYAH', '2141720087', '2141720087@gmail.com', 'L'),
(63, 'WANDA FEBRINA CAHYA', '2141720001', '2141720001@gmail.com', 'P'),
(64, 'ZIEDNY BISMA MUBAROK', '2141720117', '2141720117@gmail.com', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_user`, `id_soal`, `nilai`) VALUES
(13, 29, 32, 20),
(14, 29, 36, 20),
(15, 29, 38, 20),
(16, 29, 40, 20),
(17, 29, 44, 20),
(18, 29, 45, 20),
(19, 29, 46, 20),
(20, 29, 47, 20),
(21, 29, 48, 20),
(22, 29, 49, 20),
(23, 29, 50, 20),
(24, 29, 51, 20),
(25, 29, 52, 20),
(26, 29, 53, 20),
(27, 29, 54, 20),
(28, 29, 55, 20),
(29, 29, 59, 20),
(30, 29, 57, 20),
(31, 29, 58, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bts_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `nama`, `image`, `bts_nilai`) VALUES
(5, 'Level 1: Tipe Data', '319c2796237c7a38cc821ee3db42f592.png', 0),
(6, 'Level 2 : Kondisi', '3a57c909511418c6555c9e69814b402f.png', 100),
(7, 'Level 3 : Perulangan', '709c190835d8bbd49f9cbfc22b899fa4.png', 200),
(8, 'Level 4 : Array', '7c34bf9c1b552edc1c5f051e1d3fc8da.png', 300),
(9, 'Level 5 : Fungsi', '7a51e7c82100586dd1725ee09696ad01.png', 400);

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
  `opsi_a` longtext,
  `opsi_b` longtext,
  `opsi_c` longtext,
  `opsi_d` longtext,
  `opsi_e` longtext,
  `opsi_f` longtext,
  `opsi_g` longtext,
  `opsi_h` longtext,
  `opsi_i` longtext,
  `opsi_j` longtext,
  `opsi_k` longtext,
  `opsi_l` longtext,
  `opsi_m` longtext,
  `opsi_n` longtext,
  `opsi_o` longtext,
  `urut_1` varchar(255) DEFAULT NULL,
  `urut_2` varchar(255) DEFAULT NULL,
  `urut_3` varchar(255) DEFAULT NULL,
  `urut_4` varchar(255) DEFAULT NULL,
  `urut_5` varchar(255) DEFAULT NULL,
  `urut_6` varchar(255) DEFAULT NULL,
  `urut_7` varchar(255) DEFAULT NULL,
  `urut_8` varchar(255) DEFAULT NULL,
  `urut_9` varchar(255) DEFAULT NULL,
  `urut_10` varchar(255) DEFAULT NULL,
  `urut_11` varchar(255) DEFAULT NULL,
  `urut_12` varchar(255) DEFAULT NULL,
  `urut_13` varchar(255) DEFAULT NULL,
  `urut_14` varchar(255) DEFAULT NULL,
  `urut_15` varchar(255) DEFAULT NULL,
  `clue_1` varchar(255) DEFAULT NULL,
  `clue_2` varchar(255) DEFAULT NULL,
  `clue_3` varchar(255) DEFAULT NULL,
  `clue_4` varchar(255) DEFAULT NULL,
  `clue_5` varchar(255) DEFAULT NULL,
  `clue_6` varchar(255) DEFAULT NULL,
  `clue_7` varchar(255) DEFAULT NULL,
  `clue_8` varchar(255) DEFAULT NULL,
  `clue_9` varchar(255) DEFAULT NULL,
  `clue_10` varchar(255) DEFAULT NULL,
  `clue_11` varchar(255) DEFAULT NULL,
  `clue_12` varchar(255) DEFAULT NULL,
  `clue_13` varchar(255) DEFAULT NULL,
  `clue_14` varchar(255) DEFAULT NULL,
  `clue_15` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `id_level`, `bobot`, `soal`, `judul`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `opsi_f`, `opsi_g`, `opsi_h`, `opsi_i`, `opsi_j`, `opsi_k`, `opsi_l`, `opsi_m`, `opsi_n`, `opsi_o`, `urut_1`, `urut_2`, `urut_3`, `urut_4`, `urut_5`, `urut_6`, `urut_7`, `urut_8`, `urut_9`, `urut_10`, `urut_11`, `urut_12`, `urut_13`, `urut_14`, `urut_15`, `clue_1`, `clue_2`, `clue_3`, `clue_4`, `clue_5`, `clue_6`, `clue_7`, `clue_8`, `clue_9`, `clue_10`, `clue_11`, `clue_12`, `clue_13`, `clue_14`, `clue_15`, `created_on`, `updated_on`, `variable_1`, `variable_2`, `variable_3`, `variable_4`, `variable_5`, `variable_6`, `variable_7`, `variable_8`, `jenis_data_v1`, `jenis_data_v2`, `jenis_data_v3`, `jenis_data_v4`, `jenis_data_v5`, `jenis_data_v6`, `jenis_data_v7`, `jenis_data_v8`) VALUES
(32, 5, 20, '<p><span xss=removed> Sebuah tanah berbentuk persegi panjang akan ditanami tanaman bunga. Buatlah algoritma untuk membantu dalam menghitung luas tanah tersebut!</span></p>', 'program hitung_luas_tanah', '<p>END</p>', '<p>read panjang, lebar</p>', '<p>START</p>', '<p>print (luas)</p>', '<p>luas = panjang * lebar</p>', '', '', '', '', '', '', '', '', '', '', 'c', 'b', 'e', 'd', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658812917, 1658812917, 'panjang', 'lebar', '', '', NULL, NULL, NULL, NULL, 'int', 'int', '', '', NULL, NULL, NULL, ''),
(36, 5, 20, '<ol xss=removed><li><span xss=removed>Terdapat sebuah taman berbentuk persegi dengan panjang sisi adalah 14 m. Kemudian akan dibangun sebuah kolam renang didalam taman tersebut berbentuk lingkaran dengan diameter sama dengan panjang sisi. Buatlah algoritma untuk menghitung sisa tanah yang tidak dbangun kolam renang!</span></li></ol>', 'program hitung_sisa_tanah', '<p>luas_taman = sisi*sisi </p>', '<p>END</p>', '<p>luas_lingkaran = phi* (0.5 * sisi)*(0.5*sisi) </p>', '<p>read sisi, phi </p>', '<p>print (luas_sisa) </p>', '<p><span xss=removed>luas_sisa = luas_tman – luas_lingkaran </span></p>', '<p>START</p>', '', '', '', '', '', '', '', '', 'g', 'd', 'a', 'c', 'f', 'e', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658888351, 1658888351, 'sisi = 14 m', 'phi = 3,14', 'luas_taman', 'luas_lingkaran', 'luas_sisa', '', '', NULL, 'int', 'double', 'float', 'float', 'float', NULL, '', ''),
(38, 5, 20, '<p>Sebuah rumah makan baru telah dbuka di Jl. Borobudur Malang. Berdasarkan peraturan pemerintah daerah maka rumah makan tersebut dikenakan pajak berdasarkan makanan yang dijual. Bantulah pemilik toko untuk menentukan harga yang harus dijual per item produk yang sudah termasuk pajaknya dengan membuatkan algoritmanya!</p>', '<p>program hitung_harga_jual</p>', '<p>write \"masukkan besaran prosentase pajak\"</p>', '<p>harga_jual = harga_dasar + pajak</p>', '<p>read harga_dasar</p>', '<p>print \"Harga Jual =\"+harga_jual</p>', '<p>END</p>', '<p>read prosentasi_pajak</p>', '<p>START</p>', '<p>pajak =harga_dasar* (prosentasi_pajak/100)</p>', '<p>write \"masukkan harga dasar produk\"</p>', '<p>print \"Pajak sebesar=\"+pajak</p>', '', '', '', '', '', 'g', 'i', 'c', 'a', 'f', 'h', 'b', 'j', 'd', NULL, 'e', NULL, NULL, NULL, NULL, NULL, 'urut_2', NULL, NULL, NULL, NULL, 'urut_7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658889229, 1659031301, 'harga_jual', 'harga_dasar', 'prosentasi_pajak', 'pajak', '', '', '', '', 'int', 'int', 'int', 'double', '', '', '', ''),
(40, 5, 20, '<p>Pak Budi mempunyai kolam renang berbentuk balok berukuran panjang 10 m, lebar 6 m, dan kedalaman 1,5 m. Sisi bagian dalam kolam renang dikeramik. Luas bagian kolam renang yang dikeramik adalah</p>', 'program hitung_luas_kolam', '<p>read panjang, lebar, tinggi </p>', '<p>print (luas_bagian) </p>', '<p>END</p>', '<p>START  </p>', '<p>luas_bagian = <strong>2 * ((p*l) + (p*t) + (l*t)) </strong></p>', '', '', '', '', '', '', '', '', '', '', 'd', 'a', 'e', 'b', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658889813, 1658889813, 'panjang = 10m', 'lebar = 6m', 'tinggi = 1,5m', 'luas_bagian', '', '', '', NULL, 'int', 'int', 'double', 'double', '', '', '', ''),
(44, 5, 20, '<p>Pak Hari membeli sepeda motor dengan harga 25.000.000 dan dikenakan pajak penjualan sebesar 10%. Uang yang harus dibayar pak Hari sebesar…</p>', 'program hitung_harga_motor', '<p>END</p>', '<p>pajak_jual = pajak*harga_motor </p>', '<p>print (uang_bayar) </p>', '<p>START</p>', '<p>read pajak, harga_motor </p>', '<p>uang_bayar = harga_motor + pajak_jual </p>', '', '', '', '', '', '', '', '', '', 'd', 'e', 'b', 'f', 'c', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658892616, 1658892616, 'pajak = 10%', 'harga_motor ', 'uang_bayar', '', '', '', '', NULL, 'double', 'int', 'int', '', '', '', '', ''),
(45, 6, 20, '<ol><li>Buatlah algoritma untuk menentukan batas umur pembutan SIM kendaraan bermotor </li></ol>', '<p>program hitung_batas_umur</p>', '<p>IF age>=16  </p>', '<p>ELSE</p>', '<p>START</p>', '<p>END</p>', '<p>PRINT \"anda tidak dapat melanjutkan tes pembuatan SIM \"</p>', '<p>PRINT \"masukkan umur anda\"</p>', '<p>PRINT \"anda dapat melanjutkan tes pembuatan SIM\"</p>', '<p>READ age</p>', '<p>ENDIF</p>', '', '', '', '', '', '', 'c', 'f', 'h', 'a', 'g', 'b', 'e', 'i', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658967351, 1659034423, 'age', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(46, 6, 20, '<ol><li>Buatlah algoritma untuk menentukan apakah sebuah bilangan termasuk bilangan positif atau negatif </li></ol>', '<p>program hitung_bilangan</p>', '<p>END</p>', '<p>PRINT \"angka tersebut 0\"</p>', '<p>IF num>0THEN</p>', '<p>PRINT \" angka tersebut adalah negative\"</p>', '<p>START</p>', '<p>READ num</p>', '<p>PRINT \"Masukkan bilangan\"</p>', '<p>PRINT \"angka tersebut adalah positif\"</p>', '<p>ELSE</p>', '<p>ENDIF</p>', '<p>ELSE IF num <0></p>', '', '', '', '', 'e', 'g', 'f', 'c', 'h', 'k', 'd', 'i', 'b', 'j', 'a', NULL, NULL, NULL, NULL, 'urut_1', NULL, NULL, NULL, 'urut_5', NULL, NULL, 'urut_8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658967687, 1659034561, 'num', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(47, 6, 20, '<ol><li>Terdapat sebuah bilangan yaitu a, b,   dan c. Buatlah algoritma untuk menemukan angka terbesar dari 3 bilangan tersebut!</li></ol>', '<p>program hitung_bilangan</p>', '<p>PRINT “Masukkan angka b”</p>', '<p>IF a>b AND a>c THEN</p>', '<p>READ c</p>', '<p>READ b</p>', '<p>START</p>', '<p>END</p>', '<p>ELSE</p>', '<p>PRINT c+ \" lebih besar \"</p>', '<p>ELSE IF b > c THEN</p>', '<p>PRINT b + \" lebih besar \"</p>', '<p>PRINT “Masukkan angka c”</p>', '<p>PRINT “Masukkan angka a”</p>', '<p>ENDIF</p>', '<p>PRINT a+ \"lebih besar\"</p>', '<p>READ a</p>', 'e', 'l', 'o', 'a', 'd', 'k', 'c', 'b', 'n', 'i', 'j', 'g', 'h', 'm', 'f', 'urut_1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_9', NULL, NULL, 'urut_12', NULL, NULL, NULL, 1658968383, 1659033762, 'a, b, c', '', '', '', '', '', '', '', 'int', 'long', 'double', '', '', '', '', ''),
(48, 6, 20, '<p>Sebuah sistem dibuat untuk menentukan pakaian dan peralatan yang harus dibawa pengguna sesuai dengan kondisi cuaca. Jika suhu lebih dari 27<sup>o</sup>C, maka pengguna disarankan memakai dress, kemudian dilakukan pengecekan apakah saat ini hujan, jika hujan maka pengguna disarankan untuk membawa payung, sedangkan jika tidak hujan maka pengguna disarankan untuk memakai sunscreen. Namun, jika suhu kurang dari atau sama dengan 27<sup>o</sup>C, maka pengguna disarankan memakai celana panjang.</p>', '<p>program penentuan_suhu</p>', '<p>PRINT “membawa payung”</p>', '<p>READ suhu</p>', '<p>ELSE</p>', '<p>START</p>', '<p>PRINT “Gunakan pakaian celana panjang”</p>', '<p>PRINT “Gunakan Sunscreen”</p>', '<p>END</p>', '<p>IF suhu>27</p>', '<p>PRINT “masukkan suhu”</p>', '<p>ELSE</p>', '<p>PRINT “Gunakan pakaian dress”</p>', '<p>ENDIF</p>', '<p>IF hujan==’y’</p>', '', '', 'd', 'i', 'b', 'h', 'k', 'm', 'a', 'c', 'f', 'j', 'e', 'l', 'g', NULL, NULL, NULL, NULL, NULL, NULL, 'urut_5', NULL, NULL, 'urut_8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658968885, 1659033617, 'suhu', 'hujan', '', '', '', '', '', '', 'int', 'char', 'long', 'double', '', '', '', ''),
(49, 6, 20, '<ol><li>Kamu adalah pengendara sepeda motor yang sedang melintas di jalan raya dan bertemu lampu lalu lintas. Susunlah algoritma pseudocode untuk menentukan apa yang harus kamu lakukan untuk setiap kondisi lampu lalu lintas!</li></ol>', '<p>program kondisi_lampu</p>', '<p>break</p>', '<p>case “merah”</p>', '<p>break</p>', '<p>break</p>', '<p>tindakan = “warna yang anda inputkan salah”</p>', '<p>case “kuning”</p>', '<p>tindakan = “jalan”</p>', '<p>PRINT +tindakan</p>', '<p>PRINT “masukkan warna”</p>', '<p>tindakan = “berhenti”</p>', '<p>READ warna</p>', '<p>case “hijau”</p>', '<p>Switch (warna)</p>', '<p>Default</p>', '<p>tindakan = “hati-hati”  </p>', 'i', 'k', 'm', 'b', 'j', 'a', 'f', 'o', 'c', 'l', 'g', 'd', 'n', 'e', 'h', NULL, NULL, NULL, NULL, NULL, 'urut_6', NULL, NULL, NULL, NULL, NULL, 'urut_12', 'urut_13', NULL, NULL, 1658969414, 1659034199, 'warna, tindakan', '', '', '', '', '', '', '', 'string', 'char', 'long', '', '', '', '', ''),
(50, 7, 20, '<p>Buatlah algoritma untuk menampilkan angka dari 1 sampai 100</p>', 'program tampil_angka', '<p>READ counter </p>', '<p>END </p>', '<p>ENDFOR </p>', '<p>FORcounter = 1 TO100 STEP 1 DO </p>', '<p>START</p>', '<p>PRINT counter </p>', '', '', '', '', '', '', '', '', '', 'e', 'a', 'd', 'f', 'c', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658969790, 1658969790, 'counter', '', '', '', '', '', '', NULL, 'int', 'double', 'float', 'string', '', '', '', ''),
(51, 7, 20, '<ol><li>Buatlah algortitma untuk menghitung jumlah bilangan dari 1 sampai 100 </li></ol>', 'program hitung_jumlah', '<p>END</p>', '<p>ENDFOR</p>', '<p>READ counter, sum </p>', '<p>sum=sum+counter </p>', '<p>START</p>', '<p>PRINT sum </p>', '<p>FOR counter=1 TO 100 STEP 1 DO </p>', '', '', '', '', '', '', '', '', 'e', 'c', 'g', 'd', 'b', 'f', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658969999, 1658969999, 'counter', 'sum = 0', '', '', '', '', '', NULL, 'int', 'int', 'double', '', '', '', '', ''),
(52, 7, 20, '<ol><li>Membaca 50 angka dan menemukan jumlah dan rata-ratanya </li></ol>', 'program jumlah_mean', '<p>READ num </p>', '<p>FOR counter=1 TO 50 STEP counter DO </p>', '<p>END </p>', '<p>PRINT \"Enter a Number\" </p>', '<p>START</p>', '<p>PRINT sum </p>', '<p>sum=sum+num </p>', '<p>read counter, sum, num </p>', '<p>ENDFOR </p>', '', '', '', '', '', '', 'e', 'h', 'b', 'd', 'a', 'g', 'i', 'f', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658970471, 1658970471, 'counter', 'sum = 0', 'num', '', '', '', '', NULL, 'int', 'int', 'int', '', '', '', '', ''),
(53, 7, 20, '<ol><li>Buatlah algoritma untuk menjumlahkan bilangan genap pada n bilangan tertentu</li></ol>', 'program jumlah_bilangan_genap', '<p>read counter, sum, num </p>', '<p>IF counter % 2 == 0 THEN </p>', '<p>PRINT sum </p>', '<p>ENDIF</p>', '<p>START</p>', '<p>END</p>', '<p>sum=sum+counter </p>', '<p>FOR counter=1 TO num STEP 1 DO </p>', '<p>PRINT “masukkan angka” </p>', '<p>ENDFOR </p>', '', '', '', '', '', 'e', 'i', 'a', 'h', 'b', 'g', 'd', 'j', 'c', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658971043, 1658971043, 'counter', 'sum=0', 'num ', '', '', '', '', NULL, 'int', 'int', 'int', '', '', '', '', ''),
(54, 7, 20, '<p>Buatlah algoritma untuk menghitung rata-rata dari sebuah bilangan </p>', 'program hitung_mean', '<p>ENDFOR</p>', '<p>FORcounter = 1 TObil STEP 1 DO </p>', '<p>START</p>', '<p>PRINT \"rata-rata dari angka adalah :\"+avg </p>', '<p>sum=sum+counter </p>', '<p>read counter,bil,sum,avg </p>', '<p>END </p>', '<p>avg=sum/bil </p>', '', '', '', '', '', '', '', 'c', 'f', 'b', 'e', 'a', 'h', 'd', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658971631, 1658971631, 'bil', 'avg', 'sum', 'counter', '', '', '', NULL, 'int', 'int', 'int', 'int', 'float', 'double', 'char', ''),
(55, 8, 20, '<ol><li>Mencari jumlah semua elemen dalam array</li></ol>', 'program jml_elemen_array', '<p>ARRAY numbers={65,45,10,7,125} </p>', '<p>sum = sum + numbers[i] </p>', '<p>END</p>', '<p>read i=0, n=5, sum=0 </p>', '<p>START</p>', '<p>PRINT\"jumlah semua angka dalam aray adalah \"+sum </p>', '<p>ENDFOR</p>', '<p>FOR i=0 TO n-1 STEP 1 DO </p>', '', '', '', '', '', '', '', 'e', 'd', 'a', 'h', 'b', 'g', 'f', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660033870, 1660033870, 'numbers', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(56, 8, 20, '<p>Susunlah algoritma pseudocode dalam menentukan kelulusan nilai mahasiswa</p>', 'program kelulusan_nilai', '<p>print(\"Masukan nilai UAS ke-\"+i+\": \"); </p>', '<p>END</p>', '<p>Read nilaiUAS[] = new int[6]</p>', '<p>if(nilaiUAS[i] > 70)</p>', '<p>START</p>', '<p>for(int i=0; i<nilaiUAS.length; i++) </p>', '<p>print(\"Nilai ke-\"+i+\" lulus\");</p>', '', '', '', '', '', '', '', '', 'e', 'c', 'f', 'a', 'd', 'g', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660034101, 1660034101, 'nilai', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(57, 8, 20, '<p>Buatlah algoritma pseudocode untuk menghitung nilai rata-rata mahasiswa</p>', '<p>program hitung_nilai</p>', '<p><span>for ( int i = 0; i < nilaiMHS></p>', '<p>rata = total/nilaiMHS;</p>', '<p>Read nilaiUAS[]</p>', '<p>START</p>', '<p>print (rata)</p>', '<p>for ( int i = 0; i < nilaiUAS>', '<p><span>END</span></p>', '<p>total += nilaiMHS</p>', '<p><span>print(\"Masukan nilai UAS ke-\"+i+\"</span><span>: \");</span><code><span></span></code></p>', '', '', '', '', '', '', 'd', 'c', 'f', 'i', 'a', 'h', 'b', 'e', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_3', NULL, NULL, 'urut_6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660035770, 1660487731, 'nilai', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', ''),
(58, 8, 20, '<ol><li>Menghitung jumlah nilai pada array</li></ol>', '<p>program nilai_array</p>', '<p>sum = sum + angka[i]</p>', '<p>read angka i=0, n=5, sum=0</p>', '<p>START</p>', '<p>ENDFOR</p>', '<p>FOR i=0 TO n-1 STEP 1 DO</p>', '<p>END</p>', '<p>print\"Jumlah nilai pada array adalah\"+sum</p>', '<p>ARRAY angka={65,45,10,7,125}</p>', '', '', '', '', '', '', '', 'c', 'b', 'h', 'e', 'a', 'd', 'g', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_4', NULL, NULL, NULL, 'urut_8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660036067, 1660487784, 'angka', '', '', '', '', '', '', '', 'int', 'double', 'float', '', '', '', '', ''),
(59, 8, 20, '<ol><li>Buatlah sebuah program untuk mencari nilai terbesar dalam array</li></ol>', '<p>program nilai_terbesar</p>', '<p>max_num = arr[0];</p>', '<p>print “input angka ke dalam array:”</p>', '<p>START</p>', '<p>for(i = 0; i < arr>', '<p>read arr_count</p>', '<p>END</p>', '<p>max_num = arr[i];</p>', '<p>print “input jumlah elemen array :\"</p>', '<p>print (\"Angka terbesar adalah: \" + max_num);</p>', '<p>if(arr[i] > max_num)</p>', '<p>arr[i] = input.nextInt();</p>', '<p>for(i = 0; i < arr>', '', '', '', 'c', 'h', 'e', 'b', 'l', 'k', 'a', 'd', 'j', 'g', 'i', 'f', NULL, NULL, NULL, 'urut_1', NULL, 'urut_3', NULL, NULL, NULL, NULL, NULL, 'urut_9', NULL, NULL, NULL, NULL, NULL, NULL, 1660036495, 1660487922, 'jumlah', 'angka', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(60, 9, 20, '<ol><li>Buatlah program untuk menghitung pangkat dari suatu angka</li></ol>', '<p>program hitung_pangkat</p>', '<p>if (pangkat == 0)</p>', '<p>Print “masukkan pangkat”</p>', '<p>return angka * hitungPangkat(angka, pangkat - 1)</p>', '<p>START</p>', '<p>Read pangkat</p>', '<p>END</p>', '<p>return angka</p>', '<p>print (hitungPangkat (angka, pangkat));</p>', '<p>Print “masukkan angka=”  </p>', '<p>else</p>', '<p>Read angka</p>', '', '', '', '', 'd', 'i', 'k', 'b', 'e', 'a', 'g', 'j', 'c', 'h', 'f', NULL, NULL, NULL, NULL, 'urut_1', NULL, NULL, NULL, NULL, NULL, NULL, 'urut_8', NULL, NULL, 'urut_11', NULL, NULL, NULL, NULL, 1660036848, 1660488176, 'angka', 'pangkat', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(61, 9, 20, '<ol><li>Pembuatan program untuk menghitung jumlah uang nasabah yang disimpan di Bank setelah mendapatkan bunga selama beberapa tahun dengan menggunakan fungsi rekursif. Pada kasus ini dianggap bunga yang ditentukan oleh bank adalah 11% per tahun. Karena perhitungan bunga adalah bunga <em>saldo, sehingga untuk menghitung besarnya uang setelah ditambah bunga adalah saldo + bunga </em>saldo. Dalam hal ini, besarnya bunga adalah 0.11 <em>saldo, dan saldo dianggap 1 </em>saldo, sehingga 1 <em>saldo + 0.11 </em>saldo dapat diringkas menjadi 1.11 * saldo untuk perhitungan saldo setelah ditambah bunga (dalam setahun).</li></ol>', '<p>program hitung_tabungan</p>', '<p>Read Saldo</p>', '<p>ELSE</p>', '<p>Read saldo, tahun</p>', '<p>print \"lamanya menabung (tahun) : \"</p>', '<p>START</p>', '<p><span>print(\"Jumlah uang </span><span>a</span><span>dalah</span><span>\" + (hitungBunga (saldoAwal, tahun)) )</span></p>', '<p>return saldo;</p>', '<p>print \"masukkan jumlah saldo awal : \"</p>', '<p>END</p>', '<p>Read tahun</p>', '<p><span>return ( 1,11* hitungBunga(saldo, tahun -1 ) ) ;</span></p>', '<p>if (tahun ==0)</p>', '', '', '', 'e', 'c', 'l', 'g', 'b', 'k', 'h', 'a', 'd', 'j', 'f', 'i', NULL, NULL, NULL, 'urut_1', NULL, NULL, NULL, 'urut_5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660037366, 1660488137, 'saldo', 'tahun', '', '', '', '', '', '', 'double', 'int', '', '', '', '', '', ''),
(62, 9, 20, '<p>Dian akan membuat kalung dengan menggunakan manik-manik yang beragam. Terdapat manik-manik dengan warna merah sebanyak 18 buah dan warna biru sebanyak 30 buah. Berapakah jumlah manik-manik terbanyak yang bisa dibuat oleh Dian jika diisyaratkan kalung yang buat dengan jumlah dan warna yang sama?</p>', '<p>program hitung_fpb</p>', '<p>return bil1;</p>', '<p>return cariFPB (bil2, bil1 % bil2);</p>', '<p>read bil1, bil2</p>', '<p>print (\"FPB dari \"+bil1 +\" dan \"+bil2+\" adalah \"+ fpb);</p>', '<p>START</p>', '<p>END</p>', '<p>if (bil2 == 0){</p>', '<p>read fpb = cariFPB(bil1, bil2);</p>', '', '', '', '', '', '', '', 'e', 'c', 'g', 'a', 'b', 'h', 'd', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660037663, 1660487993, 'bil1', 'bil2', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(63, 9, 20, '<p>Dino bisa menyelesaikan satu pekerjaaan setiap 6 menit dan Tio setiap 10 menit. Setelah berapa menitkah keduanya akan dapat menyelesaikan secara bersamaan?</p>', '<p>program hitung_kpk</p>', '<p>return kpk = (bil1 * bil2) / cariFPB</p>', '<p>return cariFPB(bil2, bil1 % bil2);</p>', '<p>read bil1, bil2</p>', '<p>return bil1</p>', '<p>START</p>', '<p>print (\"kpk dari \"+bil1 +\" dan \"+bil2+\" adalah \"+ kpk);</p>', '<p>END</p>', '<p>read cariFPB</p>', '<p>if(bil2 == 0)</p>', '<p>read kpk</p>', '', '', '', '', '', 'e', 'c', 'i', 'd', 'b', 'h', 'a', 'j', 'f', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'urut_4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660039486, 1660487978, 'bil1', 'bil2', '', '', '', '', '', '', 'int', 'int', '', '', '', '', '', ''),
(64, 9, 20, '<ol><li>Buatlah algoritma pseudocode nilai factorial rekursif</li></ol>', '<p>program rekusif_nilai</p>', '<p>return bil</p>', '<p>return (bil * faktorial(bil-1))</p>', '<p>END</p>', '<p>START</p>', '<p>ELSE</p>', '<p>if(bil == 0)</p>', '<p>Read bil</p>', '<p>Print “masukkan bilangan:”</p>', '', '', '', '', '', '', '', 'd', 'h', 'g', 'f', 'a', 'e', 'b', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660039687, 1660488187, 'bilangan', '', '', '', '', '', '', '', 'int', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'Administrator', '$2y$12$WQaWXKtuLRgWENd.pEXnbe9VGHL8f9RpdIHs/jc.oL9SlQ9DxnQja', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1660486854, 1, 'Admin', 'Istrator', 'ADMIN', '0'),
(11, '::1', '1234567890', '$2y$10$YBl6SDjNzO5/FlWxqdVlBOIh8reHb3G9CKP8VWsdKc3pqRmL886v2', 'nia@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1651036760, 1660477274, 1, 'nia', 'nia', NULL, NULL),
(12, '::1', '11223344', '$2y$10$KN2S9fL8HU0A6T9vyC.48eXcIyNWoVdkNs6j.R/PZP/zg.goObMcO', 'mail@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1651036764, 1652798900, 1, 'Sujatmiko', 'Sujatmiko', NULL, NULL),
(21, '::1', '1941723002', '$2y$10$y6qX1QbLBTQoIoXfGFXWTOIOl7tygI8xfwtMjD82v66BsLpGzH0iK', '1941723002@ujian.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1656643678, 1656644331, 1, 'nia', 'nia', NULL, NULL),
(22, '::1', '123456789', '$2y$10$FyBmAiYxdPzl8vqNsNrhRu..b78ZNpnDJ5YWUxGYYJNm4W3CmmgFO', '123456789@ujian.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1657173106, 1657174072, 1, 'Yuni', 'Kurnia', NULL, NULL),
(23, '::1', '1234567899', '$2y$10$tD3po6lsbn6J0aamhW17lOtuO/8gwmTIkkHOzCrhLcr3MisU5fRg6', '1234567899@ujian.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1657174279, 1658896917, 1, 'Dhea', 'Alfi', NULL, NULL),
(24, '::1', '999999999999', '$2y$10$Pv8oyA3Ji/3hVU508e4qf.IBXLKcGL9RhM7Aj5KZ6NR9LlLD2THV6', 'snsn@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1657808805, NULL, 1, 'dsd', 'dsd', NULL, NULL),
(25, '::1', '0987654321', '$2y$10$xV5JxDRpaxdpqIf9o910VuCjBl0R4QkYD9fKR.bIXey/pr4LWjiHy', 'dheaag@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658894512, 1658894535, 1, 'dhea', 'dhea', NULL, NULL),
(26, '::1', '1841720061', '$2y$10$pxoPNL7deQXlfq.HeTdQieMSjh6nlLXeLNfJUH3WRm1H4S5R/Jn/.', 'ardan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658897082, 1658901599, 1, 'ardan', 'ardan', NULL, NULL),
(27, '::1', '1234567891', '$2y$10$aPIVHHF8A4LMN/sOdj6vVeTtuHUT1q4T8ff3CYgnz6piTUW5iQ1E.', 'arr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658897420, 1658897442, 1, 'array', 'array', NULL, NULL),
(28, '::1', '2131710004', '$2y$10$hXYuC5p8dDwv52sDpTpZh.F5DkEmup.ke.khLwoITI8YKdiXOoXI2', '2131710004@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966376, 1660106442, 1, 'NUR', 'ALIMAH', NULL, NULL),
(29, '::1', '2131710021', '$2y$10$AvIrKZMdfleRpdX7DYPwOunHPN5yXViUZKaJBt0.y0n2dXE1cyeJG', '2131710021@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966379, 1660352797, 1, 'WIRASWANTI', 'PUTRI', NULL, NULL),
(30, '::1', '2131710030', '$2y$10$KScMTgNPyHYPw57thx3BJu4f/vC7GH3WBTsIvqGGiBD9jMhDjLHjS', '2131710030@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966382, NULL, 1, 'NAFIATUL', 'FADLILAH', NULL, NULL),
(31, '::1', '2131710043', '$2y$10$ruSzO3D1SGA75NW5lR7.0eGQ6NBua/HJCuL2NORgg5Saznk8Moclm', '2131710043@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966385, NULL, 1, 'RAHMAT', 'HIDAYAT', NULL, NULL),
(32, '::1', '2131710046', '$2y$10$1sFHCKUdSlwMlzpKb2VN3O.XFHSR3ndcAi87qA7y3D14bHcp5bMoe', '2131710046@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966388, NULL, 1, 'SABILA', 'ISLAMIA', NULL, NULL),
(33, '::1', '2131710064', '$2y$10$K4iIZ2YxxZ9kaByNK/gNk.jLO.5kJfuJBzOh8b.tJbt2JmuApCF4a', '2131710064@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966390, NULL, 1, 'NANDA', 'KURNIA', NULL, NULL),
(34, '::1', '2131710072', '$2y$10$khKznCxdzNqpjw6Eg1q6uuNAJiSTEcNlmt2Df2cjDTCAXq4dwfGEm', '2131710072@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966394, NULL, 1, 'EGA', 'FEBRYANA', NULL, NULL),
(35, '::1', '2131710077', '$2y$10$9ytMMx5QJcxGGnCkvM3Qxuv.08RPCjos1.VrHyItU9mos/9mqbutW', '2131710077@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966398, NULL, 1, 'RASYID', 'ALAMSYAH', NULL, NULL),
(36, '::1', '2131710079', '$2y$10$0bo9Exf1FTmmqEbbvmErt.XFp5FzpZk2/Sb34w/vAz5qhnlMx88a6', '2131710079@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966401, NULL, 1, 'WISANG', 'PANGGALIH', NULL, NULL),
(37, '::1', '2131710081', '$2y$10$Whaf8qDuOkoMaSIvrYIrZ.RSGt/JsVloT6Qz30usz50RxtFLIYnQC', '2131710081@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966406, NULL, 1, 'FERLY', 'PRASETYO', NULL, NULL),
(38, '::1', '2131710089', '$2y$10$W9fKLiZYgigPc9F0E1KsZucvXxaGWqtkwNyWQ7AVRs6LbNz8v/Ypm', '2131710089@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966409, NULL, 1, 'RIZQI', 'JAMIL', NULL, NULL),
(39, '::1', '2131710092', '$2y$10$VfDTQDFHIOA0a0S8pXAy0OmpiYl/f7LBsZU6041.nIWTpNRjhjl9G', '2131710092@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966414, NULL, 1, 'FITRAH', 'AHMAD', NULL, NULL),
(40, '::1', '2131710101', '$2y$10$7PG4NitdzVP.v.nZd5zFDez7xenXSxxAfvopMloXZ52tZhgi7sIs2', '2131710101@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966417, NULL, 1, 'NEDDY', 'WIRYAWAN', NULL, NULL),
(41, '::1', '2131710103', '$2y$10$MfvWDLomdMED6x607V9dqOEngDQkppVtPiaOYAZj5Os/1XkxnmyQm', '2131710103@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966419, NULL, 1, 'KHOSYI', 'IMANDA', NULL, NULL),
(42, '::1', '2131710104', '$2y$10$tnqSi291Ak7DqDxlrFBeQOmz3DiVCUIsY4irqZS2QlE4oOM4ZyU4u', '2131710104@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966422, NULL, 1, 'INDAH', 'IRIANI', NULL, NULL),
(43, '::1', '2131710110', '$2y$10$SpzB84z2pMrHL1KZAP4Cq.DavuL38fmuI2Bf5PvnezfTzJUbp2gky', '2131710110@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966425, NULL, 1, 'FADLY', 'SATRIADI', NULL, NULL),
(44, '::1', '2131710118', '$2y$10$3Rlaskl//tvrp8Jg5nU0yuQbWazPzFWRh5Nci3C89KT9328XhXCpO', '2131710118@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966427, NULL, 1, 'FABLO', 'AIMAR', NULL, NULL),
(45, '::1', '2131710122', '$2y$10$aloj1BfFP4QlvnrtLhnRquz7GsgbnF/Yzmi14c5gPD2hixuxCLK42', '2131710122@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966431, NULL, 1, 'HALIM', 'SAPUTRO', NULL, NULL),
(46, '::1', '2131710139', '$2y$10$c6I3h089SPJ5mDVVABkTUu5xOsaBDe7NWe2aOTT7brMKmbcbpvM.a', '2131710139@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966433, NULL, 1, 'JATI', 'KUSUMA', NULL, NULL),
(47, '::1', '2131710143', '$2y$10$OEcMUtTIIWcdu0BSeDoU/eyUoNKgFPXvOPjhkfvLaVR6T7k7YviAK', '2131710143@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966438, NULL, 1, 'BANGKIT', 'CANIAGO', NULL, NULL),
(48, '::1', '2131710145', '$2y$10$ZjoUUzDDUDMaD8r3FtD7AOWLp5xslcJgsd7O59.52dP24BJircukm', '2131710145@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966441, NULL, 1, 'RIZQI', 'ARDIANSYAH', NULL, NULL),
(49, '::1', '2131710148', '$2y$10$LGotj0aSpRBFPJ5.Yd4PuuHWYf01mcg2Lmjc6cnjAm2QpC/rbTRFa', '2131710148@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966444, NULL, 1, 'KANSHA', 'SHYFA', NULL, NULL),
(50, '::1', '2141720001', '$2y$10$VKwcIwiKWS4wrD69JTTc9uP0h6wrcAMNTLzJfKUEOhbRvSvZ1Ruz.', '2141720001@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966447, NULL, 1, 'WANDA', 'CAHYA', NULL, NULL),
(51, '::1', '2141720017', '$2y$10$LnlOn5ZShEsrC.90HLzDhO/MctrX.wyA8pj9W8I3sBZwCDuOc7Uc.', '2141720017@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966449, NULL, 1, 'ALVINA', 'PERMATA', NULL, NULL),
(52, '::1', '2141720045', '$2y$10$GV8k9dP64FhnnTdpHPcl/uslqXenpTDGsyIKPeVYRDJufpXRcixia', '2141720045@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966452, NULL, 1, 'ANANDA', 'PRATIWI', NULL, NULL),
(53, '::1', '2141720046', '$2y$10$gi.AfDNtKOaT2Au4B/GIB./qs4Onn1fPrZj9/a7MOv2f9i6wAvohG', '2141720046@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966455, NULL, 1, 'ANDI', 'PRASTYO', NULL, NULL),
(54, '::1', '2141720078', '$2y$10$Y/wzYfgC0vL6hd9QTZdafO1ZIHxYhqaakC15Wwy1LdkSQG5q75DFm', '2141720078@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966457, NULL, 1, 'ALFAN', 'OLIVAN', NULL, NULL),
(55, '::1', '2141720081', '$2y$10$OOMxPrDcQr1DOfMrGUv0dOqNB.0/VI3Okkg0iCueSgSMwRkMR1/mC', '2141720081@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966460, NULL, 1, 'HILMI', 'MUGHID', NULL, NULL),
(56, '::1', '2141720082', '$2y$10$btlhljZhXDKAlUiSqEAtT.ikHjOeyv5DsfK2qG8QhjVLwEWpFvx8m', '2141720082@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966463, 1659594767, 1, 'HANS', 'WIJAYA', NULL, NULL),
(57, '::1', '2141720084', '$2y$10$sk3Dy1dALrO80dh/movPLO3GD8BgWSnOd4RfUdTzfG/wgQtRdLHDW', '2141720084@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966467, NULL, 1, 'ALFAN', 'AL-HADI', NULL, NULL),
(58, '::1', '2141720087', '$2y$10$gMoAQ0ZZL7hyrKWNWsqMSOzGcsAyei6qrWITRRq4p2AUlhEBpV//e', '2141720087@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966470, NULL, 1, 'SATIAN', 'FERDIANSYAH', NULL, NULL),
(59, '::1', '2141720088', '$2y$10$vOaL5MNFFsv3J72igEsWCuQOdcBzS3ZynBhBrnLiH/FC6meZw/76C', '2141720088@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966476, NULL, 1, 'MUHAMMAD', 'ZULFIKAR', NULL, NULL),
(60, '::1', '2141720089', '$2y$10$.ZMEc2v5TFm1bN0Z/9OBru.OumArXtKwhczOn.n.76xIlQkrC3VmG', '2141720089@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966479, NULL, 1, 'RYAN', 'WIJAYA', NULL, NULL),
(61, '::1', '2141720091', '$2y$10$ReuPAQHQ8ybtzrbJ/YhW/uVK627fCGgnQWTEZTqu8gjvQ0G/6Stue', '2141720091@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966481, NULL, 1, 'ILHAM', 'YUDANTYO', NULL, NULL),
(62, '::1', '2141720106', '$2y$10$9iLvmxeQlsj9lPWwnaNBL.4dLnEF27fiDRteQRTy1I3aqw2TWkLba', '2141720106@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966484, 1660108121, 1, 'AGILAR', 'GUMILAR', NULL, NULL),
(63, '::1', '2141720108', '$2y$10$ecuWdfB6UpjrGaXA9NKLk.rWrNmiyC3D6aekOgv6zwR7Wp329W3SK', '2141720108@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966486, NULL, 1, 'MUHAMAD', 'ANAM', NULL, NULL),
(64, '::1', '2141720117', '$2y$10$E5.N.JjJAai.yVfyLT5B8OI99B9f7b581buhvale3sJiIhJKoodLG', '2141720117@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966489, NULL, 1, 'ZIEDNY', 'MUBAROK', NULL, NULL),
(65, '::1', '2141720118', '$2y$10$6FGxZikCEOVUIKMysmLfV.2ENN.2pN3r9ahEwJ4BjeP0A1BayQJq6', '2141720118@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966493, NULL, 1, 'AFIFAH', 'YUSWANTI', NULL, NULL),
(66, '::1', '2141720172', '$2y$10$cp3Q2vuIELDqI79u4ZuOdurOwToSZXyId6spEn2xklmpssEVW0zNq', '2141720172@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966495, NULL, 1, 'AHMAD', 'FA\"IQ', NULL, NULL),
(67, '::1', '2141720173', '$2y$10$v2JsxRPXEnyvkMLbmtHhs.vYyuNnKl0c9D0skIIxtCnM2fd8Y1s/u', '2141720173@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966501, NULL, 1, 'MOCHAMMAD', 'ZAMRONI', NULL, NULL),
(68, '::1', '2141720174', '$2y$10$ubCfldt.a8nyccwe9nEleOc3x06dm2tUpYU9g2htdPqj9qWLnl1Lq', '2141720174@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966503, NULL, 1, 'MIRABELL', 'LAURA', NULL, NULL),
(69, '::1', '2141720181', '$2y$10$7xrfZcL0T4rWOS0ER.7U3OzZQV8hA.gIG293lZPOaxEBcIEOJokR6', '2141720181@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966504, NULL, 1, 'GABRIEL', 'WICAKSONO', NULL, NULL),
(70, '::1', '2141720191', '$2y$10$onkJJEEUPAYH9tv9lpHMQeKxMz2KOVd7kgfEynptR1Yjg6fwB6M1.', '2141720191@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966506, NULL, 1, 'MUHAMMAD', 'MURROFID', NULL, NULL),
(71, '::1', '2141720193', '$2y$10$rv0enN8CoVWmMcLB9F6oI.Fg7y2KMvp3rgOJlGJ6.KMJWbUUwryo6', '2141720193@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966508, NULL, 1, 'MOHAMAD', 'ALFAIS', NULL, NULL),
(72, '::1', '2141720277', '$2y$10$k3Y5OXIILKKVeMOIPkp8ue3T7POVLaMDsNB8ctHQHF8vzATmhOIqC', '2141720277@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966510, NULL, 1, 'ABDURRAHMAN', 'WINARDI', NULL, NULL),
(73, '::1', '2141720210', '$2y$10$HAkuRO6yHQHNdRwijLBBN.qHwQBuhnbEjkdSrXAWXiWCYg0C5bIk6', '2141720210@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966512, NULL, 1, 'BAGUS', 'ADHYAKSA', NULL, NULL),
(74, '::1', '2141720214', '$2y$10$/w6IezRg3P86/5UI6TkLOeylnSZIrLNJb8w/c5jriUx.Ai2PUKm6K', '2141720214@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966514, NULL, 1, 'JUNIAR', 'PERMANA', NULL, NULL),
(75, '::1', '2141720216', '$2y$10$z.chVRIHBDjZThfhIstca.MyRjddbFsRz/Rkd5Uf1l65p/lasQNia', '2141720216@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966516, NULL, 1, 'ANISA', 'RAHMASARI', NULL, NULL),
(76, '::1', '2141720227', '$2y$10$FPgxhF.oZPPPJXyGMlZs/e.PsmhyS0HpPei17gRlyDl7/cA3h6nsG', '2141720227@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966518, NULL, 1, 'ARHAN', 'BUDIANTO', NULL, NULL),
(77, '::1', '2141720240', '$2y$10$saCTR0UaPa8cs4EP2DdYdebsqxrwK1N7ZsfKxCMMwer.hwd9a0NaG', '2141720240@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966523, NULL, 1, 'SANG', 'WIRAWAN', NULL, NULL),
(78, '::1', '2141720245', '$2y$10$LamjLhGQyWs1fWbD8GQpse/0Mb5EG231x020r9mSCNUwQ4W1IxQey', '2141720245@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966525, NULL, 1, 'ARSYANDA', 'YUARDHINO', NULL, NULL),
(79, '::1', '2141720261', '$2y$10$D9grSkFHQiMmGF/P34OE2OqUrS4XgKalSD.Eg/zCDz0NZDE.WFoTy', '2141720261@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1658966527, NULL, 1, 'SALWA', 'CANORA', NULL, NULL),
(80, '::1', '1941723009', '$2y$10$X2NWji7ipH4FoQeemQ6sa.x51glJETH.XZrPMAtT26m0QiAx82F2q', 'ferry@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659594204, NULL, 1, 'Ferry', 'Julio', NULL, NULL),
(81, '::1', '1941723010', '$2y$10$yPNZI68cUywFvjvvUTC8HulmEL9qCJonI5iWi3sCdkdlUAhtjvq6W', 'ferry09@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659594248, NULL, 1, 'Ferry', 'Julio', NULL, NULL),
(84, '::1', '2131710009', '$2y$10$tqtpcmLenOwEn5KF2dzvO.7g3jM8BH1FJd91bNPPcMztDb/vtK3sG', '2131710009@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659957601, NULL, 1, 'WIRASWANTI', 'PUTRI', NULL, NULL),
(85, '::1', '1234567888', '$2y$10$dXTJo8sKo8If7Eq5Z/Qrd.pC.V63GXRFIMX/kudBilj9wqJRrKxKu', '1234567888@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660040420, NULL, 1, 'nsnsnns', 'nsnsnns', NULL, NULL),
(86, '::1', '00000000000', '$2y$10$LOc4CN.sVqwzKGn63ZCwS.AmpG1WC6.8jX2ALPqLFO.pNfY6Va/fK', 'bndhdy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660040450, NULL, 1, 'msmms', 'msmms', NULL, NULL),
(87, '::1', '092837474', '$2y$10$zZ5vqSTtPduOqrBv8Z04fuNCX8.unhM/5AhwmE7OE07ZJMfEPfBQS', 'niandra1831@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1660040552, NULL, 1, 'dd98', 'dd98', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(13, 11, 3),
(23, 21, 3),
(24, 22, 3),
(25, 23, 3),
(26, 24, 3),
(27, 25, 3),
(28, 26, 3),
(29, 27, 3),
(30, 28, 3),
(31, 29, 3),
(32, 30, 3),
(33, 31, 3),
(34, 32, 3),
(35, 33, 3),
(36, 34, 3),
(37, 35, 3),
(38, 36, 3),
(39, 37, 3),
(40, 38, 3),
(41, 39, 3),
(42, 40, 3),
(43, 41, 3),
(44, 42, 3),
(45, 43, 3),
(46, 44, 3),
(47, 45, 3),
(48, 46, 3),
(49, 47, 3),
(50, 48, 3),
(51, 49, 3),
(52, 50, 3),
(53, 51, 3),
(54, 52, 3),
(55, 53, 3),
(56, 54, 3),
(57, 55, 3),
(58, 56, 3),
(59, 57, 3),
(60, 58, 3),
(61, 59, 3),
(62, 60, 3),
(63, 61, 3),
(64, 62, 3),
(65, 63, 3),
(66, 64, 3),
(67, 65, 3),
(68, 66, 3),
(69, 67, 3),
(70, 68, 3),
(71, 69, 3),
(72, 70, 3),
(73, 71, 3),
(74, 72, 3),
(75, 73, 3),
(76, 74, 3),
(77, 75, 3),
(78, 76, 3),
(79, 77, 3),
(80, 78, 3),
(81, 79, 3),
(82, 80, 3),
(83, 81, 3),
(84, 84, 3),
(85, 85, 3),
(86, 86, 3),
(87, 87, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_ujian`
--
ALTER TABLE `history_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `uc_email` (`email`) USING BTREE;

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history_ujian`
--
ALTER TABLE `history_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
