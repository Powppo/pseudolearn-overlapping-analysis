<?php if ($this->ion_auth->is_admin()) : ?>

    <div class="box">
        <div class="box-body">
            <div class="row">
                <form action="<?= site_url('nilai/updateNilai') ?>" method="post">
                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nilai </h3>
                        </div>
                        <div class="table-responsive mt-2 mb-3">
                            <table class="table table-striped table-bordered table-hover datatables">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No.</th>
                                        <th style="text-align: center;">NIM</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">Jumlah Langkah</th>
                                        <th style="text-align: center;">Jumlah Waktu</th>
                                        <th style="text-align: center;">Post Test</th>
                                        <th style="text-align: center;">Pre Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($dataCondition) : ?>
                                        <?php foreach ($dataCondition as $key => $value) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $key + 1; ?></td>
                                                <td style="text-align: center;"><?= $value['nim']; ?></td>
                                                <td style="text-align: center;"><?= $value['nama']; ?></td>
                                                <td style="text-align: center;"><?= $value['jumlah_langkah']; ?></td>
                                                <td style="text-align: center;"><?= $value['jumlah_waktu']; ?></td>
                                                <td style="text-align: center;">
                                                    <input type="text" class="form-control" name="post_test[<?= $value['id_user'] ?>]" value="<?= $value['post_test'] ?>">
                                                </td>
                                                <td style="text-align: center;">
                                                    <input type="text" class="form-control" name="pre_test[<?= $value['id_user'] ?>]" value="<?= $value['pre_test'] ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class='btn btn-info col-md-12'>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //create script for input to allow only decimal number
        $(document).ready(function() {
            $('input[type="text"]').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            });
        });
    </script>
<?php endif; ?>