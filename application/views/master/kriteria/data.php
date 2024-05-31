<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Master <?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-3">
            <a href="<?= base_url('kriteria/add') ?>" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah</a>

        </div>
      
        <div class="table-responsive mt-2 mb-3">
            <table id="kriteria" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>KRITERIA</th>
                    </tr>
                   </thead>
                   <tbody>
                        <?php foreach($data as $key => $value): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo ucwords(strtolower(str_replace('_', ' ', $value['kriteria']))); ?></td>
                            </tr>
                        <?php endforeach; ?>
                   </tbody>
            </table>
        </div>
      
    </div>
</div>

</div>
