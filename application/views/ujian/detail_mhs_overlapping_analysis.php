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
    <table id="example" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">NIM</th>
                <th style="text-align: center">Nama Mahasiswa</th>
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
</div>

<script src="<?= base_url() ?>assets/dist/js/app/soal/data.js"></script>

<?php if ($this->ion_auth->is_admin()) : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#level_filter').on('change', function() {
                let id = $(this).val();
                let src = '<?= base_url() ?>soal/data';
                let url;

                if (id !== 'all') {
                    let src2 = src + '/' + id;
                    url = $(this).prop('checked') === true ? src : src2;
                } else {
                    url = src;
                }
                table.ajax.url(url).load();
            });
        });
    </script>
<?php endif; ?>