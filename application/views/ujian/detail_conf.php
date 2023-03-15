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
    <br>
    <center><div class="center" style="margin-left: 400px;">
        <div class="col-sm-5">
        <div class="alert bg-green">
            <h4>Jumlah Percobaan<i class="pull-right fa fa-check"></i></h4>
            <center><span class="d-block"> <span><h4><?= $total ?></h4></span></span></center>
        </div>
    </div>
</div> </center>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-purple"><i class="fa fa-refresh"></i> Reload</button>
                <div class="pull-right">
                    <a target="_blank" href="<?=base_url()?>hasilujian/cetak_detail/<?=$this->uri->segment(3)?>" class="btn bg-maroon btn-flat btn-sm">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
            <div class="table-responsive px-4 pb-3" style="border: 0">
            <table id="detail_hasil" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th style="text-align: center">No.</th>
                <!-- <th style="text-align: center">Nama Mahasiswa</th>
                <th style="text-align: center">NIM</th> -->
                <th style="text-align: center">Sub Soal</th>
                <th style="text-align: center">Soal</th>
                <th style="text-align: center">Confidence Tag</th>
                <!-- <th style="text-align: center">Confidence Tag</th> -->
                <!-- <th>Waktu</th>
                <th>Tanggal</th> -->
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>   
            <?php 
                $no = 1;
                foreach($detail as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>  
                    <td style="text-align: center">'.$u['sub_soal'].'</td>
                    <td style="text-align: justify">'.$u['studi_kasus'].'</td>
                    <td style="text-align: center">'.$u['confidence'].'</td>
                           </tr>';?>
                           <?php } ?>
            </thead>
        <tfoot>
            <tr>
            <th style="text-align: center">No.</th>
                <th style="text-align: center">Sub Soal</th>
                <th style="text-align: center">Soal</th>
                <th style="text-align: center">Confidence Tag</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>   
        </tfoot>
        </table>
    </div>
</div>