<div class="row">
    <div class="col-sm-12">
        <?= form_open_multipart('soal/save', array('id' => 'formsoal'), array('method' => 'add')); ?>
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
                    <div class="col-sm-8 col-sm-offset-2">

                        <div class="col-sm-12">
                            <label for="soal" class="control-label">Soal</label>
                            <div class="form-group">
                                <small class="help-block" style="color: #dc3545"><?= form_error('file_soal') ?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="soal" id="soal" class="form-control froala-editor"><?= set_value('soal') ?></textarea>
                                <small class="help-block" style="color: #dc3545"><?= form_error('soal') ?></small>
                            </div>
                        </div>
                        <!-- 
                            Judul Soal 
                        -->
                        <div class="form-group col-sm-12">
                            <label for="bobot" class="control-label">Judul Soal</label>
                            <input required="required" type="text" name="judul" placeholder="Judul Soal" id="judul" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?= form_error('judul') ?></small>
                        </div>

                        <!-- 
                            Variabel & tipe data 
                        -->
                        
                        <div class="col-sm-12">
                            <div id="wrapperone">
                                <div class="row" id="formvartipe_1">
                                    <div class="col-xs-6">
                                        <label for="file">Variable 1</label>
                                        <div class="form-group">
                                            <input required="required" name="variable_1" id="variable_1" class="form-control" value="<?= set_value('variable_1') ?>">
                                            <small class="help-block" style="color: #dc3545"><?= form_error('variable_1') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="file">Tipe Data 1</label>
                                        <div class="form-group">
                                            <input required="required" name="tipe_data_1" id="tipe_data_1" class="form-control" value="<?= set_value('tipe_data_1') ?>">
                                            <small class="help-block" style="color: #dc3545"><?= form_error('tipe_data_1') ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button onclick="addOption('vartipe')" type="button" class="btn btn-primary">Tambah form variable dan tipe data</button>
                                <button onclick="removeOption('vartipe')" type="button" class="btn btn-danger">Hapus form variable dan tipe data</button>
                            </div>
                        </div>


                        <!-- 
                            Membuat perulangan jawaban A-J 
                        -->

                        <div class="col-sm-12">
                            <div id="wrappertwo">
                                <div class="" id="formanswer_1">
                                    <label for="file">Jawaban a</label>
                                    <div class="row">
                                    <div class="form-group col-sm-8">
                                        <textarea required="required" name="jawaban_a" id="jawaban_a" class="form-control froala-editor"><?= set_value('jawaban_a') ?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_a') ?></small>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="urutan" class="control-label">Pilih Urutan Jawaban  :</label>
                                        <select name="urut_a" id="urut_a" class="form-control select2" style="width:100%!important">
                                            <option value="" disabled selected>Pilih Jawaban Urutan Ke a</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                            <option value="e">E</option>
                                            <option value="f">F</option>
                                            <option value="g">G</option>
                                            <option value="h">H</option>
                                            <option value="i">I</option>
                                            <option value="j">J</option>
                                            <option value="k">K</option>
                                            <option value="l">L</option>
                                            <option value="m">M</option>
                                            <option value="n">N</option>
                                            <option value="o">O</option>
                                        </select>
                                        <small class="help-block" style="color: #dc3545"><?= form_error('urut_1') ?></small>
                                    </div>
                                    <div class="form-group col-sm-3">
                                    <label for="jawaban" class="control-label">Checklist Clue :</label>
                                        <label for="urutan"><input type="checkbox" name="chck_a" value="urut_a"></label>
                                    </div>
                                    <br>
                                </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button onclick="addOption('answer')" type="button" class="btn btn-primary">Tambah jawaban</button>
                                <button onclick="removeOption('answer')" type="button" class="btn btn-danger">Hapus jawaban</button>
                            </div>
                        </div>

                        <!-- <div class="form-group col-sm-12">
                            <label for="jawaban" class="control-label">Kunci Jawaban</label>
                            <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                            <small class="help-block" style="color: #dc3545"><?= form_error('jawaban') ?></small>
                        </div> -->

                        <!-- <div class="form-group col-sm-12">
                            <label for="jawaban" class="control-label">Kunci Jawaban</label>
                        </div> -->

                        <!-- <div class="form-group col-sm-12">
                            <div id="wrapperthree">
                                <div id="formkeyanswer_1"> -->
                                        <!-- <label for="urutan" class="control-label">Pilih Clue No. 1 :</label>
                                        <div class="col">
                                            <label for="urutan">1. <input type="checkbox" name="chck_1" value="urut_1"></label>
                                        </div> -->
                                 
                                        <!-- <div class="form-group">
                                        <label for="urutan" class="control-label">Pilih Urutan Jawaban  :</label>
                                        <select name="urut_a" id="urut_a" class="form-control select2" style="width:100%!important">
                                            <option value="" disabled selected>Pilih Jawaban Urut</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                            <option value="e">E</option>
                                            <option value="f">F</option>
                                            <option value="g">G</option>
                                            <option value="h">H</option>
                                            <option value="i">I</option>
                                            <option value="j">J</option>
                                            <option value="k">K</option>
                                            <option value="l">L</option>
                                            <option value="m">M</option>
                                            <option value="n">N</option>
                                            <option value="o">O</option>
                                        </select>
                                        <small class="help-block" style="color: #dc3545"><?= form_error('urut_1') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button onclick="addOption('keyanswer')" type="button" class="btn btn-primary">Tambah kunci jawaban</button>
                                <button onclick="removeOption('keyanswer')" type="button" class="btn btn-danger">Hapus kunci jawaban</button>
                            </div>
                        </div>
                         -->
                        
                        <div class="form-group col-sm-12">
                            <label for="bobot" class="control-label">Bobot Soal</label>
                            <input required="required" value="1" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?= form_error('bobot') ?></small>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="id_level" class="control-label">Masukan Level</label>
                            <select required="required" name="id_level" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Pilih Level</option>
                                <?php
                                foreach ($tb_level as $lv) : ?>
                                    <option value="<?= $lv->id_level ?>"><?= $lv->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group pull-right">
                            <a href="<?= base_url('soal') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>



