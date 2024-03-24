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
            <div class="form-group col-lg-4 col-xs-6 text-center">
                <?php if ($this->ion_auth->is_admin()) : ?>
                    <select class="form-control status-dropdown select2" style="width:100% !important">
                        <option value="">Semua Kelas</option>
                        <?php foreach ($kelas as $kls) : ?>
                            <option value="<?= $kls->id_kelas ?>"><?= $kls->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <style>
        .container {
            width: 900px;
            height: 250px;
            margin: 50px auto;
        }

        .big-box {
            width: 100%;
            background-color: #f0f0f0;
            border-radius: 20px;
            /* untuk membuat sudut agak tumpul */
            padding: 20px;
            /* jarak antara kotak besar dengan kotak kecil */
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .small-box {
            flex-grow: 1;
            /* Biarkan small-box tumbuh sesuai kebutuhan */
            min-width: 100px;
            /* Atur lebar minimum small-box */
            margin: 5px;
            padding: 10px;
            background-color: #ccc;
            border-radius: 15px;
            /* untuk membuat sudut agak tumpul */
        }
    </style>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kotak dengan Kotak Kecil</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <div class="big-box">
                <div class="small-box"></div>
                <div class="small-box"></div>
                <div class="small-box"></div>
            </div>
        </div>
        <div class="container">
            <div class="big-box">
                <!-- <?php
                        $no = 1;
                        foreach ($informasi as $data) {
                            // Ambil nilai tipe_data_jawaban dari database
                            $jawaban_tipe_data = $data['tipe_data_jawaban'];

                            // Menghapus karakter kurung kurawal dan spasi dari string
                            $jawaban_tipe_data = str_replace(['{', '}', ' '], '', $jawaban_tipe_data);

                            // Memecah string menjadi array berdasarkan koma
                            $jawaban_array = explode(',', $jawaban_tipe_data);

                            // Array sementara untuk menyimpan nilai yang telah ditampilkan sebelumnya
                            $displayed_values = [];

                            // Cetak nilai jawaban tipe data dalam kotak-kotak kecil
                            foreach ($jawaban_array as $value) {
                                // Cetak hanya jika nilai tidak kosong dan belum ditampilkan sebelumnya
                                if (!empty($value) && !in_array($value, $displayed_values)) {
                                    echo '<div class="small-box">' . $value . '</div>';
                                    // Tambahkan nilai ke dalam array sementara
                                    $displayed_values[] = $value;
                                }
                            }
                        }
                        ?> -->

                <!-- <?php
                        $displayed_values = []; // Array asosiatif untuk menyimpan nilai yang telah ditampilkan sebelumnya
                        foreach ($informasi as $data) {
                            // Ambil nilai tipe_data_jawaban dari database
                            $jawaban_tipe_data = $data['tipe_data_jawaban'];

                            // Menghapus karakter kurung kurawal dan spasi dari string
                            $jawaban_tipe_data = str_replace(['{', '}', ' '], '', $jawaban_tipe_data);

                            // Memecah string menjadi array berdasarkan koma
                            $jawaban_array = explode(',', $jawaban_tipe_data);

                            // Cetak nilai jawaban tipe data dalam kotak-kotak kecil
                            foreach ($jawaban_array as $value) {
                                // Cetak hanya jika nilai tidak kosong dan belum ditampilkan sebelumnya
                                if (!empty($value) && !isset($displayed_values[$value])) {
                                    echo '<div class="small-box">' . $value . '</div>';
                                    // Tambahkan nilai ke dalam array sementara
                                    $displayed_values[$value] = true;
                                }
                            }
                        }
                        ?> -->

                <!-- <?php
                        $displayed_values = []; // Array asosiatif untuk menyimpan nilai yang telah ditampilkan sebelumnya
                        $duplication_count = []; // Array asosiatif untuk menyimpan jumlah duplikasi nilai
                        foreach ($informasi as $data) {
                            // Ambil nilai tipe_data_jawaban dari database
                            $jawaban_tipe_data = $data['tipe_data_jawaban'];

                            // Menghapus karakter kurung kurawal dan spasi dari string
                            $jawaban_tipe_data = str_replace(['{', '}', ' '], '', $jawaban_tipe_data);

                            // Memecah string menjadi array berdasarkan koma
                            $jawaban_array = explode(',', $jawaban_tipe_data);

                            // Hitung jumlah duplikasi nilai dan simpan di dalam array
                            foreach ($jawaban_array as $value) {
                                // Cetak hanya jika nilai tidak kosong dan belum ditampilkan sebelumnya
                                if (!empty($value)) {
                                    if (!isset($displayed_values[$value])) {
                                        $displayed_values[$value] = true;
                                        $duplication_count[$value] = 1;
                                    } else {
                                        $duplication_count[$value]++;
                                    }
                                }
                            }
                        }

                        // Cetak nilai jawaban tipe data dalam kotak-kotak kecil beserta jumlah duplikasinya
                        foreach ($displayed_values as $value => $is_displayed) {
                            echo '<div class="small-box">' . $value;
                            if (isset($duplication_count[$value])) {
                                echo '<br>Jumlah: ' . $duplication_count[$value];
                            }
                            echo '</div>';
                        }
                        ?> -->

                <?php
                $displayed_values = []; // Array asosiatif untuk menyimpan nilai yang telah ditampilkan sebelumnya
                $user_counts = []; // Array asosiatif untuk menyimpan jumlah unik id_user yang memberikan jawaban yang sama

                foreach ($informasi as $data) {
                    // Ambil nilai tipe_data_jawaban dari database
                    $jawaban_tipe_data = $data['tipe_data_jawaban'];
                    // Ambil id_user dari database
                    $id_user = $data['id_user'];

                    // Menghapus karakter kurung kurawal dan spasi dari string
                    $jawaban_tipe_data = str_replace(['{', '}', ' '], '', $jawaban_tipe_data);

                    // Memecah string menjadi array berdasarkan koma
                    $jawaban_array = explode(',', $jawaban_tipe_data);

                    // Hitung jumlah unik id_user yang memberikan jawaban yang sama
                    foreach ($jawaban_array as $value) {
                        // Cetak hanya jika nilai tidak kosong dan belum ditampilkan sebelumnya
                        if (!empty($value)) {
                            if (!isset($displayed_values[$value][$id_user])) {
                                $displayed_values[$value][$id_user] = true;
                                if (!isset($user_counts[$value])) {
                                    $user_counts[$value] = 1;
                                } else {
                                    $user_counts[$value]++;
                                }
                            }
                        }
                    }
                }

                // Cetak nilai jawaban tipe data dalam kotak-kotak kecil beserta jumlah id_user yang memberikan jawaban yang sama
                foreach ($displayed_values as $value => $users) {
                    echo '<div class="small-box">' . $value;
                    if (isset($user_counts[$value])) {
                        echo '<br>Jumlah User: ' . $user_counts[$value];
                    }
                    echo '</div>';
                }
                ?>


            </div>
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