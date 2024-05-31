<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Form <?= $judul ?></h3>
        <div class="box-tools pull-right">
            <a href="<?= base_url('kriteria') ?>" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Batal
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?= form_open('kriteria/save', array('id' => 'kriteria'), array('method' => 'add')) ?>
                <div class="form-group">
                    <label for="kriteria">Jenis Kelamin</label>
                    <select name="kriteria" required class="form-control select2">
                        <option value="">-- Pilih variabel --</option>
                        <option value="jumlah_waktu">Jumlah Waktu</option>
                        <option value="jumlah_langkah">Jumlah Langkah</option>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-rotate-left"></i> Reset</button>
                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>