<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">DataTables</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">DataTables</li>
                </ol>
            </div>
            <div class="page-content fade-in-up" style="width: 100%;">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Data Table</div>
                    </div>
    <div class="box-body">
		<div class="row" style="margin-top: 20px;">
        	<div class="col-sm-4">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red" style="margin-left: 20px; color: #fff;"><i class="fa fa-trash" style="color: #fff"></i> Delete</button>
			</div>
			<div class="form-group col-sm-4 text-center">
				<?php if ( $this->ion_auth->is_admin() ) : ?>
					<select id="matkul_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Matkul</option>
						<?php foreach ($matkul as $m) :?>
							<option value="<?=$m->id_matkul?>"><?=$m->nama_matkul?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
				<!-- <?php if ( $this->ion_auth->in_group('dosen') ) : ?>				
					<input id="matkul_id" value="<?=$matkul->nama_matkul;?>" type="text" readonly="readonly" class="form-control">
				<?php endif; ?> -->
			</div>
			<div class="col-sm-4">
				<div class="pull-right" style="margin-right: 20px;">
					<a href="<?=base_url('level/add')?>" class="btn bg-purple btn-flat btn-sm" style="color: #fff;"><i class="fa fa-plus" style="color: #fff;"></i> Buat Kategori</a>
					<button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-maroon"><i class="fa fa-refresh"></i> Reload</button>
				</div>
			</div>
		</div>
    </div>
	<?=form_open('level/delete', array('id'=>'bulk'))?>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="level" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<th>Nama</th>
                <th>Gambar</th>
				<th>Batas Nilai</th>
				<th class="text-center">Aksi</th>
            </tr>        
        </thead>
        </table>
    </div>
	<?=form_close();?>
</div>

<script src="<?=base_url()?>assets/dist/js/app/level/data.js"></script>

<?php if ( $this->ion_auth->is_admin() ) : ?>
<script type="text/javascript">
$(document).ready(function(){
	$('#matkul_filter').on('change', function(){
		let id_matkul = $(this).val();
		let src = '<?=base_url()?>level/data';
		let url;

		if(id_matkul !== 'all'){
			let src2 = src + '/' + id_matkul;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script>
<?php endif; ?>
<?php if ( $this->ion_auth->in_group('dosen') ) : ?>
<script type="text/javascript">
$(document).ready(function(){
	let id_matkul = '<?=$matkul->matkul_id?>';
	let id_dosen = '<?=$matkul->id_dosen?>';
	let src = '<?=base_url()?>level/data';
	let url = src + '/' + id_matkul + '/' + id_dosen;

	table.ajax.url(url).load();
});
</script>
<?php endif; ?>