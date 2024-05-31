<div class="row">
    <div class="col-sm-3">
        <div class="alert" style="background: #0E46A3; color: white;">
            <h4>Tanggal<i class="pull-right fa fa-calendar"></i></h4>
            <span class="d-block"> <?= strftime('%A, %d %B %Y') ?></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert" style="background: #1679AB; color: white;">
            <h4>Jam<i class="pull-right fa fa-clock-o"></i></h4>
            <span class="d-block"> <span class="live-clock"><?= date('H:i:s') ?></span></span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="alert" style="background: #5BBCFF; color: white;">
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
                        <!-- <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-refresh"></i> Reload</button> -->
                    </div>
                </div>
                <main class="categories" id="level">
                </main>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        ajaxcsrf();
        $.ajax({
            url: '<?= base_url() ?>level/list_json',
            type: 'POST',
            success: function(data) {
                var json = $.parseJSON(data);
                $('#level').html('');
                var listsoal = '';
                console.log(json);
                $.each(json, function(key, value) {
                    if (value.status == 'unlocked') {
                        status = 'completed'
                        flag = 'completed'
                        link = '<a href="<?= base_url() ?>ujian/list_ujian/' + value.id_level + '" class="card__title card__title"> ' + value.nama + '</a>'
                    } else {
                        var status = 'incompleted'
                        var flag = 'incompleted'
                        var link = '<b class="card__title card__title">'+value.nama+'</b>'
                    }
                    // listsoal += '<div class="categories__card card">';
                    // listsoal += link;
                    // listsoal += '<p class="card__status card__status--'+flag+'">';
                    // listsoal += status;
                    // listsoal += '</p>';
                    // listsoal += '<p class="card__status" style="margin-bottom:34px; background-color:#c7c7c7">';
                    // listsoal += 'Batas Nilai : ' + value.bts_nilai;
                    // listsoal += '</p>';
                    // listsoal += '<img src="<?= base_url() ?>uploads/level_soal/' + value.image + '" alt="lock" class="card__image" style="filter:blur(9px);"/>';
                    // listsoal += '</div>';
                    listsoal += '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">'; // Menyesuaikan lebar kartu dengan ukuran layar
                    listsoal += '<div class="card shadow" style="width: 100%; height: auto; ' + (status !== 'incompleted' ? 'background: #CDE8E5;' : '') + '">'; // Sesuaikan lebar kartu dengan kolom
                    listsoal += '<img src="<?= base_url() ?>uploads/level_soal/' + value.image + '" class="img-thumbnail mt-4" alt="Top Image" style="' + (status === 'incompleted' ? 'filter: grayscale(100%);' : '') + '">';
                    // listsoal += '<img src="' + imageUrl + '" class="card-img-top mt-3 " alt="Status Image" style="width: 20px; height: 20px;">';
                    listsoal += '<div class="card-body">';
                    listsoal += status == 'completed' ? '<img src="<?= base_url() ?>assets/dist/img/success.png" class="card-img-top mt-5 " alt="Status Image" style="width: 25px; height: 25px;">' : '<img src="<?= base_url() ?>assets/dist/img/locked.png" class="card-img-top mt-5 " alt="Status Image" style="width: 25px; height: 25px;">';
                    listsoal += '<br>';
                    listsoal += link;
                    listsoal += '<p class="card-text"> batas nilai : ' + value.bts_nilai + '</p>'; 
                    listsoal += '</div>';
                    listsoal += '</div>';
                    listsoal += '</div>';
                });
                $('#level').append(listsoal);
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