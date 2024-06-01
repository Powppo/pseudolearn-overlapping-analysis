<div class="row">
    <div class="col-sm-12">
        <?= form_open_multipart('essay/save', array('id' => 'essay'), array('method' => 'add')); ?>
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

                        <!-- 
                            Membuat perulangan jawaban A-J 
                        -->

                        <div class="col-sm-12">
                            <div id="wrappertwo">
                                <div class="" id="formanswer_1">
                                    <label for="file">Jawaban a</label>
                                    <div class="form-group">
                                        <textarea name="jawaban_a" id="jawaban_a" class="form-control"><?= set_value('jawaban_a') ?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_a') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <button onclick="addOption('answer')" type="button" class="btn btn-primary">Tambah jawaban</button>
                                <button onclick="removeOption('answer')" type="button" class="btn btn-danger">Hapus jawaban</button>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label for="bobot" class="control-label">Bobot Essay</label>
                            <input required="required" value="1" type="number" name="bobot" placeholder="Bobot Essay" id="bobot" class="form-control">
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
                        <div class="form-group col-sm-12">
                            <label for="id_soal" class="control-label">Masukan Soal</label>
                            <select required="required" name="id_soal" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Pilih Soal</option>
                                <?php
                                foreach ($tb_soal as $soal) : ?>
                                    <option value="<?= $soal->id_soal ?>"><?= $soal->id_soal ?> - <?= $soal->soal ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group pull-right">
                            <a href="<?= base_url('essay') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
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
                <div class="form-group">
                    <textarea name="jawaban_${answer}" id="jawaban_${answer}" class="form-control"><?= set_value('jawaban_${answer}') ?></textarea>
                    <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_${answer}') ?></small>
                </div>
            </div>`;
        
            $("#wrappertwo").append(elmt);
            $('.froala-editor').froalaEditor({
                theme: 'royal',
                quickInsertTags: null,
                toolbarButtons: ['fullscreen', '|', 'bold', 'italic', 'strikeThrough', 'underline', '|', 'align', 'insertTable', 'insertLink','formatOL', 'formatUL', '|', 'html']
            });
        } else if (type == 'keyanswer') {
            const answerKey = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
            const currentIndex = $("[id*='formkeyanswer_']").length - 1;
            if(answerKey.length == (currentIndex)) return;
            const key = answerKey[currentIndex];
            const elmt = `<div id="formkeyanswer_${key}">
                <div class="col-sm-3">
                    <label for="urutan" class="control-label">Pilih Clue No. ${key} :</label>
                    <div class="col">
                        <label for="urutan">${key} <input type="checkbox" name="chck_${key}" value="urut_${key}"></label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <label for="urutan" class="control-label">Pilih Urutan Jawaban No. ${key} :</label>
                    <select name="urut_${key}" id="urut_${key}" class="form-control select2" style="width:100%!important">
                        <option value="" disabled selected>Pilih Jawaban Urutan Ke ${key}</option>
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

