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
        <div class="col-lg-4 col-xs-4 mb-4">
            <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="form-group col-lg-4 col-xs-6 text-center">
            <?php if ($this->ion_auth->is_admin()) : ?>
							<select class="form-control status-dropdown select2" style="width:100% !important">
								<option value="">Semua Sub Soal</option>
                                <?php foreach ($soal as $s) : ?>
								<option value="<?= $s->id_soal ?>"><?= $s->judul ?></option>
								<?php endforeach; ?>
							</select>
				<?php endif; ?>
			</div>
        </div>
    </div>
            <!-- <div class="col-sm-4">
                <button type="button" class="btn bg-purple btn-flat btn-sm reload"><i class="fa fa-refresh"></i> Reload</button>
            </div> -->
            <br></br>
        <div class="box-body">
            <div class="row">
                <div class="form-group col-lg-12 col-xs-6 mb-4">
                    <h5 style="margin-left:20px;"> Nama : <?=$nama_mahasiswa?></h5>
                    <h5 style="margin-left:20px;"> NIM : <?=$nim_mahasiswa?></h5>
                    <h5 style="margin-left:20px;"> Kelas : <?=$kelas_mahasiswa?></h5>
                </div>
                <div class="box-body">
                    <div class="row"> 
                        <div class="form-group col-lg-2 col-xs-4 text-center" style="margin: 0 auto; padding-left: 40px; width: 300px;">
                                <div class="alert bg-blue">
                                    <h5>Total Waktu</i></h5>
                                    <center><span class="d-block"> <span><h4><?= $total_waktu ?></h4></span></span></center>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="table-responsive px-4 pb-3" style="border: 0">
            <table id="details_hasil" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Level</th>
                <th style="text-align: center">ID Soal</th>
                <th style="text-align: center">Sub Soal</th>
                <th style="text-align: center">Poin</th>
                <!-- <th style="text-align: center">Jumlah Percobaan</th> -->
                <th style="text-align: center">Confidence Tag</th>
                <th style="text-align: center">Hasil Ujian</th>
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
                    <td style="text-align: center">'.$u['idsoal'].'</td>
                    <td style="text-align: center">'.$u['sub_soal'].'</td>
                    <td style="text-align: center">'.$u['poin'].'</td>
                    <td>
                        <div class="text-center">
                        <a class="btn btn-xs btn-warning" style="color: #fff;" href="'.base_url().'hasilujian/detailConfidence/'.$u['iduser'].'/'.$u['idsoal'].'">
                        <i class="fa fa-eye" style="color: #fff;"></i> Detail
                        </a> 
                        </div>
                    </td>
                    <td style="text-align: center">';
                    if ($u['poin'] == "20"){
                        echo '
                        <div class="text-center">
                        <span class="badge bg-green">Sempurna!</span>
                    </div>
                            ';
                           }else if ($u['poin'] <= "0"){
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
                           </td>
                        </tr>';
                        ?>
                    <?php } ?>
                </tbody>
        </table>
    </div>
</div>

<script>
   $(document).ready(function () {
   dataTable = $('#details_hasil').DataTable( {
        dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [
            {
                extend: 'print',
                download: 'open',
                title: 'Detail Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_print'
            },
            {
                extend: 'copy',
                download: 'open',
                title: 'Detail Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_copy'
            },
            {
                extend: 'excel',
                download: 'open',
                title: 'Detail Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_excel'
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                title: 'Detail Log Aktivitas Mahasiswa',
                filename: 'log_aktivitas_mhs_pdf'
            }
        ],
        "columnDefs": [
            {
                "targets": [2],
                "visible": false
            }
        ]
    });
 
  /*dataTable.columns().every( function () {
        var that = this;
 
        $('input', this.footer()).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search(this.value).draw();
            }
        });
      });*/
  
  
    //   $('.filter-checkbox').on('change', function(e){
    //   var searchTerms = []
    //   $.each($('.filter-checkbox'), function(i,elem){
    //     if($(elem).prop('checked')){
    //       searchTerms.push("^" + $(this).val() + "$")
    //     }
    //   })
    //   dataTable.column(5).search(searchTerms.join('|'), true, false, true).draw();
    // });
  
    $('.status-dropdown').on('change', function(e){
      var id_soal = $(this).val();
      $('.status-dropdown').val(id_soal)
      console.log(id_soal)
      //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
      dataTable.column(2).search(id_soal).draw();
    })
});
</script>