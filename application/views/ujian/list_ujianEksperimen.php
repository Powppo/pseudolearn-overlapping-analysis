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
                    listujian += '<div class="col-sm-6 pt-3">';
                    if (value.id) {
                        listujian += '<img src="<?= base_url() ?>assets/dist/img/lock_img.png" style="position: absolute; margin: 20px; height:50px; width:50px;">';
                    } else {
                        listujian += '<img src="<?= base_url() ?>assets/dist/img/unlock_img.png" style="position: absolute; margin: 20px; height:50px; width:50px;">';
                    }
                    listujian += '<div class="alert bg-success" style="text-align: center; border-radius: 13px; background: radial-gradient(circle at top left, #9bb8ed, #a4eaff)">';
                    if (value.id) {
                        listujian += '<h4><span style="text-decoration: none; color: black">' + value.judul + '</span></i></h4>';
                    } else {
                        listujian += '<h4><a href="<?= base_url() ?>ujianEksperimen/?key=' + value.id_soal + '" style="text-decoration: none; color: black">' + value.judul + '</a></i></h4>';
                    }
                    listujian += '<span class="d-block"> ' + value.nama + '</span>';
                    listujian += '</div>';
                    listujian += '</div>';
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