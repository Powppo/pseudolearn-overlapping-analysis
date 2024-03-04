<?php
// if (time() >= $soal->waktu_habis) {
//     //redirect('ujian/list', 'location', 301);
// }
?>
<link rel="stylesheet" href="<?= base_url() ?>template/css/base.css" />
<link rel="stylesheet" href="<?= base_url() ?>template/css/quiz.css" />
<link rel="stylesheet" href="<?= base_url() ?>template/css/alert.css" />
<style>
    .draggable {
        background: #FF6D60;
        border-radius: 10px;
        border: 1px solid #67140c;
        width: 200px;
        padding: 5px;
        margin: 3px;
        text-align: center;
    }

    .drop-zone {
        width: 300px;
        padding: 10px;
        margin: 10px;
        height: 20px;
        background: #eee;
        border: 2px solid #31364c;
        min-height: 36px;
    }

    /* Dragged source element style */
    .dragged {
        opacity: .6;
        border-style: dashed;
    }

    /* Drag feedback image style */
    .drag-feedback {
        background: lightskyblue;
        border: 1px solid dodgerblue;
    }

    /* drop zone highlights */
    .active-zone {
        background: #fffad6;
        border: 2px solid #aaa479;
    }

    .over-zone {
        background: #ffc6c6;
        border: 2px solid #931414;
    }

    /* Style for text drag test area */
    .drag-text-test {
        width: 300px;
        margin: 10px;
    }

    .drag-text-test textarea {
        width: 100%;
        padding: 10px;
        height: 36px;
    }
