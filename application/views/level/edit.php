<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('level/save', array('id'=>'formsoal'), array('method'=>'edit', 'id_level'=>$level->id_level));?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                
                    <div class="col-sm-12 ">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group col-sm-12">
                                    <label for="nama" class="control-label">Nama</label>
                                    <input required="required" value="<?=$level->nama?>" type="Text" name="nama" placeholder="Masukan Nama Kategori" id="nama" class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('nama')?></small>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="bts_nilai" class="control-label">Batas Nilai Kategori</label>
                                    <input required="required" value="<?=$level->bts_nilai?>" type="number" name="bts_nilai" placeholder="Masukan Nilai Kategori"  class="form-control">
                                    <small class="help-block" style="color: #dc3545"><?=form_error('bts_nilai')?></small>
                                </div>
                                 <div class="col-sm-12">
                                    <label for="bts_nilai" class="control-label">Feedback Data Type</label>
                                    <div class="form-group">
                                        <textarea cols="20" rows="6" class="form-control" name="feedback_data_type" placeholder="Masukan Feedback"><?=$level->feedback_data_type?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('feedback_data_type')?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="bts_nilai" class="control-label">Feedback Input</label>
                                    <div class="form-group">
                                        <textarea cols="20" rows="6" class="form-control" name="feedback_input" placeholder="Masukan Feedback"><?=$level->feedback_input?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('feedback_input')?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="bts_nilai" class="control-label">Feedback Process</label>
                                    <div class="form-group">
                                        <textarea cols="20" rows="6" class="form-control" name="feedback_process" placeholder="Masukan Feedback"><?=$level->feedback_process?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('feedback_process')?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="bts_nilai" class="control-label">Feedback Output</label>
                                    <div class="form-group">
                                        <textarea cols="20" rows="6" class="form-control" name="feedback_output" placeholder="Masukan Feedback"><?=$level->feedback_output?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('feedback_output')?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="level" class="control-label">Upload</label>
                                    <div class="form-group">
                                        <input type="file" name="image"  class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('image')?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" align="center" >
                                <div class="form-group">
                                    <div style="width: 50%;">
                                         <label  class="control-label">Load Gambar</label>
                                        <div class="card-img-top">
        
                                        <?php if(!empty($level->image)) : ?>
                                                <?=tampil_media('uploads/level_soal/'.$level->image);?>
                                            <?php endif;?>
                                            </div>
                                    </div>
                                </div>
                                    <a href="<?=base_url('level')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> 
                                        Batal
                                    </a>
                                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> 
                                        Simpan
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?=form_close();?>
        </div>
    </div>