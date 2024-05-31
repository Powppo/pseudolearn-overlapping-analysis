
<style>
    .shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); 
}
</style>

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
                        <a href="<?= base_url() ?>ujian/list_level" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-arrow-left"></i> Back</a>
                        <!-- <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-refresh"></i> Reload</button> -->
                    </div>
                </div>
                <div class="column" style="margin-left: 10%; margin-right: 10%;" id="ujian">
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
    url: '<?= base_url() ?>ujian/list_json/' + window.location.href.substring(window.location.href.lastIndexOf('/') + 1),
    type: 'POST',
    success: function(data) {
        console.log(data);
        var json = $.parseJSON(data);
        $('#ujian').html('');
        var listujian = '';
        $.each(json, function(key, value) {
            // Define image URLs
            var lockedImage = '<?= base_url() ?>assets/dist/img/acc1.png';
            var successImage = '<?= base_url() ?>assets/dist/img/ques1.png';
            var imageUrl = value.id ? lockedImage : successImage;

            var imageLIst = '<?= base_url() ?>assets/dist/img/list.png'

            var truncatedTitle = value.judul.length > 35 ? value.judul.substring(0, 25) + '...' : value.judul;

            listujian += '<div class="col-lg-12 pt-3 d-flex align-items-center" style="align-items: center;">';
            listujian += '<div class="alert flex-grow-1" style="display: flex; justify-content: space-evenly; align-items: center; text-align: center; border-radius: 13px; background: #C0D6E8; padding-right: 80px; width: 100%; border: 1px solid #053B50;">';
            listujian += '<img class="d-none d-lg-block" src="' + imageLIst + '" class="card-img-top mt-3 " alt="Status Image" style="width: 100px; height: auto; margin-left: 10px;">';
            listujian += '<a href="<?= base_url() ?>ujian/?key=' + value.id_soal + '" style="font-family: poppins, sans-serif; text-decoration: none; color: black; font-size: 24px; font-weight: 500;">' + truncatedTitle + '</a>';
            // listujian += '<span class="d-block">' + value.nama + '</span>';
            listujian += '</div>';
            // listujian += '<img class="d-none d-lg-block" src="' + iconImage + '" style="height: 50px; width: 50px; margin-left: 10px;">';
            listujian += '<img class="d-none d-lg-block" src="' + imageUrl + '" class="card-img-top " alt="Status Image" style="width: 50px; height: 50px; margin-left: 20px;">';
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