</style>
<div class="row">
    <div class="col-sm-3">

        <!-- <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Navigasi Soal</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body text-center" id="tampil_jawaban">
            </div>
        </div> -->
    </div>

    <!-- front end waktu pengerjaan -->
    <div class="col-lg-12 col-xs-12">
        <?= form_open('', array('id' => 'ujian')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <label>Waktu Pengerjaan</label>
                <label id="my_timer">00:00:00</label>

                <!-- <div class="box box-primary">
            <div class="box-header with-border"> -->
                <!-- <h3 class="box-title"><span class="badge bg-blue">Soal #<span id="soalke"></span> </span></h3> -->
                <!-- <div class="box-tools pull-right">
                    <span class="badge bg-red">Sisa Waktu <span class="sisawaktu" data-time="<?= $soal->tgl_selesai ?>"></span></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div> -->
            </div>
            <div class="box-body">
                <?= $html ?>
            </div>
            <div class="box-footer text-center">
                <a class="action back btn btn-info" rel="0" onclick="return back();"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                <a class="check btn btn-success" href="#" data-toggle="modal" data-target="#ModalaAdd" rel="1" onclick="check_percobaan();">Check</a>
                <a class="check btn btn-danger" rel="1" onclick="return refresh();">Reload</a>
                <a class="action next btn btn-info" rel="2" onclick="return next();"><i class="glyphicon glyphicon-chevron-right"></i> Next</a>
                <a class="selesai action submit btn btn-danger" onclick="return simpan_akhir();"><i class="glyphicon glyphicon-stop"></i> Selesai</a>
                <input type="hidden" name="jml_soal" id="jml_soal" value="<?= $no; ?>">
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog" style="width:500px; height:300px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" style="font-family: cursive; font-size: 18px;">Apakah yakin dengan jawaban Anda ?</h4>
                <center><img src="<?php echo base_url(); ?>template/images/image1.png" style="width:180px; height:180px; text-align:center"></center>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-check">

                            <label class="form-check-label">
                                <button style="margin-left:20px;" class="btn btn-info" id="btn_simpan" name="btn_simpan" value="yakin" onclick="check_jawaban();">
                                    <h8 style="font-family: cursive;">Yakin</h8>
                                </button>
                                <!-- <input type="radio" class="form-check-input" id="confidence" name="confidence" value="yakin" style="margin-left: 15px;"><h8 style="font-family: cursive;"> Ya</h8> -->
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <button style="margin-left:20px;" class="btn btn-danger" id="btn_simpan2" name="btn_simpan2" value="tidak yakin" onclick="check_jawaban_notsure();">
                                    <h8 style="font-family: cursive;">Tidak Yakin</h8>
                                </button>
                                <!-- <input type="radio" class="form-check-input" id="confidence" name="confidence" value="tidak yakin" style="margin-left: 15px;"><h8 style="font-family: cursive;"> Tidak</h8> -->
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="hidden" class="form-check-input" id="waktu">
                            </label>
                        </div>
                    </div>
                </div>
                <!--             
            <div class="modal-footer">
                <p align="left">Klik button <strong>"Yakin"</strong> jika Anda memilih <b>"Ya"</b></p>
                <p align="left">Klik button <b>"Tidak Yakin"</b> jika Anda memilih <b>"Tidak"</b></p>
            </div> -->
                <div class="modal-footer">
                    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true"><h8 style="font-family: cursive;">Tutup</h8></button> -->
                    <!-- <button class="btn btn-info" id="btn_simpan2" onclick="check_jawaban_notsure();"><h8 style="font-family: cursive;">Tidak Yakin</h8></button>
                    <button class="btn btn-info" id="btn_simpan" onclick="check_jawaban();"><h8 style="font-family: cursive;">Yakin</h8></button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-check-label">
        <input type="hidden" class="form-check-input" id="corrects" name="corrects" value="benar" style="margin-left: 15px;">
        <h8 style="font-family: cursive;">
    </label>
</div>
<div class="form-group">
    <label class="form-check-label">
        <input type="hidden" class="form-check-input" id="incorrects" name="incorrects" value="salah" style="margin-left: 15px;">
        <h8 style="font-family: cursive;">
    </label>
</div>
<div class="form-group">
    <label class="form-check-label">
        <input type="hidden" class="form-check-input" id="waktu" name="waktu" style="margin-left: 15px;">
        <h8 style="font-family: cursive;">
    </label>
</div>
<!--END MODAL ADD-->
<script>
    // function counterFunc(){

    //         var idsoal = $('#id_soal').val();
    //         var iduser = $('#id_user').val();
    //         $.ajax({
    //             url: base_url+'ujian/save_percobaan/' + idsoal + '/' + iduser,
    //             type: 'get',
    //             dataType: 'json',
    //             success: function (data) {
    //                 if (data.status) {
    //                     $(this).removeAttr('disabled');
    //                     reload_ajax();
    //                 }
    //             }
    //         });
    // }

    $(document).ready(function() {
        $('#btn_simpan').on('click', function() {
            $('#ModalaAdd').modal('hide');
            var id_user = $('#id_user').val();
            var id_soal = $('#id_soal').val();
            // var confidence = $('#confidence:checked').val();
            var confidence = $(this).val();
            var status_jawaban = $('#status_jawaban').val();
            var waktu = $('#waktu').val();
            // var waktu = $('#waktu').val();
            $.ajax({
                type: "POST",
                url: base_url + 'ujian/save_confidence/' + id_soal + '/' + id_user,
                dataType: "JSON",
                data: {
                    id_user: id_user,
                    id_soal: id_soal,
                    confidence: confidence,
                    status_jawaban,
                    waktu: waktu
                },
                success: function(data) {
                    $('[name="id_user"]').val("");
                    $('[name="id_soal"]').val("");
                    window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
                    location.reload(); //reload

                }
            });
            return false;

            // $.ajax({
            //     type: "POST",
            //     url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
            //     dataType: "JSON",
            //     data: {
            //         id_user: id_user,
            //         id_soal: id_soal,
            //         status_jawaban,
            //         waktu: waktu
            //     },
            //     success: function(data) {
            //         $('[name="id_user"]').val("");
            //         $('[name="id_soal"]').val("");
            //         window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
            //         location.reload(); //reload

            //     },
            //     error: function(xhr, status, error) {
            //         console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
            //     }
            // });
            // return false;
        });
    });
    // $(document).ready(function() {
    //     $('#btn_simpan').on('click', function() {
    //         $('#ModalaAdd').modal('hide');
    //         var id_user = $('#id_user').val();
    //         var id_soal = $('#id_soal').val();
    //         var status_jawaban = $('#status_jawaban').val();
    //         var waktu = $('#waktu').val();
    //         // var waktu = $('#waktu').val();
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
    //             dataType: "JSON",
    //             data: {
    //                 id_user: id_user,
    //                 id_soal: id_soal,
    //                 status_jawaban,
    //                 waktu: waktu
    //             },
    //             success: function(data) {
    //                 $('[name="id_user"]').val("");
    //                 $('[name="id_soal"]').val("");
    //                 window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
    //                 location.reload(); //reload

    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
    //             }
    //         });
    //         return false;
    //     });
    // });

    $(document).ready(function() {
        $('#btn_simpan2').on('click', function() {
            $('#ModalaAdd').modal('hide');
            var id_user = $('#id_user').val();
            var id_soal = $('#id_soal').val();
            // var confidence = $('#confidence:checked').val();
            var confidence = $(this).val();
            var status_jawaban = $('#status_jawaban').val();
            var waktu = $('#waktu').val();
            var waktu = $('#waktu').val();
            $.ajax({
                type: "POST",
                url: base_url + 'ujian/save_confidence/' + id_soal + '/' + id_user,
                dataType: "JSON",
                data: {
                    id_user: id_user,
                    id_soal: id_soal,
                    confidence: confidence,
                    status_jawaban,
                    waktu: waktu
                },
                success: function(data) {
                    $('[name="id_user"]').val("");
                    $('[name="id_soal"]').val("");
                    window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
                    location.reload(); //reload

                }
            });
            return false;
        });
    });

    $(document).ready(function() {
        $('#btn_corrects').on('click', function() {
            var id_user = $('#id_user').val();
            var id_soal = $('#id_soal').val();
            var condition = $('#corrects').val();
            var status_jawaban = $('#status_jawaban').val();
            var username = $('#username').val();
            $.ajax({
                type: "POST",
                url: base_url + 'ujian/save_condition/' + id_soal + '/' + id_user,
                dataType: "JSON",
                data: {
                    id_user: id_user,
                    id_soal: id_soal,
                    condition: condition,
                    status_jawaban,
                    username: username
                },
                success: function(data) {
                    // $('[name="id_user"]').val("");
                    $('[name="id_soal"]').val("");
                    $('[name="username"]').val("");
                    // $('[name="confidence"]').val("");

                }
            });
            return false;
        });
    });
    // $(document).ready(function() {
    //     $('#btn_corrects').on('click', function() {
    //         var id_user = $('#id_user').val();
    //         var id_soal = $('#id_soal').val();
    //         var condition = $('#corrects').val();
    //         var status_jawaban = $('#status_jawaban').val();
    //         var waktu = $('#waktu').val();
    //         // var waktu = $('#waktu').val();
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
    //             dataType: "JSON",
    //             data: {
    //                 id_user: id_user,
    //                 id_soal: id_soal,
    //                 condition: condition,
    //                 status_jawaban,
    //                 waktu: waktu
    //             },
    //             success: function(data) {
    //                 $('[name="id_user"]').val("");
    //                 $('[name="id_soal"]').val("");
    //                 window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
    //                 location.reload(); //reload

    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
    //             }
    //         });
    //         return false;
    //     });
    // });

    $(document).ready(function() {
        $('#btn_incorrects').on('click', function() {
            var id_user = $('#id_user').val();
            var id_soal = $('#id_soal').val();
            var username = $('#username').val();
            var status_jawaban = $('#status_jawaban').val();
            var condition = $('#incorrects').val();
            $.ajax({
                type: "POST",
                url: base_url + 'ujian/save_condition/' + id_soal + '/' + id_user,
                dataType: "JSON",
                data: {
                    id_user: id_user,
                    id_soal: id_soal,
                    condition: condition,
                    status_jawaban,
                    username: username
                },
                success: function(data) {
                    // $('[name="id_user"]').val("");
                    $('[name="id_soal"]').val("");
                    $('[name="username"]').val("");
                    // $('[name="confidence"]').val("");

                }
            });
            return false;
        });
    });


    function check_jawaban() {
        var err = 0;
        var semuaJawaban = {};
        let tipe_data = 0;
        let input = 0;
        let proc = 0;
        let output = 0;
        // get value of elemen opsi tipe data
        var jd1 = $('#opsi_jenis_1').attr("value");
        var jd2 = $('#opsi_jenis_2').attr("value");
        var jd3 = $('#opsi_jenis_3').attr("value");
        var jd4 = $('#opsi_jenis_4').attr("value");
        var jd5 = $('#opsi_jenis_5').attr("value");
        var jd6 = $('#opsi_jenis_6').attr("value");
        var jd7 = $('#opsi_jenis_7').attr("value");
        var jd8 = $('#opsi_jenis_8').attr("value");
        if ($('#jenis_1').length > 0) {
            if ((jd1 == jd2) && (jd1 == jd3)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd4)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd4)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd6) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd6) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd7) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd2) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd3) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd4) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd5) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd6) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd7) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd8) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_1 #opsi_jenis_1').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_1').css('background', '#efff00')
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_2').length > 0) {
            if ((jd2 == jd1) && (jd2 == jd3)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd4)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#red')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd4)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd6) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd6) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd7) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd1) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd3) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd4) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd5) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd6) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd7) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd8) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_2 #opsi_jenis_2').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_2').css('background', '#efff00')
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_3').length > 0) {
            if ((jd3 == jd1) && (jd3 == jd2)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd4)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd4)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd6) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd6) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd7) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd1) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd2) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd4) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd5) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd6) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd7) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd8) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_3 #opsi_jenis_3').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_3').css('background', '#efff00')
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_4').length > 0) {
            if ((jd4 == jd1) && (jd4 == jd2)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd3)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd3)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd6) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd6) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd7) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd1) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd2) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd3) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd5) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd6) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd7) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd8) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_4 #opsi_jenis_4').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_4').css('background', '#efff00')
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_5').length > 0) {
            if ((jd5 == jd1) && (jd5 == jd2)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd3)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd3)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd6) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd6) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd7) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd1) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd2) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd3) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd4) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd6) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd7) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd8) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_5 #opsi_jenis_5').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_5').css('background', '#efff00')
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_6').length > 0) {
            if ((jd6 == jd1) && (jd6 == jd2)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd3)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd3)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd5) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd5) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd7) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd1) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd2) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd3) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd4) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd5) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd7) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd8) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_6 #opsi_jenis_6').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_6').css('background', '#efff00')
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_7').length > 0) {
            if ((jd7 == jd1) && (jd7 == jd2)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd3)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd3)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd5)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd6)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd5) && (jd7 == jd6)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd5) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd6) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd1) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd2) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd3) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd4) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd5) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd6) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd8) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_7 #opsi_jenis_7').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_7').css('background', '#efff00')
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_8').length > 0) {
            if ((jd8 == jd1) && (jd8 == jd2)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd3)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd3)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd5) && (jd8 == j6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd5) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd6) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd1) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd2) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd3) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd4) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd5) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd6) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd7) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_8 #opsi_jenis_8').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_8').css('background', '#efff00')
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            }
        }

        if ($('#jawaban_a').length > 0) {
            var jawabanA = $('#jawaban_a #opsi_a').val();
            semuaJawaban['a'] = jawabanA;
            if ($('#jawaban_a #opsi_a').length < 1) { //input data
                err = 1
                input++
                // alert('Urutan Pertama salah')
                $('#jawaban_a').css('background', '#efff00')
            } else {
                $('#jawaban_a').css('background', '#efff00');
            }
        }

        if ($('#jawaban_b').length > 0) {
            var jawabanB = $('#jawaban_b #opsi_b').val();
            semuaJawaban['b'] = jawabanB;
            if ($('#jawaban_b #opsi_b').length < 1) { //input data
                err = 1
                input++;
                // alert('Urutan Kedua salah')
                $('#jawaban_b').css('background', '#efff00')
            } else {
                $('#jawaban_b').css('background', '#efff00');
            }
        }

        if ($('#jawaban_c').length > 0) {
            var jawabanC = $('#jawaban_c #opsi_c').val();
            semuaJawaban['c'] = jawabanC;
            if ($('#jawaban_c #opsi_c').length < 1) { //process
                err = 1
                proc++;
                // alert('Urutan ketiga salah')
                $('#jawaban_c').css('background', '#efff00')
            } else {
                $('#jawaban_c').css('background', '#efff00');
            }
        }

        if ($('#jawaban_d').length > 0) {
            var jawabanD = $('#jawaban_d #opsi_d').val();
            semuaJawaban['d'] = jawabanD;
            if ($('#jawaban_d #opsi_d').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_d').css('background', '#efff00')
            } else {
                $('#jawaban_d').css('background', '#efff00');
            }
        }

        if ($('#jawaban_e').length > 0) {
            var jawabanE = $('#jawaban_e #opsi_e').val();
            semuaJawaban['e'] = jawabanE;
            if ($('#jawaban_e #opsi_e').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_e').css('background', '#efff00')
            } else {
                $('#jawaban_e').css('background', '#efff00');
            }
        }

        if ($('#jawaban_f').length > 0) {
            var jawabanF = $('#jawaban_f #opsi_f').val();
            semuaJawaban['f'] = jawabanF;
            if ($('#jawaban_f #opsi_f').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_f').css('background', '#efff00')
            } else {
                $('#jawaban_f').css('background', '#efff00');
            }
        }

        if ($('#jawaban_g').length > 0) {
            var jawabanG = $('#jawaban_g #opsi_g').val();
            semuaJawaban['g'] = jawabanG;
            if ($('#jawaban_g #opsi_g').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_g').css('background', '#efff00')
            } else {
                $('#jawaban_g').css('background', '#efff00');
            }
        }

        if ($('#jawaban_h').length > 0) {
            var jawabanH = $('#jawaban_h #opsi_h').val();
            semuaJawaban['h'] = jawabanH;
            if ($('#jawaban_h #opsi_h').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_h').css('background', '#efff00')
            } else {
                $('#jawaban_h').css('background', '#efff00');
            }
        }

        if ($('#jawaban_i').length > 0) {
            var jawabanI = $('#jawaban_i #opsi_i').val();
            semuaJawaban['i'] = jawabanI;
            if ($('#jawaban_i #opsi_i').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_i').css('background', '#efff00')
            } else {
                $('#jawaban_i').css('background', '#efff00');
            }
        }

        if ($('#jawaban_j').length > 0) {
            var jawabanJ = $('#jawaban_j #opsi_j').val();
            semuaJawaban['j'] = jawabanJ;
            if ($('#jawaban_j #opsi_j').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_j').css('background', '#efff00')
            } else {
                $('#jawaban_j').css('background', '#efff00');
            }
        }

        if ($('#jawaban_k').length > 0) {
            var jawabanK = $('#jawaban_k #opsi_k').val();
            semuaJawaban['k'] = jawabanK;
            if ($('#jawaban_k #opsi_k').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_k').css('background', '#efff00')
            } else {
                $('#jawaban_k').css('background', '#efff00');
            }
        }

        if ($('#jawaban_l').length > 0) {
            var jawabanL = $('#jawaban_l #opsi_l').val();
            semuaJawaban['l'] = jawabanL;
            if ($('#jawaban_l #opsi_l').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_l').css('background', '#efff00')
            } else {
                $('#jawaban_l').css('background', '#efff00');
            }
        }

        if ($('#jawaban_m').length > 0) {
            var jawabanM = $('#jawaban_m #opsi_m').val();
            semuaJawaban['m'] = jawabanM;
            if ($('#jawaban_m #opsi_m').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_m').css('background', '#efff00')
            } else {
                $('#jawaban_m').css('background', '#efff00');
            }
        }

        if ($('#jawaban_n').length > 0) {
            var jawabanN = $('#jawaban_n #opsi_n').val();
            semuaJawaban['n'] = jawabanN;
            if ($('#jawaban_n #opsi_n').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_n').css('background', '#efff00')
            } else {
                $('#jawaban_n').css('background', '#efff00');
            }
        }

        if ($('#jawaban_o').length > 0) {
            var jawabanO = $('#jawaban_o #opsi_o').val();
            semuaJawaban['o'] = jawabanO;
            if ($('#jawaban_o #opsi_o').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_o').css('background', '#efff00')
            } else {
                $('#jawaban_o').css('background', '#efff00');
            }
        }

        if ($('#jawaban_p').length > 0) {
            var jawabanP = $('#jawaban_p #opsi_p').val();
            semuaJawaban['p'] = jawabanP;
            if ($('#jawaban_p #opsi_p').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_p').css('background', '#efff00')
            } else {
                $('#jawaban_p').css('background', '#efff00');
            }
        }

        if ($('#jawaban_q').length > 0) {
            var jawabanQ = $('#jawaban_q #opsi_q').val();
            semuaJawaban['q'] = jawabanQ;
            if ($('#jawaban_q #opsi_q').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_q').css('background', '#efff00')
            } else {
                $('#jawaban_q').css('background', '#efff00');
            }
        }

        if ($('#jawaban_r').length > 0) {
            var jawabanR = $('#jawaban_r #opsi_r').val();
            semuaJawaban['r'] = jawabanR;
            if ($('#jawaban_r #opsi_r').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_r').css('background', '#efff00')
            } else {
                $('#jawaban_r').css('background', '#efff00');
            }
        }

        if ($('#jawaban_s').length > 0) {
            var jawabanS = $('#jawaban_s #opsi_s').val();
            semuaJawaban['s'] = jawabanS;
            if ($('#jawaban_s #opsi_s').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_s').css('background', '#efff00')
            } else {
                $('#jawaban_s').css('background', '#efff00');
            }
        }

        if ($('#jawaban_t').length > 0) {
            var jawabanT = $('#jawaban_t #opsi_t').val();
            semuaJawaban['t'] = jawabanT;
            if ($('#jawaban_t #opsi_t').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_t').css('background', '#efff00')
            } else {
                $('#jawaban_t').css('background', '#efff00');
            }
        }

        if ($('#jawaban_u').length > 0) {
            var jawabanU = $('#jawaban_u #opsi_u').val();
            semuaJawaban['u'] = jawabanU;
            if ($('#jawaban_u #opsi_u').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_u').css('background', '#efff00')
            } else {
                $('#jawaban_u').css('background', '#efff00');
            }
        }

        if ($('#jawaban_v').length > 0) {
            var jawabanV = $('#jawaban_v #opsi_v').val();
            semuaJawaban['v'] = jawabanV;
            if ($('#jawaban_v #opsi_v').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_v').css('background', '#efff00')
            } else {
                $('#jawaban_v').css('background', '#efff00');
            }
        }

        if ($('#jawaban_w').length > 0) {
            var jawabanW = $('#jawaban_w #opsi_w').val();
            semuaJawaban['w'] = jawabanW;
            if ($('#jawaban_w #opsi_w').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_w').css('background', '#efff00')
            } else {
                $('#jawaban_w').css('background', '#efff00');
            }
        }

        if ($('#jawaban_x').length > 0) {
            var jawabanX = $('#jawaban_x #opsi_x').val();
            semuaJawaban['x'] = jawabanX;
            if ($('#jawaban_x #opsi_x').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_x').css('background', '#efff00')
            } else {
                $('#jawaban_x').css('background', '#efff00');
            }
        }

        if ($('#jawaban_y').length > 0) {
            var jawabanY = $('#jawaban_y #opsi_y').val();
            semuaJawaban['y'] = jawabanY;
            if ($('#jawaban_y #opsi_y').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_y').css('background', '#efff00')
            } else {
                $('#jawaban_y').css('background', '#efff00');
            }
        }

        if ($('#jawaban_z').length > 0) {
            var jawabanZ = $('#jawaban_z #opsi_z').val();
            semuaJawaban['z'] = jawabanZ;
            if ($('#jawaban_z #opsi_z').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_z').css('background', '#efff00')
            } else {
                $('#jawaban_z').css('background', '#efff00');
            }
        }

        if ($('#jawaban_v').length > 0) {
            var jawabanV = $('#jawaban_v #opsi_v').val();
            semuaJawaban['v'] = jawabanV;
            if ($('#jawaban_v #opsi_v').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_v').css('background', '#efff00')
            } else {
                $('#jawaban_v').css('background', '#efff00')
            }
        }

        if (err == 1) {
            $('#fail-alert').css('display', 'flex');
            $('#fail-alert').css('opacity', '1');
            if (tipe_data > 0) {
                $('#tipe_data_feedback').css('display', '');
            }
            if (input > 0) {
                $('#input_feedback').css('display', '');
            }
            if (proc > 0) {
                $('#process_feedback').css('display', '');
            }
            if (output > 0) {
                $('#output_feedback').css('display', '');
            }
        } else {
            $('#success-alert').css('display', 'flex');
            $('#success-alert').css('opacity', '1');
        }

        // Variabel untuk menyimpan status jawaban tipe data dan algoritma
        var status_jawaban_tipedata = 0; // Default 0
        var status_jawaban_algoritma = 0; // Default 0

        // Logika untuk menentukan status jawaban berdasarkan feedback
        if (tipe_data > 0 && input == 0 && proc == 0 && output == 0) {
            status_jawaban_tipedata = 1; // Jawaban salah untuk tipe data
        }

        if ((input > 0 || proc > 0 || output > 0) && tipe_data == 0) {
            status_jawaban_algoritma = 1; // Jawaban salah untuk algoritma
        }

        var idsoal = $('#id_soal').val();
        var iduser = $('#id_user').val();
        $.ajax({
            url: base_url + 'ujian/save_history/' + idsoal + '/' + iduser,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $(this).removeAttr('disabled');
                    reload_ajax();
                }
            }
        });
        $(document).ready(function() {
            $('#btn_incorrects').on('click', function() {
                var id_user = $('#id_user').val();
                var id_soal = $('#id_soal').val();
                var condition = $('#incorrects').val();
                var status_jawaban = $('#status_jawaban').val();
                var waktu = $('#waktu').val();

                // Objek untuk menyimpan jawaban tipe data
                var tipeDataJawaban = {};

                // Objek untuk menyimpan jawaban algoritma
                var algoritmaJawaban = {};

                // Iterasi melalui setiap .drop-zone
                $('.drop-zone').each(function() {
                    var dropZoneId = $(this).attr('id'); // Mendapatkan ID .drop-zone
                    var jawaban = $(this).text().trim(); // Mengambil nilai jawaban dari .drop-zone

                    // Memisahkan jawaban berdasarkan pola ID
                    if (dropZoneId.startsWith('jenis_')) {
                        tipeDataJawaban[dropZoneId] = jawaban; // Menyimpan jawaban tipe data
                        // statusJawabanTipeData[dropZoneId] = getStatusJawaban(jawaban);
                    } else if (dropZoneId.startsWith('jawaban_')) {
                        algoritmaJawaban[dropZoneId] = jawaban; // Menyimpan jawaban algoritma
                        // statusJawabanAlgoritma[dropZoneId] = getStatusJawaban(jawaban);
                    }
                });
                // Mengirimkan data ke server melalui AJAX
                $.ajax({
                    type: "POST",
                    url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
                    dataType: "JSON",
                    data: {
                        id_user: id_user,
                        id_soal: id_soal,
                        condition: condition,
                        status_jawaban: status_jawaban,
                        tipe_data_jawaban: JSON.stringify(tipeDataJawaban), // Jawaban tipe data
                        jawaban: JSON.stringify(algoritmaJawaban), // Jawaban algoritma
                        status_jawaban_tipedata: status_jawaban_tipedata, // Status jawaban tipe data
                        status_jawaban_algoritma: status_jawaban_algoritma,
                        waktu: waktu
                    },
                    success: function(data) {
                        $('[name="id_user"]').val("");
                        $('[name="id_soal"]').val("");
                        window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
                        location.reload(); //reload
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
                    }
                });
                return false;
            });
        });



        // $(document).ready(function() {
        //     $('#btn_incorrects').on('click', function() {
        //         var id_user = $('#id_user').val();
        //         var id_soal = $('#id_soal').val();
        //         var condition = $('#incorrects').val();
        //         var status_jawaban = $('#status_jawaban').val();
        //         var waktu = $('#waktu').val();

        //         // Iterasi melalui setiap .drop-zone
        //         $('.drop-zone').each(function() {
        //             var dropZoneId = $(this).attr('id'); // Mendapatkan ID .drop-zone
        //             var jawaban = $(this).text().trim(); // Mengambil nilai jawaban dari .drop-zone

        //             semuaJawaban[dropZoneId] = jawaban; // Menyimpan jawaban ke objek semuaJawaban
        //         });

        //         $.ajax({
        //             type: "POST",
        //             url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
        //             dataType: "JSON",
        //             data: {
        //                 id_user: id_user,
        //                 id_soal: id_soal,
        //                 condition: condition,
        //                 status_jawaban: status_jawaban,
        //                 jawaban: JSON.stringify(semuaJawaban),
        //                 waktu: waktu
        //             },
        //             success: function(data) {
        //                 $('[name="id_user"]').val("");
        //                 $('[name="id_soal"]').val("");
        //                 window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
        //                 location.reload(); //reload
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
        //             }
        //         });
        //         return false;
        //     });
        // });
        $(document).ready(function() {
            $('#btn_corrects').on('click', function() {
                var id_user = $('#id_user').val();
                var id_soal = $('#id_soal').val();
                var condition = $('#corrects').val();
                var status_jawaban = $('#status_jawaban').val();
                var waktu = $('#waktu').val();

                $('[id^="opsi_"]').each(function() {
                    var opsiId = $(this).attr('id').replace('opsi_', ''); // Mendapatkan id opsi (contoh: a, b, c, dst.)
                    var jawaban = $(this).val(); // Mengambil nilai jawaban dari opsi

                    semuaJawaban[opsiId] = jawaban; // Menyimpan jawaban dalam objek semuaJawaban
                });

                $.ajax({
                    type: "POST",
                    url: base_url + 'overlappinganalysis/save_history_overlapping/' + id_soal + '/' + id_user,
                    dataType: "JSON",
                    data: {
                        id_user: id_user,
                        id_soal: id_soal,
                        condition: condition,
                        status_jawaban: status_jawaban,
                        jawaban: JSON.stringify(semuaJawaban),
                        waktu: waktu
                    },
                    success: function(data) {
                        $('[name="id_user"]').val("");
                        $('[name="id_soal"]').val("");
                        window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
                        location.reload(); //reload
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Tampilkan pesan kesalahan di konsol
                    }
                });
                return false;
            });
        });



        // var idsoal = $('#id_soal').val();
        // var iduser = $('#id_user').val();
        // $.ajax({
        //     url: base_url+'ujian/save_detail_confidence/' + idsoal + '/' + iduser,
        //     type: 'get',
        //     dataType: 'json',
        //     success: function (data) {
        //         if (data.status) {
        //             $(this).removeAttr('disabled');
        //             reload_ajax();
        //         }
        //     }
        // });
    }

    function getStatusJawaban(jawaban) {
        return (jawaban.trim() === '') ? 'benar' : 'salah';
    }


    function check_percobaan() {
        var id_soal = $('#id_soal').val();
        var id_user = $('#id_user').val();
        var id_level = $('#id_level').val();
        var jumlah = $('#jumlah').val();
        $.ajax({
            url: base_url + 'ujian/save_percobaan/' + '<?= $id_tes; ?>' + '/' + '<?php echo $levelId ?>',
            type: 'get',
            dataType: "JSON",
            data: {
                id_soal: id_soal,
                id_user: id_user,
                id_level: id_level,
                jumlah: jumlah
            },
            success: function(data) {
                if (data.status) {
                    $(this).removeAttr('disabled');
                    reload_ajax();
                }
            }
        });

        // var idsoal = $('#id_soal').val();
        // var iduser = $('#id_user').val();
        // var idlevel = $('#id_level').val();
        // $.ajax({
        //     url: base_url+'ujian/save_percobaan/' + '<?= $id_tes; ?>' + '/' + '<?php echo $levelId ?>',
        //     type: 'get',
        //     dataType: 'json',
        //     success: function (data) {
        //         if (data.status) {
        //             $(this).removeAttr('disabled');
        //             reload_ajax();
        //         }
        //     }
        // });
    }

    function refresh() {
        location.reload();
    }

    function close_alert() {
        $('#fail-alert').css('display', 'none');
        $('#fail-alert').css('opacity', '0');
    }

    function submit_nilai(id, level) {
        $.getJSON(base_url + 'ujian/simpan_hasil/' + id, function(data) {
            window.localStorage.clear();
            window.location.href = '<?php echo site_url("ujian/list_ujian"); ?>/' + level
        });
    }
    initDragAndDrop();

    function initDragAndDrop() {
        // Collect all draggable elements and drop zones
        let draggables = document.querySelectorAll(".draggable");
        let dropZones = document.querySelectorAll(".drop-zone");
        initDraggables(draggables);
        initDropZones(dropZones);
    }

    function initDraggables(draggables) {
        for (const draggable of draggables) {
            initDraggable(draggable);
        }
    }

    function initDropZones(dropZones) {
        for (let dropZone of dropZones) {
            initDropZone(dropZone);
        }
    }

    /**
     * Set all event listeners for draggable element
     * https://developer.mozilla.org/en-US/docs/Web/API/DragEvent#Event_types
     */
    function initDraggable(draggable) {
        draggable.addEventListener("dragstart", dragStartHandler);
        draggable.addEventListener("drag", dragHandler);
        draggable.addEventListener("dragend", dragEndHandler);

        // set draggable elements to draggable
        draggable.setAttribute("draggable", "true");
    }

    /**
     * Set all event listeners for drop zone
     * https://developer.mozilla.org/en-US/docs/Web/API/DragEvent#Event_types
     */
    function initDropZone(dropZone) {
        dropZone.addEventListener("dragenter", dropZoneEnterHandler);
        dropZone.addEventListener("dragover", dropZoneOverHandler);
        dropZone.addEventListener("dragleave", dropZoneLeaveHandler);
        dropZone.addEventListener("drop", dropZoneDropHandler);
    }

    /**
     * Start of drag operation, highlight drop zones and mark dragged element
     * The drag feedback image will be generated after this function
     * https://developer.mozilla.org/en-US/docs/Web/API/HTML_Drag_and_Drop_API/Drag_operations#dragfeedback
     */
    function dragStartHandler(e) {
        setDropZonesHighlight();
        this.classList.add('dragged', 'drag-feedback');
        // we use these data during the drag operation to decide
        // if we handle this drag event or not
        e.dataTransfer.setData("type/dragged-box", 'dragged');
        e.dataTransfer.setData("text/plain", this.textContent.trim());
        deferredOriginChanges(this, 'drag-feedback');
    }

    /**
     * While dragging is active we can do something
     */
    function dragHandler() {
        // do something... if you want
    }

    /**
     * Very last step of the drag operation, remove all added highlights and others
     */
    function dragEndHandler() {
        setDropZonesHighlight(false);
        this.classList.remove('dragged');
    }

    /**
     * When entering a drop zone check if it should be allowed to
     * drop an element here and highlight the zone if needed
     */
    function dropZoneEnterHandler(e) {
        // we can only check the data transfer type, not the value for security reasons
        // https://www.w3.org/TR/html51/editing.html#drag-data-store-mode
        if (e.dataTransfer.types.includes('type/dragged-box')) {
            this.classList.add("over-zone");
            // The default action of this event is to set the dropEffect to "none" this way
            // the drag operation would be disallowed here we need to prevent that
            // if we want to allow the dragged element to be drop here
            // https://developer.mozilla.org/en-US/docs/Web/API/Document/dragenter_event
            // https://developer.mozilla.org/en-US/docs/Web/API/DataTransfer/dropEffect
            e.preventDefault();
        }
    }

    /**
     * When moving inside a drop zone we can check if it should be
     * still allowed to drop an element here
     */
    function dropZoneOverHandler(e) {
        if (e.dataTransfer.types.includes('type/dragged-box')) {
            // The default action is similar as above, we need to prevent it
            e.preventDefault();
        }
    }

    /**
     * When we leave a drop zone we check if we should remove the highlight
     */
    function dropZoneLeaveHandler(e) {
        if (e.dataTransfer.types.includes('type/dragged-box') &&
            e.relatedTarget !== null &&
            e.currentTarget !== e.relatedTarget.closest('.drop-zone')) {
            // https://developer.mozilla.org/en-US/docs/Web/API/MouseEvent/relatedTarget
            this.classList.remove("over-zone");
        }
    }

    /**
     * On successful drop event, move the element
     */
    function dropZoneDropHandler(e) {
        // We have checked in the "dragover" handler (dropZoneOverHandler) if it is allowed
        // to drop here, so it should be ok to move the element without further checks
        let draggedElement = document.querySelector('.dragged');
        e.currentTarget.appendChild(draggedElement);

        // We  drop default action (eg. move selected text)
        // default actions detailed here:
        // https://www.w3.org/TR/html51/editing.html#drag-and-drop-processing-model
        e.preventDefault();

    }


    /**
     * Highlight all drop zones or remove highlight
     */
    function setDropZonesHighlight(highlight = true) {
        const dropZones = document.querySelectorAll(".drop-zone");
        for (const dropZone of dropZones) {
            if (highlight) {
                dropZone.classList.add("active-zone");
            } else {
                dropZone.classList.remove("active-zone");
                dropZone.classList.remove("over-zone");
            }
        }
    }

    /**
     * After the drag feedback image has been generated we can remove the class we added
     * for the image generation and/or change the originally dragged element
     * https://javascript.info/settimeout-setinterval#zero-delay-settimeout
     */
    function deferredOriginChanges(origin, dragFeedbackClassName) {
        setTimeout(() => {
            origin.classList.remove(dragFeedbackClassName);
        });
    }

    function checkOrder() {
        listItems.forEach((listItem, index) => {
            const personName = listItem.querySelector('.draggable').innerText.trim();
            if (personName !== richestPeople[index]) {
                listItem.classList.add('wrong');
            } else {
                listItem.classList.add('right');
                listItem.classList.remove('wrong');
            }
        });
    }
