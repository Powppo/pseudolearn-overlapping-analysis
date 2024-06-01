<!-- <link rel="stylesheet" href="<?= base_url() ?>template/css/base.css" /> -->
<link rel="stylesheet" href="<?= base_url() ?>template/css/quiz.css" />
<!-- <link rel="stylesheet" href="<?= base_url() ?>template/css/alert.css" /> -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-4 col-xs-4 mb-4">
                <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <form method="POST" action="<?= base_url('overlappinganalysis/detail/' . $id_soal) ?>">
                <div class="form-group col-lg-4 col-xs-6 text-center">
                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <select name="id_kelas" class="form-control status-dropdown select2" style="width:100% !important" onchange="this.form.submit()">
                            <option value="">Semua Kelas</option>
                            <?php foreach ($kelas as $kls) : ?>
                                <option value="<?= $kls->id_kelas ?>" <?= (isset($selected_kelas) && $selected_kelas == $kls->id_kelas) ? 'selected' : '' ?>>
                                    <?= $kls->nama ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </form>


        </div>
    </div>
    <style>
        .container {
            width: 900px;
            margin: 50px auto;
            align-items: center;
        }

        .container2 {
            width: 900px;
            margin: 20px auto;
            align-items: center;
        }

        h1 {
            text-align: center;
            font-weight: 700;
            font-size: large;
            margin-bottom: 20px;
            color: rgba(0, 0, 0, 0.75);
        }

        p {
            text-align: center;
            color: rgba(0, 0, 0, 0.75);
        }

        .big-box {
            width: 100%;
            background-color: rgba(239, 236, 236, 0.45);
            border-radius: 20px;
            margin-bottom: 20px;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-between; */
        }

        .item-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .circle {
            width: 45px;
            height: 45px;
            background-color: white;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .small-box {
            flex-grow: 1;
            min-width: 100px;
            margin: 5px;
            padding: 10px;
            background-color: #ccc;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
            font-size: 16px;
            text-align: center;
        }
    </style>

    <!DOCTYPE html>
    <html lang="en">

    <head>


    </head>

    <body>
        <h1 style="font-size: 20px; font-weight: 500;">Soal</h1>

        <div class="container2">
            <?php
            $shownIds = []; // Array untuk menyimpan id_soal yang sudah ditampilkan

            foreach ($informasi as $u) {
                $id_soal = $u['soal'];
                $studi_kasus = $u['studi_kasus'];

                // Cek apakah id_soal sudah ditampilkan sebelumnya
                if (!in_array($id_soal, $shownIds)) {
                    // Tampilkan studi_kasus jika id_soal belum ditampilkan sebelumnya
                    echo '<p>' . $studi_kasus . '</p>';

                    // Tambahkan id_soal ke dalam array shownIds
                    $shownIds[] = $id_soal;
                }
            }
            ?>
        </div>

        <div id="jawaban-container" class="container">
            <?php
            // Array untuk menyimpan nilai yang telah ditampilkan sebelumnya
            $displayed_values = [];

            // Array untuk menyimpan jumlah id_user yang memberikan jawaban yang sama
            $user_counts = [];

            // Array untuk menyimpan jawaban berdasarkan label
            $grouped_values = [];

            foreach ($informasi as $data) {
                // Ambil nilai jawaban dari database
                $jawaban_tipe_data = $data['tipe_data_jawaban'];

                // Ambil id_user dari database
                $id_user = $data['id_user'];

                // Ambil nilai is_submit dari database
                $is_submit = $data['is_submit'];
                $detail_jawaban_tipedata = $data['detail_jawaban_tipedata'];
                $id_soal = $data['soal'];
                $id_kelas = $data['id_kelas'];

                // Jika is_submit bernilai 0, lewati iterasi ini
                if ($is_submit != 1) {
                    continue;
                }

                $jawaban_json = json_decode($detail_jawaban_tipedata, true);

                if (is_array($jawaban_json) && !empty($jawaban_json)) {
                    foreach ($jawaban_json as $key => $value) {
                        if (is_array($value) && isset($value['jawaban']) && isset($value['nilai'])) {
                            $jawaban = $value['jawaban'];
                            $nilai = $value['nilai'];
                            // Cetak hanya jika nilai tidak kosong
                            if (!empty($jawaban)) {
                                // Buat kunci unik berdasarkan label jawaban dan nilai jawaban

                                $unique_key = $key . '_' . $jawaban;

                                // Tambahkan jawaban ke dalam array berdasarkan label jawaban
                                if (!isset($grouped_values[$key])) {
                                    $grouped_values[$key] = [];
                                }
                                // Tambahkan nilai jawaban ke array jika belum ada
                                if (!in_array($value, $grouped_values[$key])) {
                                    $grouped_values[$key][] = $value;
                                }

                                // Tambahkan jawaban ke dalam array yang ditampilkan
                                if (!isset($displayed_values[$unique_key][$id_user])) {
                                    $displayed_values[$unique_key][$id_user] = true;
                                    if (!isset($user_counts[$unique_key])) {
                                        $user_counts[$unique_key] = 1;
                                    } else {
                                        $user_counts[$unique_key]++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            echo '<h1> Tipe Data </h1>';
            foreach ($grouped_values as $jawaban_label => $values) {

                echo '<div class="big-box">';
                foreach ($values as $value) {
                    if (is_array($value) && isset($value['jawaban']) && isset($value['nilai'])) {
                        $jawaban = $value['jawaban'];
                        $nilai = $value['nilai'];
                        $unique_key = $jawaban_label . '_' . $jawaban;
                        $encoded_unique_key = base64_encode($unique_key);

                        $background_color = ($nilai == 1) ? '#69C751' : '#CD4747';

                        echo '<div class="item-container"> ';
                        $id_kelas = isset($id_kelas) ? $id_kelas : 'all';

                        // echo '<a class="circle" href="' . base_url() . 'overlappinganalysis/detail_jawaban/' . $id_soal . '/' . $encoded_unique_key . '/' . $id_kelas . '">';
                        echo '<a class="circle" href="javascript:void(0);" onclick="openInNewWindow(\'' . base_url() . 'overlappinganalysis/detail_jawaban/' . $id_soal . '/' . $encoded_unique_key . '/' . ($id_kelas ?: 'all') . '\');">';
                        echo '<div>';
                        if (isset($user_counts[$unique_key])) {
                            echo $user_counts[$unique_key];
                        }
                        echo '</div>';
                        echo '</a>';
                        echo '<div class="small-box" style="background-color: ' . $background_color . '"> ' . $jawaban;
                        echo '</div>';
                        echo '</div>';
                    }
                }
                echo '</div>';
            }

            ?>
        </div>

        <div class="container">
            <?php
            // Array untuk menyimpan nilai yang telah ditampilkan sebelumnya
            $displayed_values = [];

            // Array untuk menyimpan jumlah id_user yang memberikan jawaban yang sama
            $user_counts = [];

            // Array untuk menyimpan jawaban berdasarkan label
            $grouped_values = [];

            usort($informasi, function ($a, $b) {
                return strcmp($a['id'], $b['id']);
            });

            foreach ($informasi as $data) {
                // Ambil nilai jawaban dari database
                $jawaban_tipe_data = $data['jawaban'];
                $jawaban_label = $data['id'];

                $id_user = $data['id_user'];

                $is_submit = $data['is_submit'];
                $id_soal = $data['soal'];

                $detail_jawaban_algoritma = $data['detail_jawaban_algoritma'];

                if ($is_submit != 1) {
                    continue;
                }

                $jawaban_json = json_decode($detail_jawaban_algoritma, true);

                if (is_array($jawaban_json) && !empty($jawaban_json)) {
                    foreach ($jawaban_json as $key => $value) {
                        if (is_array($value) && isset($value['jawaban']) && isset($value['nilai'])) {
                            $jawaban = $value['jawaban'];
                            $nilai = $value['nilai'];
                            // Cetak hanya jika nilai tidak kosong
                            if (!empty($jawaban)) {

                                $unique_key = $key . '_' . $jawaban;

                                // Tambahkan jawaban ke dalam array berdasarkan label jawaban
                                if (!isset($grouped_values[$key])) {
                                    $grouped_values[$key] = [];
                                }
                                // Tambahkan nilai jawaban ke array jika belum ada
                                if (!in_array($value, $grouped_values[$key])) {
                                    $grouped_values[$key][] = $value;
                                }

                                // Tambahkan jawaban ke dalam array yang ditampilkan
                                if (!isset($displayed_values[$unique_key][$id_user])) {
                                    $displayed_values[$unique_key][$id_user] = true;
                                    if (!isset($user_counts[$unique_key])) {
                                        $user_counts[$unique_key] = 1;
                                    } else {
                                        $user_counts[$unique_key]++;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo '<h1> Algoritma </h1>';

            foreach ($grouped_values as $jawaban_label => $values) {
                echo '<div class="big-box">';
                foreach ($values as $value) {
                    if (is_array($value) && isset($value['jawaban']) && isset($value['nilai'])) {
                        $jawaban = $value['jawaban'];
                        $nilai = $value['nilai'];
                        $unique_key = $jawaban_label . '_' . $jawaban;
                        $encoded_unique_key = base64_encode($unique_key);
                        $background_color = ($nilai == 1) ? '#69C751' : '#CD4747';

                        echo '<div class="item-container"> ';
                        echo '<a class="circle" href="' . base_url() . 'overlappinganalysis/detail_jawaban/' . $id_soal . '/' . $encoded_unique_key . '">';
                        echo '<div>';
                        if (isset($user_counts[$unique_key])) {
                            echo $user_counts[$unique_key];
                        }
                        echo '</div>';
                        echo '</a>';
                        echo '<div class="small-box" style="background-color: ' . $background_color . '"> ' . $jawaban;
                        echo '</div>';
                        echo '</div>';
                    }
                }
                echo '</div>';
            }

            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            function openInNewWindow(url) {
                // Mendapatkan lebar dan tinggi layar
                var screenWidth = window.screen.width;
                var screenHeight = window.screen.height;

                // Menentukan lebar dan tinggi pop-up 
                var popupWidth = 1200;
                var popupHeight = 800;

                // Menghitung posisi pop-up agar muncul di tengah layar
                var leftPosition = (screenWidth - popupWidth) / 2;
                var topPosition = (screenHeight - popupHeight) / 2;

                // Membuka pop-up dengan ukuran dan posisi yang ditentukan
                window.open(url, 'popUpWindow', 'width=' + popupWidth + ', height=' + popupHeight + ', left=' + leftPosition + ', top=' + topPosition + ', resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
            }
        </script>

    </body>

    </html>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2();

            const dropdown = document.querySelector('.status-dropdown');
            const jawabanContainer = document.getElementById('jawaban-container');

            dropdown.addEventListener('change', function() {
                let selectedKelasId = this.value;
                if (selectedKelasId === 'Semua Kelas') {
                    selectedKelasId = ''; // Atur ke string kosong jika 'all' dipilih
                }
                fetch('<?= base_url() ?>overlappinganalysis/filter_jawaban', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_kelas: selectedKelasId,
                            id_soal: <?= $id_soal ?> // Pastikan id_soal sudah terdefinisi di JavaScript Anda
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Tambahkan ini untuk debugging

                        // Kosongkan kontainer sebelum mengisi dengan data baru
                        jawabanContainer.innerHTML = '';

                        let html = '<h1> Tipe Data </h1>';
                        Object.keys(data.grouped_values).forEach(jawaban_label => {
                            html += '<div class="big-box">';
                            data.grouped_values[jawaban_label].forEach(value => {
                                if (value && value.jawaban && value.nilai) {
                                    const jawaban = value.jawaban;
                                    const nilai = value.nilai;
                                    const unique_key = jawaban_label + '_' + jawaban;
                                    const encoded_unique_key = btoa(unique_key);
                                    const background_color = (nilai == 1) ? '#69C751' : '#CD4747';

                                    const id_kelas = selectedKelasId || 'all'; // Gunakan 'all' jika null
                                    html += '<div class="item-container"> ';
                                    html += '<a class="circle" href="<?= base_url() ?>overlappinganalysis/detail_jawaban/' + data.id_soal + '/' + encoded_unique_key + '/' + id_kelas + '">';
                                    html += '<div>' + (data.user_counts[unique_key] || 0) + '</div>';
                                    html += '</a>';
                                    html += '<div class="small-box" style="background-color: ' + background_color + '"> ' + jawaban;
                                    html += '</div>';
                                    html += '</div>';
                                }
                            });
                            html += '</div>';
                        });
                        jawabanContainer.innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>