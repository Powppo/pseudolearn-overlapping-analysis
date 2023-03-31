<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('feedback/save', array('id'=>'formsoal'), array('method'=>'add'));?>
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
                      
                      
                        <div class="form-group col-sm-12">
                            <label for="tipedata" class="control-label">Feedback Tipe Data</label>
                            <input required="required" value="" type="Text" name="feedback_tipedata" placeholder="Masukan Feedback" id="feedback_tipedata" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('feedback_tipedata')?></small>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="algoritma" class="control-label">Feedback Algoritma</label>
                            <input required="required" value="" type="Text" name="feedback_algoritma" placeholder="Masukan Feedback" id="feedback_algoritma" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('feedback_algoritma')?></small>
                        </div>
                        
                        <div class="form-group pull-right">
                            <a href="<?=base_url('feedback')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>