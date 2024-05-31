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
            <!-- <div class="col-lg-4 col-xs-4 mb-4">
                <a href="<?= base_url() ?>'overlappinganalysis/detail/ (ini id soal)" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div> -->
            <div class="col-lg-4 col-xs-4 mb-4">
                <a href="#" class="btn btn-flat btn-sm btn-default">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
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
    <br></br>

    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="overlappinganalysis" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="25" style="text-align: center">No.</th>
                    <th style="text-align: center">NIM</th>
                    <th style="text-align: center">Nama Mahasiswa</th>
                    <th style="text-align: center">ID Kelas</th>
                    <th style="text-align: center">Kelas</th>
                    <th style="text-align: center">Jenis Jawaban</th>
                    <th style="text-align: center">Jawaban</th>
                    <th style="text-align: center">Status Jawaban</th>
                </tr>
            </thead>
            <tbody>
                <?php $shownIds = []; ?>
                <?php $no = 1; ?>
                <?php foreach ($informasi as $userId => $jenisJawaban) : ?>
                    <?php foreach ($jenisJawaban as $jenis => $jawabanList) : ?>
                        <?php foreach ($jawabanList as $jawaban) : ?>
                            <?php

                            $nim = $jawaban['nim'];
                            $nilai = $jawaban['nilai'];

                            $status = ($nilai == 1) ? 'Benar' : 'Salah';

                            if (!in_array($nim, $shownIds)) {
                                echo '<tr>';
                                echo '<td style="text-align: center">' . $no++ . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['nim'] . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['nama_mahasiswa'] . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['id_kelas'] . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['nama_kelas'] . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['jenis_jawaban'] . '</td>';
                                echo '<td style="text-align: center">' . $jawaban['jawaban'] . '</td>';
                                echo '<td style="text-align: center">' . $status . '</td>';
                                echo '</tr>';

                                $shownIds[] = $nim;
                            }
                            ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- </div>
</div> -->
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
                "visible": false
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

<script>
    // Mensimulasikan klik pada toggle button saat halaman dimuat di dalam pop-up
    document.addEventListener('DOMContentLoaded', function() {
        if (window.opener) {
            var toggleButton = document.querySelector('.sidebar-toggle');
            if (toggleButton) {
                toggleButton.click();
            }
        }
    });
</script>