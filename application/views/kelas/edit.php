<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('kelas/save', array('id'=>'formsoal'), array('method'=>'edit', 'id_kelas'=>$kelas->id_kelas));?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="col-sm-6">
                        <div class="form-group col-sm-12">
                            <label for="nama" class="control-label">Nama</label>
                            <input required="required" value="<?=$kelas->nama?>" type="Text" name="nama" placeholder="Masukan Nama Kategori" id="nama" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('nama')?></small>
                        </div>
                        <!-- <div class="form-group col-sm-12">
                            <label for="bts_nilai" class="control-label">Batas Nilai Kategori</label>
                            <input required="required" value="<?=$kelas->bts_nilai?>" type="number" name="bts_nilai" placeholder="Masukan Nilai Kategori"  class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('bts_nilai')?></small>
                        </div> -->
                        <!-- <div class="col-sm-12">
                            <label for="kelas" class="control-label">Upload</label>
                            <div class="form-group">
                                <input type="file" name="image"  class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('image')?></small>
                            </div>
                        </div> -->
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <div class="card" style="width: 18rem;">
                                     <label  class="control-label">Load Gambar</label>
                                    <div class="card-img-top">
    
                                    <?php if(!empty($kelas->image)) : ?>
                                            <?=tampil_media('uploads/kelas_soal/'.$kelas->image);?>
                                        <?php endif;?>
                                        </div>
                                </div>
                            </div>
                        </div>
                         -->
                        <div class="form-group pull-right">
                            <a href="<?=base_url('kelas')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>