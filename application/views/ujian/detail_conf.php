<style type="text/css">
<!-- Center Element Horizontal Vertical by igniel.com -->
.center {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
}
</style>
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
            <div class="col-sm-12 mb-4">
                <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                <!-- <button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-purple"><i class="fa fa-refresh"></i> Reload</button> -->
                <!-- <div class="pull-right">
                    <a target="_blank" href="<?=base_url()?>hasilujian/cetak_detail/<?=$this->uri->segment(3)?>" class="btn bg-maroon btn-flat btn-sm">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div> -->
                <br></br>
                <center>  <div class="row">
                <center><div class="center" style="margin-left: 200px;">
                <div class="col-lg-3 col-xs-6">
                    <div class="alert bg-yellow">
                        <h5>Jumlah Percobaan</i></h5>
                        <center><span class="d-block"> <span><h4><?= $total ?></h4></span></span></center>
                    </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                    <div class="alert bg-green">
                        <h5>Jawaban Benar</i></h5>
                        <center><span class="d-block"> <span><h4><?= $total_benar ?></h4></span></span></center>
                    </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                    <div class="alert bg-red">
                        <h5>Jawaban Salah</i></h5>
                        <center><span class="d-block"> <span><h4><?= $total_salah ?></h4></span></span></center>
                    </div>
                    </div>
                </div>
            </div>  </center>
            
            </div>

            <div class="table-responsive px-4 pb-3" style="border: 0">
            <table id="detail_conf" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Level</th>
                <th style="text-align: center">Sub Soal</th>
                <th style="text-align: center">Confidence Tag</th>
                <th style="text-align: center">Status Jawaban</th>
                <!-- <th>Waktu</th>
                <th>Tanggal</th> -->
            </tr> 
            </thead>
            <tbody>  
            <?php 
                $no = 1;
                foreach($detail as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>  
                    <td style="text-align: center">'.$u['levels'].'</td>
                    <td style="text-align: center">'.$u['sub_soal'].'</td>
                    <td style="text-align: center">'.$u['confidence'].'</td>
                    <td style="text-align: center">';
                    if ($u['id_confidence'] == $details_max){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-green">Benar</span>
                    </div>
                            ';
                        }else{
                            echo '
                            <div class="text-center">
                            <span class="badge bg-red">'.$details.'</span>
                        </div>';
                    }
                    echo'
                       </td>
                           </tr>';?>
                           <?php } ?>
                           </tbody>
        </table>
    </div>
</div>

<script>
   $(document).ready(function () {
    $('#detail_conf').DataTable( {
        dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [
            {
                extend: 'print',
                download: 'open',
                title: 'Detail Confidence Tag',
                filename: 'log_aktivitas_mhs_print'
            },
            {
                extend: 'copy',
                download: 'open',
                title: 'Detail Confidence Tag',
                filename: 'log_aktivitas_mhs_copy'
            },
            {
                extend: 'excel',
                download: 'open',
                title: 'Detail Confidence Tag',
                filename: 'log_aktivitas_mhs_excel'
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                title: 'Detail Confidence Tag',
                filename: 'log_aktivitas_mhs_pdf'
            }
        ]
    });
});
</script>