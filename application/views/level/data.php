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
		<?php echo $this->session->flashdata('message');?>
        	<div class="col-lg-6 col-xs-6">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red"><i class="fa fa-trash"></i> Delete</button>
			</div>
			<div class="col-lg-6 col-xs-6">
				<div class="pull-right">
					<a href="<?=base_url('level/add')?>" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-plus"></i> Buat Kategori</a>
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
				<th>Feedback</th>
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