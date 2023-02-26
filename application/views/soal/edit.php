<div class="row">
    <div class="col-sm-12">
        <?= form_open_multipart('soal/save', array('id' => 'formsoal'), array('method' => 'edit', 'id_soal' => $soal->id_soal)); ?>
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
                        <div class="row">

                            <div class="col-sm-12">
                                <label for="soal" class="control-label text-center">Soal</label>
                                <div class="row">
                                    <!-- <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?= form_error('file_soal') ?></small>
                                        <?php if (!empty($soal->file)) : ?>
                                            <?= tampil_media('uploads/bank_soal/' . $soal->file); ?>
                                        <?php endif; ?>
                                    </div> -->
                                    <div class="form-group col-sm-12">
                                        <textarea name="soal" id="soal" class="form-control froala-editor"><?= $soal->soal ?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?= form_error('soal') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Judul Soal</label>
                                <textarea name="judul" id="judul" class="form-control froala-editor"><?= $soal->judul ?></textarea>
                                <!-- <input required="required" type="text" name="judul" placeholder="Judul Soal" id="judul" class="form-control"> -->
                                <small class="help-block" style="color: #dc3545"><?= form_error('judul') ?></small>
                            </div>
                            <!-- 
                                Variabel & tipe data 
                            -->
                            <div class="col-sm-12">
                                <div id="wrapperone">
                                    <?php
                                        $abjad = ['1', '2', '3', '4', '5', '6', '7', '8'];
                                        foreach ($abjad as $abj) :
                                            $ABJ = strtoupper($abj); // Abjad Kapital
                                            $variable = 'variable_' . $abj;
                                            $jenis_data = 'jenis_data_v' . $abj;
                                    ?>
                                    <div class="row" id="formvartipe_<?= $ABJ ?>">
                                        <div class="col-xs-6">
                                            <label for="file">Variable <?= $ABJ; ?></label>
                                            <div class="form-group">
                                                <input name="variable_<?= $abj; ?>" id="variable_<?= $abj; ?>" class="form-control" value="<?= $soal->$variable ?>">
                                                <small class="help-block" style="color: #dc3545"><?= form_error('variable_' . $abj) ?></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="file">Tipe Data <?= $ABJ; ?></label>
                                            <div class="form-group">
                                                <input name="tipe_data_<?= $abj; ?>" id="tipe_data_<?= $abj; ?>" class="form-control" value="<?= $soal->$jenis_data ?>">
                                                <small class="help-block" style="color: #dc3545"><?= form_error('tipe_data_' . $abj) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mb-2">
                                    <button onclick="addOption('vartipe')" type="button" class="btn btn-primary">Tambah form variable dan tipe data</button>
                                    <button onclick="removeOption('vartipe')" type="button" class="btn btn-danger">Hapus form variable dan tipe data</button>
                                </div>
                            </div>

                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <div class="col-sm-12">
                                <div id="wrappertwo">
                                <?php
                                $abjad = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o'];
                                foreach ($abjad as $key => $abj) :
                                    $ABJ = strtoupper($abj); // Abjad Kapital
                                    $file = 'file_' . $abj;
                                    $opsi = 'opsi_' . $abj;
                                ?>

                                    <div class="" id="formanswer_<?= $key + 1 ?>">
                                        <label for="jawaban_<?= $abj; ?>" class="control-label text-center">Jawaban <?= $ABJ; ?></label>
                                        <div class="row">
                                            <!-- <div class="form-group col-sm-3">
                                                <input type="file" name="<?= $file; ?>" class="form-control">
                                                <small class="help-block" style="color: #dc3545"><?= form_error($file) ?></small>
                                                <?php if (!empty($soal->$file)) : ?>
                                                    <?= tampil_media('uploads/bank_soal/' . $soal->$file); ?>
                                                <?php endif; ?>
                                            </div> -->
                                            <div class="form-group col-sm-12">
                                                <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor"><?= $soal->$opsi ?></textarea>
                                                <small class="help-block" style="color: #dc3545"><?= form_error('jawaban_' . $abj) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                <div class="mb-2">
                                    <button onclick="addOption('answer')" type="button" class="btn btn-primary">Tambah jawaban</button>
                                    <button onclick="removeOption('answer')" type="button" class="btn btn-danger">Hapus jawaban</button>
                                </div>
                            </div>
                            

                            <div class="form-group col-sm-12">
                                <label for="jawaban" class="control-label">Kunci Jawaban</label>
                            </div>

                            <div class="form-group col-sm-12">
                                <div id="wrapperthree">
                                    <?php
                                    $urut = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
                                    foreach ($urut as $urt) :
                                        $clue   = 'clue_' . $urt;
                                        $urutan = 'urut_' . $urt;
                                    ?>
                                        <div id="formkeyanswer_<?= $urt ?>">
                                            <div class="col-sm-3">
                                                <label for="urutan" class="control-label">Pilih Clue No. <?= $urt; ?> :</label>
                                                <div class="col">
                                                    <label for="urutan"><?= $urt; ?>. <input type="checkbox" name="chck_<?= $urt; ?>" value="urut_<?= $urt; ?>" <?php if ($soal->$clue <> '') echo "checked='checked'"; ?>></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for="urutan" class="control-label">Pilih Urutan Jawaban No. <?= $urt; ?> :</label>
                                                <select name="urut_<?= $urt; ?>" id="urut_<?= $urt; ?>" class="form-control select2" style="width:100%!important">
                                                    <option value="" disabled selected>Pilih Jawaban Urutan Ke <?= $urt; ?></option>
                                                    <option <?= $soal->$urutan === "a" ? "selected" : "" ?> value="a">A</option>
                                            <option <?= $soal->$urutan === "b" ? "selected" : "" ?> value="b">B</option>
                                            <option <?= $soal->$urutan === "c" ? "selected" : "" ?> value="c">C</option>
                                            <option <?= $soal->$urutan === "d" ? "selected" : "" ?> value="d">D</option>
                                            <option <?= $soal->$urutan === "e" ? "selected" : "" ?> value="e">E</option>
                                            <option <?= $soal->$urutan === "f" ? "selected" : "" ?> value="f">F</option>
                                            <option <?= $soal->$urutan === "g" ? "selected" : "" ?> value="g">G</option>
                                            <option <?= $soal->$urutan === "h" ? "selected" : "" ?> value="h">H</option>
                                            <option <?= $soal->$urutan === "i" ? "selected" : "" ?> value="i">I</option>
                                            <option <?= $soal->$urutan === "j" ? "selected" : "" ?> value="j">J</option>
                                            <option <?= $soal->$urutan === "k" ? "selected" : "" ?> value="k">K</option>
                                            <option <?= $soal->$urutan === "l" ? "selected" : "" ?> value="l">L</option>
                                            <option <?= $soal->$urutan === "m" ? "selected" : "" ?> value="m">M</option>
                                            <option <?= $soal->$urutan === "n" ? "selected" : "" ?> value="n">N</option>
                                            <option <?= $soal->$urutan === "o" ? "selected" : "" ?> value="o">O</option>
                                                    
                                                </select>
                                                <small class="help-block" style="color: #dc3545"><?= form_error('urut_' . $urt) ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mb-2">
                                    <button onclick="addOption('keyanswer')" type="button" class="btn btn-primary">Tambah kunci jawaban</button>
                                    <button onclick="removeOption('keyanswer')" type="button" class="btn btn-danger">Hapus kunci jawaban</button>
                                </div>
                                
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Bobot Nilai</label>
                                <input required="required" value="<?= $soal->bobot ?>" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?= form_error('bobot') ?></small>
                            </div>
                            <div class="form-group col-sm-12 ">
                                <label for="id_level" class="control-label">Masukan Level</label>
                                <select required="required" name="id_level" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Level</option>
                                    <?php
                                    foreach ($tb_level as $lv) : ?>
                                        <option <?= $soal->id_level == $lv->id_level ? "selected" : ""; ?> value="<?= $lv->id_level ?>"><?= $lv->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group pull-right">
                                    <a href="<?= base_url('soal') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>

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
            
            const elmt = `<div class="" id="formanswer_${answer}">
                <label for="file">Jawaban ${answer}</label>
                <div class="form-group">
                    <textarea name="jawaban_${answer}" id="jawaban_${answer}" class="form-control froala-editor"><?= set_value('jawaban_${answer}') ?></textarea>
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