<script>
    const addOption = (type) => {
        if (type == "vartipe") {
            const currentIndex = $("[id*='formvartipe_']").length + 1;
            if(currentIndex == 9) return;
            const elemt = `<div class="row" id="formvartipe_${currentIndex}">
                <div class="col-xs-6">
                    <label for="file">Variable ${currentIndex}</label>
                    <div class="form-group">
                        <input name="variable_${currentIndex}" id="variable_${currentIndex}" class="form-control" value="<?= set_value('variable_${currentIndex}') ?>">
                        <small class="help-block" style="color: #dc3545"><?= form_error('variable_${currentIndex}') ?></small>
                    </div>
                </div>
                <div class="col-xs-6">
                    <label for="file">Tipe Data ${currentIndex}</label>
                    <div class="form-group">
                        <input name="tipe_data_${currentIndex}" id="tipe_data_${currentIndex}" class="form-control" value="<?= set_value('tipe_data_${currentIndex}') ?>">
                        <small class="help-block" style="color: #dc3545"><?= form_error('tipe_data_${currentIndex}') ?></small>
                    </div>
                </div>
            </div>`;
            $("#wrapperone").append(elemt);
        }else if (type == 'answer') {
            const answerTemplate = ['b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
            const currentIndex = $("[id*='formanswer_']").length - 1;

            if (answerTemplate.length == (currentIndex)) return;
            const answer = answerTemplate[currentIndex];
            
            const elmt = `<div class="" id="formanswer_${currentIndex + 2}">
                <label for="file">Jawaban ${answer}</label>
                <div class="row">
                <div class="form-group col-sm-8">
                    <textarea name="jawaban_${answer}" id="jawaban_${answer}" class="form-control froala-editor"><?= set_value('jawaban_${answer}') ?></textarea>
                    <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_${answer}') ?></small>
                </div>
                
                <div class="form-group col-sm-4">
                    <label for="urutan" class="control-label">Pilih Urutan Jawaban :</label>
                    <select name="urut_${answer}" id="urut_${answer}" class="form-control select2" style="width:100%!important">
                        <option value="" disabled selected>Pilih Jawaban Urutan Ke ${answer}</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                        <option value="e">E</option>
                        <option value="f">F</option>
                        <option value="g">G</option>
                        <option value="h">H</option>
                        <option value="i">I</option>
                        <option value="j">J</option>
                        <option value="k">K</option>
                        <option value="l">L</option>
                        <option value="m">M</option>
                        <option value="n">N</option>
                        <option value="o">O</option>
                    </select>
                    <small class="help-block" style="color: #dc3545"><?= form_error('urut_${answer}') ?></small>
                </div>
                <div class="form-group col-sm-3">
                <label for="jawaban" class="control-label">Checklist Clue :</label>
                    <label for="urutan"><input type="checkbox" name="chck_${answer}" value="urut_${answer}"></label>
                </div>
                <br>
                </div>
            </div>`;
        
            $("#wrappertwo").append(elmt);
            $('.froala-editor').froalaEditor({
                theme: 'royal',
                quickInsertTags: null,
                toolbarButtons: ['fullscreen', '|', 'bold', 'italic', 'strikeThrough', 'underline', '|', 'align', 'insertTable', 'insertLink','formatOL', 'formatUL', '|', 'html']
            });
        } else if (type == 'keyanswer') {
            const answerKey = ['b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
            const currentIndex = $("[id*='formkeyanswer_']").length - 1;
            if(answerKey.length == (currentIndex)) return;
            const key = answerKey[currentIndex];
            const elmt = `<div id="formkeyanswer_${key}">
               
            <div class="form-group">
                    <label for="urutan" class="control-label">Pilih Urutan Jawaban :</label>
                    <select name="urut_${key}" id="urut_${key}" class="form-control select2" style="width:100%!important">
                        <option value="" disabled selected>Pilih Jawaban Urut</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                        <option value="e">E</option>
                        <option value="f">F</option>
                        <option value="g">G</option>
                        <option value="h">H</option>
                        <option value="i">I</option>
                        <option value="j">J</option>
                        <option value="k">K</option>
                        <option value="l">L</option>
                        <option value="m">M</option>
                        <option value="n">N</option>
                        <option value="o">O</option>
                    </select>
                    <small class="help-block" style="color: #dc3545"><?= form_error('urut_${key}') ?></small>
                </div>
            </div>`;
            $("#wrapperthree").append(elmt);
        }
    }
    const removeOption = (type) => {
        if (type == 'vartipe') {
            const currentIndex = $("[id*='formvartipe_']").length;
            if(currentIndex == 1) return;
            $(`#formvartipe_${currentIndex}`).remove();
        }else if(type == 'answer'){
            const currentIndex = $("[id*='formanswer_']").length;
            if(currentIndex == 1) return;
            $(`#formanswer_${currentIndex}`).remove();
        }else if(type == 'keyanswer') {
            const currentIndex = $("[id*='formkeyanswer_']").length;
            if(currentIndex == 1) return;
            $(`#formkeyanswer_${currentIndex}`).remove();
        }
    }
</script>