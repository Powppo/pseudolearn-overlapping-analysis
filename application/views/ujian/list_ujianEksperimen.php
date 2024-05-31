<div class="row">
    <div class="col-sm-3">
        <div class="alert bg-yellow">
            <h4>Tanggal<i class="pull-right fa fa-calendar"></i></h4>
            <span class="d-block"> <?= strftime('%A, %d %B %Y') ?></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert bg-red">
            <h4>Jam<i class="pull-right fa fa-clock-o"></i></h4>
            <span class="d-block"> <span class="live-clock"><?= date('H:i:s') ?></span></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert bg-green">
            <h4>Total Point<i class="pull-right fa fa-check"></i></h4>
            <span class="d-block"> <span><?= $total ?></span></span>
        </div>
    </div>
    <div class="col-sm-12">
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
                    <div class="col-sm-4">
                    <!-- <a href="<?= base_url() ?>ujian/list" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-arrow-left"></i> Back</a> -->
                        <a href="<?= base_url() ?>ujian/list_level" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-arrow-left"></i> Back</a>
                        <!-- <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-refresh"></i> Reload</button> -->
                    </div>
                </div>
                <div class="row" id="ujian">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="<?= base_url() ?>assets/dist/js/app/ujian/list.js"></script> -->
<script>
    $(document).ready(function() {
        //window.localStorage.clear();
        ajaxcsrf();
        // console.log(window.location.href);
        console.log(window.location.href.substring(window.location.href.lastIndexOf('/') + 1));
        $.ajax({
            url: '<?= base_url() ?>ujianEksperimen/list_json/'+window.location.href.substring(window.location.href.lastIndexOf('/') + 1),
            type: 'POST',
            success: function(data) {
                console.log(data);
                var json = $.parseJSON(data);
                $('#ujian').html('');
                var listujian = '';
                $.each(json, function(key, value) {
                    if (key % 3 == 0) { // Memulai baris baru setiap tiga item
                        listujian += '<div class="row">';
                    }

                    var lockedImage = '<?= base_url() ?>assets/dist/img/puzzle.png';
                    var successImage = '<?= base_url() ?>assets/dist/img/success.png';
                    var imageUrl = value.id ? lockedImage : successImage;

                    // Mengambil nama file gambar secara acak dari array imageNames
                    var randomImageName = imageNames[Math.floor(Math.random() * imageNames.length)];
                    // Membuat URL lengkap gambar dengan base_url dan nama file yang dipilih secara acak
                    var randomImageUrl = '<?= base_url() ?>assets/frontend/images/' + randomImageName;

                    var truncatedTitle = value.judul.length > 35 ? value.judul.substring(0, 35) + '...' : value.judul;

                    listujian += '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">'; // Menyesuaikan lebar kartu dengan ukuran layar
                    listujian += '<div class="card shadow" style="width: 100%; height: auto;">'; // Sesuaikan lebar kartu dengan kolom
                    listujian += '<img src="' + randomImageUrl + '" class="img-thumbnail mt-4" alt="Top Image">';// Menambahkan gambar di atas gambar status
                    listujian += '<img src="' + imageUrl + '" class="card-img-top mt-3 " alt="Status Image" style="width: 25px; height: 25px;">';
                    listujian += '<div class="card-body">';
                    listujian += '<h5 class="card-title text-bold"><a href="<?= base_url() ?>ujian/?key=' + value.id_soal + '">' + truncatedTitle + '</a></h5>';
                    listujian += '<p class="card-text">' + value.nama + '</p>';
                    listujian += '</div>';
                    listujian += '</div>';
                    listujian += '</div>';

                    if ((key + 1) % 3 == 0 || key == json.length - 1) { // Menutup baris setiap tiga item atau ketika loop mencapai item terakhir
                        listujian += '</div>'; // Menutup baris
                    }
                });
                $('#ujian').append(listujian);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    function refreshPage() {
        location.reload(true);
    }
</script>