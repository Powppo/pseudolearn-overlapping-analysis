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
		<?php echo $this->session->flashdata('message');?>
			<div class="col-lg-4 col-xs-3">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red"><i class="fa fa-trash"></i> Delete</button>
			</div>
			<div class="form-group col-lg-4 col-xs-5 text-center">
				<?php if ($this->ion_auth->is_admin()) : ?>
					<select id="level_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Level</option>
						<?php foreach ($level as $m) : ?>
							<option value="<?= $m->id_level ?>"><?= $m->nama ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>
			<div class="col-lg-4 col-xs-4">
				<div class="pull-right">
					<a href="<?= base_url('soal/add') ?>" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-plus"></i> Buat Soal</a>
					<button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-maroon"><i class="fa fa-refresh"></i> Reload</button>
				</div>
			</div>
		</div>
	</div>
	<?= form_open('soal/delete', array('id' => 'bulk')) ?>
	<div class="table-responsive px-4 pb-3" style="border: 0">
		<table id="soal" class="w-100 table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">
						<input type="checkbox" class="select_all">
					</th>
					<th width="25">No.</th>
					<th>Soal</th>
					<th>Level</th>
					<th>Tgl Dibuat</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th class="text-center">
						<input type="checkbox" class="select_all">
					</th>
					<th width="25">No.</th>
					<th>Soal</th>
					<th>Level</th>
					<th>Tgl Dibuat</th>
					<th class="text-center">Aksi</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?= form_close(); ?>
</div>

<script src="<?= base_url() ?>assets/dist/js/app/soal/data.js"></script>

<?php if ($this->ion_auth->is_admin()) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#level_filter').on('change', function() {
				let id = $(this).val();
				let src = '<?= base_url() ?>soal/data';
				let url;

				if (id !== 'all') {
					let src2 = src + '/' + id;
					url = $(this).prop('checked') === true ? src : src2;
				} else {
					url = src;
				}
				table.ajax.url(url).load();
			});
		});
	</script>
<?php endif; ?>