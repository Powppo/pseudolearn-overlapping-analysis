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
			<div class="col-sm-4">
            <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
			</div>
            <!-- <div class="col-sm-4">
                <button type="button" class="btn bg-purple btn-flat btn-sm reload"><i class="fa fa-refresh"></i> Reload</button>
            </div> -->
            <div class="form-group col-sm-4 text-center" style="text-align: center; margin-left: 20px;">
            <?php if ($this->ion_auth->is_admin()) : ?>
							<select class="form-control status-dropdown select2" style="width:100% !important">
								<option value="">Semua Level</option>
                                <?php foreach ($level as $lvl) : ?>
								<option value="<?= $lvl->id_level ?>"><?= $lvl->nama ?></option>
								<?php endforeach; ?>
							</select>
				<?php endif; ?>
			</div>
        </div>
    </div>
  
    <div class="table-responsive px-4 pb-3" style="border: 0">
		<table id="example" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">ID Level</th>
                <th style="text-align: center">Level</th>
                <th style="text-align: center">Poin</th>
                <th style="text-align: center">Aksi</th>              
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach($hasil as $hsl){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td> 
                    <td style="text-align: center">'.$hsl['idlevel'].'</td>    
                    <td style="text-align: center">'.$hsl['levels'].'</td>
                    <td style="text-align: center">'.$hsl['poin'].'</td>
                    <td>
                        <div class="text-center">
                        <a class="btn btn-xs btn-warning" style="color: #fff;" href="'.base_url().'hasilujian/detailLog/'.$hsl['iduser'].'/'.$hsl['idlevel'].'">
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
    dataTable = $('#example').DataTable( {
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
        ],
        "columnDefs": [
            {
                "targets": [1],
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
      var id_level = $(this).val();
      $('.status-dropdown').val(id_level)
      console.log(id_level)
      //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
      dataTable.column(1).search(id_level).draw();
    })
});
</script>