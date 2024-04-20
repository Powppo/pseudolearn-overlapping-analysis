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
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="example" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th style="text-align: center">No.</th>
                    <th style="text-align: center">Studi Kasus</th>
                    <th style="text-align: center">Level</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($informasi as $u) {
                    echo '
                <tr>
                    <td style="text-align: center">' . $no++ . '</td>
                    <td style="text-align: center">' . $u['studi_kasus'] . '</td>
                    <td style="text-align: center">' . $u['level'] . '</td>
                    <td>
                    <div class="text-center">
                            <a class="btn btn-xs btn-warning" style="color: #fff; background-color: #69C751; border-color: #69C751;" href="' . base_url() . 'overlappinganalysis/detail/' . $u['soal'] . '">
                            <i class="fa fa-eye" style="color: #fff;"></i> Analisis
                            </a> 
                        </div>
                    </td>
                </tr>';
                ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
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