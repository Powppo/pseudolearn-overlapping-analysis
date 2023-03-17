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
            <!-- <div class="col-sm-4">
                <button type="button" class="btn bg-purple btn-flat btn-sm reload"><i class="fa fa-refresh"></i> Reload</button>
            </div> -->
        </div>
    </div>
  
    <div class="table-responsive px-4 pb-3" style="border: 0">
		<table id="example" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Nama Mahasiswa</th>
                <th style="text-align: center">NIM</th>
                <th style="text-align: center">Total Poin</th>
                <th style="text-align: center">Hasil Ujian</th>
                <th style="text-align: center">Aksi</th>              
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach($informasi as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>     
                    <td style="text-align: center">'.$u['nama'].'</td>
                    <td style="text-align: center">'.$u['nim'].'</td>
                    <td style="text-align: center">'.$u['total_poin'].'</td>
                    <td style="text-align: center">';
                    if ($u['total_poin'] >= "20"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-green">Sempurna!</span>
                    </div>
                            ';
                           }else if ($u['total_poin'] <= "0"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-red">Tingkatkan!</span>
                    </div>';
                           }else{
                        echo '
                        <div class="text-center">
                        <span class="badge bg-yellow">Cukup!</span>
                    </div>';
                           }
                        echo'
                        <td>
                        <div class="text-center">
                        <a class="btn btn-xs btn-warning" style="color: #fff;" href="'.base_url().'hasilujian/detailLog/'.$u['iduser'].'">
                        <i class="fa fa-eye" style="color: #fff;"></i> Detail
                        </a> 
                        </div>
                        </td>
                           </tr>';
                           ?>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- 
<script src="<?=base_url()?>assets/dist/js/app/ujian/hasil.js"></script> -->

<script>
   $(document).ready(function () {
    table = $('#example').DataTable( {
        dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'print',
                download: 'open',
                title: 'Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_print'
            },
            {
                extend: 'copy',
                download: 'open',
                title: 'Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_copy'
            },
            {
                extend: 'excel',
                download: 'open',
                title: 'Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_excel'
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                title: 'Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_pdf'
            }
        ]
    });
 });
</script>
    