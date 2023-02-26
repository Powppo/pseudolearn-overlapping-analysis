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
                    var status = 'incompleted'
                    var flag = 'incompleted'
                    var link = '<b class="card__title card__title">'+value.nama+'</b>'
                    if (value.bts_nilai <= value.nilai || (!value.nilai && key == 0)) {
                        status = 'completed'
                        flag = 'completed'
                        link = '<a href="<?= base_url() ?>ujian/list_ujian/' + value.id_level + '" class="card__title card__title"> ' + value.nama + '</a>'
                    }
                    listsoal += '<div class="categories__card card">';
                    listsoal += link;
                    listsoal += '<p class="card__status card__status--'+flag+'">';
                    listsoal += status;
                    listsoal += '</p>';
                    listsoal += '<p class="card__status" style="margin-bottom:34px; background-color:#c7c7c7">';
                    listsoal += 'Batas Nilai : ' + value.bts_nilai;
                    listsoal += '</p>';
                    listsoal += '<img src="<?= base_url() ?>uploads/level_soal/' + value.image + '" alt="lock" class="card__image" style="filter:blur(9px);"/>';
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