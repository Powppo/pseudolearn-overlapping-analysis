<!-- <link rel="stylesheet" href="<?= base_url() ?>template/css/base.css" /> -->
<link rel="stylesheet" href="<?= base_url() ?>template/css/quiz.css" />
<!-- <link rel="stylesheet" href="<?= base_url() ?>template/css/alert.css" /> -->

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
                <a href="<?= base_url() ?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="form-group col-lg-4 col-xs-5 text-center">
                <?php if ($this->ion_auth->is_admin()) : ?>
                    <select id="level_filter" class="form-control select2" style="width:100% !important">
                        <option value="all">Semua Level</option>
                        <?php foreach ($level as $m) : ?>
                            <option value="<?= $m->id_level ?>"><?= $m->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
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
        <!-- <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kotak dengan Kotak Kecil</title>
        <link rel="stylesheet" href="styles.css"> -->
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

        <div class="container">
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
                        $background_color = ($nilai == 1) ? '#69C751' : '#CD4747';

                        echo '<div class="item-container"> ';
                        echo '<a class="circle" href="' . base_url() . 'overlappinganalysis/detail_jawaban/' . $id_soal . '/' . $unique_key . '">';
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
                        $background_color = ($nilai == 1) ? '#69C751' : '#CD4747';

                        echo '<div class="item-container"> ';
                        echo '<a class="circle" href="' . base_url() . 'overlappinganalysis/detail_jawaban/' . $id_soal . '/' . $unique_key . '">';
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

    </body>

    </html>


    <!-- <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="overlappinganalysis" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="25" style="text-align: center">No.</th>
                    <th style="text-align: center">Nama Mahasiswa</th>
                    <th style="text-align: center">Kelas</th>
                    <th style="text-align: center">Soal</th>
                    <th style="text-align: center">Jawaban</th>
                    <th style="text-align: center">Status Jawaban</th>
                    <th style="text-align: center">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($informasi as $u) {
                    echo '
                <tr>
                    <td style="text-align: center">' . $no++ . '</td>     
                    <td style="text-align: center">' . $u['nama_mahasiswa'] . '</td>
                    <td style="text-align: center">' . $u['nama_kelas'] . '</td> 
                    <td style="text-align: center">' . $u['studi_kasus'] . '</td> 
                    <td style="text-align: center">' . $u['tipe_data_jawaban'] . '</td> 
                    <td style="text-align: center">' . $u['status_jawaban'] . '</td> 
                    <td style="text-align: center">' . $u['waktu'] . '</td> 
                    
                           </tr>';
                ?>
                <?php } ?>
            </tbody>
        </table>
    </div> -->
</div>
</div>
<!-- 
<script src="<?= base_url() ?>assets/dist/js/app/ujian/hasil.js"></script> -->

<script>
    $(document).ready(function() {
        dataTable = $('#overlappinganalysis').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                    extend: 'print',
                    download: 'open',
                    title: 'History Confidence',
                    filename: 'history_conf_mhs_print'
                },
                {
                    extend: 'copy',
                    download: 'open',
                    title: 'History Confidence',
                    filename: 'history_conf_mhs_copy'
                },
                {
                    extend: 'excel',
                    download: 'open',
                    title: 'History Confidence',
                    filename: 'history_conf_mhs_excel'
                },
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    title: 'History Confidence',
                    filename: 'history_conf_mhs_pdf'
                }
            ],
            "columnDefs": [{
                "targets": [3],
                "visible": true
            }]
        });

        $('.status-dropdown').on('change', function(e) {
            var id_kelas = $(this).val();
            $('.status-dropdown').val(id_kelas)
            console.log(id_kelas)
            //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
            dataTable.column(3).search(id_kelas).draw();
        })
    });
</script>