</script>
<script src="<?= base_url() ?>template/js/quiz.js"></script>
<script type="text/javascript">
    var base_url = "<?= base_url(); ?>";
    var id_tes = "<?= $id_tes; ?>";
    var widget = $(".step");
    var total_widget = widget.length;
</script>


<!-- start waktu pengerjaan -->
<script type="text/javascript">
    var seconds = 0;
    // console.log(window.localStorage.getItem('taken_time_quiz_'+'<?= $id_tes; ?>'));
    var timeTaken = '<?php echo $timeTaken ?>';
    if (timeTaken == '') {
        if (window.localStorage.getItem('taken_time_quiz_' + '<?= $id_tes; ?>') != null) {
            seconds = window.localStorage.getItem('taken_time_quiz_' + '<?= $id_tes; ?>');
        } else {
            window.localStorage.removeItem('taken_time_quiz_' + '<?= $id_tes; ?>');
            seconds = 0;
            window.localStorage.setItem('taken_time_quiz_' + '<?= $id_tes; ?>', seconds);
        }
    } else {
        var plush = timeTaken;
        seconds = plush;
    }


    var timer = setInterval(upTimer, 1000);

    function upTimer() {
        ++seconds;
        var hour = Math.floor(seconds / 3600);
        var minute = Math.floor((seconds - hour * 3600) / 60);
        var updSecond = seconds - (hour * 3600 + minute * 60);

        document.getElementById("my_timer").innerHTML = hour + ":" + minute + ":" + updSecond;
        document.getElementById("waktu").value = hour + ":" + minute + ":" + updSecond;
        saveTimeTaken(seconds);

    }

    function saveTimeTaken(seconds) {
        window.localStorage.setItem('taken_time_quiz_' + '<?= $id_tes; ?>', seconds);
    }
    var minutesLabel = document.getElementById("minutes");
    // var secondsLabel = document.getElementById("seconds");
    // var totalSeconds = 0;
    // setInterval(setTime, 1000);
    // document.getElementById("waktu").value = minutes + "minutes" + seconds + "seconds";
    // function setTime()
    // {
    //     ++totalSeconds;
    //     secondsLabel.innerHTML = pad(totalSeconds%60);
    //     minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
    // }

    // function pad(val)
    // {
    //     var valString = val + "";
    //     if(valString.length < 2)
    //     {
    //         return "0" + valString;
    //     }
    //     else
    //     {
    //         return valString;
    //     }
    // }
</script>
<!-- end waktu pengerjaan -->
<script>
    function check_jawaban_notsure() {
        var err = 0;
        let tipe_data = 0;
        let input = 0;
        let proc = 0;
        let output = 0;
        // get value of elemen opsi tipe data
        var jd1 = $('#opsi_jenis_1').attr("value");
        var jd2 = $('#opsi_jenis_2').attr("value");
        var jd3 = $('#opsi_jenis_3').attr("value");
        var jd4 = $('#opsi_jenis_4').attr("value");
        var jd5 = $('#opsi_jenis_5').attr("value");
        var jd6 = $('#opsi_jenis_6').attr("value");
        var jd7 = $('#opsi_jenis_7').attr("value");
        var jd8 = $('#opsi_jenis_8').attr("value");
        if ($('#jenis_1').length > 0) {
            if ((jd1 == jd2) && (jd1 == jd3)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd4)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd2) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd4)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd3) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd5)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd4) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd6)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd5) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd6) && (jd1 == jd7)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd6) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if ((jd1 == jd7) && (jd1 == jd8)) {
                if ((($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1)) && (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd2) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd3) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd4) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd5) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd6) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd7) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else if (jd1 == jd8) {
                if (($('#jenis_1 #opsi_jenis_1').length < 1) == ($('#jenis_1 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_1').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_1 #opsi_jenis_1').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_1').css('background', '#efff00')
                } else {
                    $('#jenis_1').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_2').length > 0) {
            if ((jd2 == jd1) && (jd2 == jd3)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd4)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd1) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd4)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd3) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd5)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd4) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd6)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd5) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd6) && (jd2 == jd7)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd6) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if ((jd2 == jd7) && (jd2 == jd8)) {
                if ((($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1)) && (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd1) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd3) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd4) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd5) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd6) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd7) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else if (jd2 == jd8) {
                if (($('#jenis_2 #opsi_jenis_2').length < 1) == ($('#jenis_2 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_2').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_2 #opsi_jenis_2').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_2').css('background', '#efff00')
                } else {
                    $('#jenis_2').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_3').length > 0) {
            if ((jd3 == jd1) && (jd3 == jd2)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd4)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd1) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd4)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd2) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd5)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd4) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd6)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd5) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd6) && (jd3 == jd7)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd6) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if ((jd3 == jd7) && (jd3 == jd8)) {
                if ((($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1)) && (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd1) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd2) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd4) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd5) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd6) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd7) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else if (jd3 == jd8) {
                if (($('#jenis_3 #opsi_jenis_3').length < 1) == ($('#jenis_3 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_3').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_3 #opsi_jenis_3').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_3').css('background', '#efff00')
                } else {
                    $('#jenis_3').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_4').length > 0) {
            if ((jd4 == jd1) && (jd4 == jd2)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd3)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd1) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd3)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd2) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd5)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd3) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd6)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd5) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd6) && (jd4 == jd7)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd6) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if ((jd4 == jd7) && (jd4 == jd8)) {
                if ((($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1)) && (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd1) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd2) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd3) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd5) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd6) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd7) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else if (jd4 == jd8) {
                if (($('#jenis_4 #opsi_jenis_4').length < 1) == ($('#jenis_4 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_4').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_4 #opsi_jenis_4').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_4').css('background', '#efff00')
                } else {
                    $('#jenis_4').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_5').length > 0) {
            if ((jd5 == jd1) && (jd5 == jd2)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd3)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd1) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd3)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd2) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd4)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd3) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd6)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd4) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd6) && (jd5 == jd7)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd6) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if ((jd5 == jd7) && (jd5 == jd8)) {
                if ((($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1)) && (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd1) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd2) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd3) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd4) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd6) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd7) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else if (jd5 == jd8) {
                if (($('#jenis_5 #opsi_jenis_5').length < 1) == ($('#jenis_5 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_5').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_5 #opsi_jenis_5').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_5').css('background', '#efff00')
                } else {
                    $('#jenis_5').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_6').length > 0) {
            if ((jd6 == jd1) && (jd6 == jd2)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd3)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd1) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd3)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd2) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd4)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd3) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd5)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd4) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd5) && (jd6 == jd7)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd5) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if ((jd6 == jd7) && (jd6 == jd8)) {
                if ((($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1)) && (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd1) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd2) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd3) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd4) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd5) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd7) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else if (jd6 == jd8) {
                if (($('#jenis_6 #opsi_jenis_6').length < 1) == ($('#jenis_6 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_6').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_6 #opsi_jenis_6').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_6').css('background', '#efff00')
                } else {
                    $('#jenis_6').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_7').length > 0) {
            if ((jd7 == jd1) && (jd7 == jd2)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd3)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd1) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd3)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd2) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd4)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd5)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd6)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd3) && (jd7 == jd8)) {
                if ((($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) && (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1))) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd5)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd6)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd4) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd5) && (jd7 == jd6)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd5) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if ((jd7 == jd6) && (jd7 == jd8)) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd1) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd2) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd3) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd4) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd5) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd6) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else if (jd7 == jd8) {
                if (($('#jenis_7 #opsi_jenis_7').length < 1) == ($('#jenis_7 #opsi_jenis_8').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_7').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_7 #opsi_jenis_7').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_7').css('background', '#efff00')
                } else {
                    $('#jenis_7').css('background', '#efff00')
                }
            }
        }

        if ($('#jenis_8').length > 0) {
            if ((jd8 == jd1) && (jd8 == jd2)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd3)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd1) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd3)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd2) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd4)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd3) && (jd8 == jd7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j5)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd4) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd5) && (jd8 == j6)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd5) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if ((jd8 == jd6) && (jd8 == j7)) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Pertama salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan pertama salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd1) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_1').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd2) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_2').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd3) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_3').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd4) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_4').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd5) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_5').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd6) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_6').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else if (jd8 == jd7) {
                if (($('#jenis_8 #opsi_jenis_8').length < 1) == ($('#jenis_8 #opsi_jenis_7').length < 1)) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan Kedua salah')
                    $('#jenis_8').css('background', '#efff00')
                    // alert("Tipe data yang dimasukkan kedua salah"); 
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            } else {
                if ($('#jenis_8 #opsi_jenis_8').length < 1) { //tipe data
                    err = 1
                    tipe_data++;
                    // alert('Urutan ketiga salah')
                    $('#jenis_8').css('background', '#efff00')
                } else {
                    $('#jenis_8').css('background', '#efff00')
                }
            }
        }

        if ($('#jawaban_a').length > 0) {
            if ($('#jawaban_a #opsi_a').length < 1) { //input data
                err = 1
                input++
                // alert('Urutan Pertama salah')
                $('#jawaban_a').css('background', '#efff00')
            } else {
                $('#jawaban_a').css('background', '#efff00')
            }
        }

        if ($('#jawaban_b').length > 0) {
            if ($('#jawaban_b #opsi_b').length < 1) { //input data
                err = 1
                input++;
                // alert('Urutan Kedua salah')
                $('#jawaban_b').css('background', '#efff00')
            } else {
                $('#jawaban_b').css('background', '#efff00')
            }
        }

        if ($('#jawaban_c').length > 0) {
            if ($('#jawaban_c #opsi_c').length < 1) { //process
                err = 1
                proc++;
                // alert('Urutan ketiga salah')
                $('#jawaban_c').css('background', '#efff00')
            } else {
                $('#jawaban_c').css('background', '#efff00')
            }
        }

        if ($('#jawaban_d').length > 0) {
            if ($('#jawaban_d #opsi_d').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_d').css('background', '#efff00')
            } else {
                $('#jawaban_d').css('background', '#efff00')
            }
        }

        if ($('#jawaban_e').length > 0) {
            if ($('#jawaban_e #opsi_e').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_e').css('background', '#efff00')
            } else {
                $('#jawaban_e').css('background', '#efff00')
            }
        }

        if ($('#jawaban_f').length > 0) {
            if ($('#jawaban_f #opsi_f').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_f').css('background', '#efff00')
            } else {
                $('#jawaban_f').css('background', '#efff00')
            }
        }

        if ($('#jawaban_g').length > 0) {
            if ($('#jawaban_g #opsi_g').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_g').css('background', '#efff00')
            } else {
                $('#jawaban_g').css('background', '#efff00')
            }
        }

        if ($('#jawaban_h').length > 0) {
            if ($('#jawaban_h #opsi_h').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_h').css('background', '#efff00')
            } else {
                $('#jawaban_h').css('background', '#efff00')
            }
        }

        if ($('#jawaban_i').length > 0) {
            if ($('#jawaban_i #opsi_i').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_i').css('background', '#efff00')
            } else {
                $('#jawaban_i').css('background', '#efff00')
            }
        }

        if ($('#jawaban_j').length > 0) {
            if ($('#jawaban_j #opsi_j').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_j').css('background', '#efff00')
            } else {
                $('#jawaban_j').css('background', '#efff00')
            }
        }

        if ($('#jawaban_k').length > 0) {
            if ($('#jawaban_k #opsi_k').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_k').css('background', '#efff00')
            } else {
                $('#jawaban_k').css('background', '#efff00')
            }
        }

        if ($('#jawaban_l').length > 0) {
            if ($('#jawaban_l #opsi_l').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_l').css('background', '#efff00')
            } else {
                $('#jawaban_l').css('background', '#efff00')
            }
        }

        if ($('#jawaban_m').length > 0) {
            if ($('#jawaban_m #opsi_m').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_m').css('background', '#efff00')
            } else {
                $('#jawaban_m').css('background', '#efff00')
            }
        }

        if ($('#jawaban_n').length > 0) {
            if ($('#jawaban_n #opsi_n').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_n').css('background', '#efff00')
            } else {
                $('#jawaban_n').css('background', '#efff00')
            }
        }

        if ($('#jawaban_o').length > 0) {
            if ($('#jawaban_o #opsi_o').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_o').css('background', '#efff00')
            } else {
                $('#jawaban_o').css('background', '#efff00')
            }
        }

        if ($('#jawaban_p').length > 0) {
            if ($('#jawaban_p #opsi_p').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_p').css('background', '#efff00')
            } else {
                $('#jawaban_p').css('background', '#efff00')
            }
        }

        if ($('#jawaban_q').length > 0) {
            if ($('#jawaban_q #opsi_q').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_q').css('background', '#efff00')
            } else {
                $('#jawaban_q').css('background', '#efff00')
            }
        }

        if ($('#jawaban_r').length > 0) {
            if ($('#jawaban_r #opsi_r').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_r').css('background', '#efff00')
            } else {
                $('#jawaban_r').css('background', '#efff00')
            }
        }

        if ($('#jawaban_s').length > 0) {
            if ($('#jawaban_s #opsi_s').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_s').css('background', '#efff00')
            } else {
                $('#jawaban_s').css('background', '#efff00')
            }
        }

        if ($('#jawaban_t').length > 0) {
            if ($('#jawaban_t #opsi_t').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_t').css('background', '#efff00')
            } else {
                $('#jawaban_t').css('background', '#efff00')
            }
        }

        if ($('#jawaban_u').length > 0) {
            if ($('#jawaban_u #opsi_u').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_u').css('background', '#efff00')
            } else {
                $('#jawaban_u').css('background', '#efff00')
            }
        }

        if ($('#jawaban_v').length > 0) {
            if ($('#jawaban_v #opsi_v').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_v').css('background', '#efff00')
            } else {
                $('#jawaban_v').css('background', '#efff00')
            }
        }

        if ($('#jawaban_w').length > 0) {
            if ($('#jawaban_w #opsi_w').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_w').css('background', '#efff00')
            } else {
                $('#jawaban_w').css('background', '#efff00')
            }
        }

        if ($('#jawaban_x').length > 0) {
            if ($('#jawaban_x #opsi_x').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_x').css('background', '#efff00')
            } else {
                $('#jawaban_x').css('background', '#efff00')
            }
        }

        if ($('#jawaban_y').length > 0) {
            if ($('#jawaban_y #opsi_y').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_y').css('background', '#efff00')
            } else {
                $('#jawaban_y').css('background', '#efff00')
            }
        }

        if ($('#jawaban_z').length > 0) {
            if ($('#jawaban_z #opsi_z').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_z').css('background', '#efff00')
            } else {
                $('#jawaban_z').css('background', '#efff00')
            }
        }

        if ($('#jawaban_v').length > 0) {
            if ($('#jawaban_v #opsi_v').length < 1) {
                err = 1
                output++; //output
                // alert('Urutan Keempat salah')
                $('#jawaban_v').css('background', '#efff00')
            } else {
                $('#jawaban_v').css('background', '#efff00')
            }
        }

        if (err == 1) {
            $('#fail-alert').css('display', 'flex');
            $('#fail-alert').css('opacity', '1');
        } else {
            $('#success-alert').css('display', 'flex');
            $('#success-alert').css('opacity', '1');
        }

        var idsoal = $('#id_soal').val();
        var iduser = $('#id_user').val();
        $.ajax({
            url: base_url + 'ujian/save_history/' + idsoal + '/' + iduser,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if (data.status) {
                    $(this).removeAttr('disabled');
                    reload_ajax();
                }
            }
        });

        // var idsoal = $('#id_soal').val();
        // var iduser = $('#id_user').val();
        // $.ajax({
        //     url: base_url+'ujian/save_detail_confidence/' + idsoal + '/' + iduser,
        //     type: 'get',
        //     dataType: 'json',
        //     success: function (data) {
        //         if (data.status) {
        //             $(this).removeAttr('disabled');
        //             reload_ajax();
        //         }
        //     }
        // });

        // var idsoal = $('#id_soal').val();
        // var iduser = $('#id_user').val();
        // var idlevel = $('#id_level').val();
        // $.ajax({
        //     url: base_url+'ujian/save_percobaan/' + '<?= $id_tes; ?>' + '/' + '<?php echo $levelId ?>',
        //     type: 'get',
        //     dataType: 'json',
        //     success: function (data) {
        //         if (data.status) {
        //             $(this).removeAttr('disabled');
        //             reload_ajax();
        //         }
        //     }
        // });
    }
</script>
<script src="<?= base_url() ?>assets/dist/js/app/ujian/sheet.js"></script>