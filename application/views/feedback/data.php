<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-3">
            <a href="<?= base_url('feedback/add') ?>" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah</a>
            <!-- <a href="<?= base_url('feedback/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a> -->
            <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
            <div class="pull-right">
                <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <?= form_open('feedback/delete', array('id' => 'bulk')); ?>
        <div class="table-responsive px-4 pb-3" style="border: 0">
		<table id="confidencehistory" class="w-100 table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">No.</th>
                        <th style="text-align: center">Feedback Tipe Data</th>
                        <th style="text-align: center">Feedback Algoritma</th>
                        <th style="text-align: center" width="100" class="text-center">Aksi</th>
                    </tr>
                    </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach($informasi as $u){ 
                    echo '
                <tr>
                    <td style="text-align: center">'.$no++.'</td>     
                    <td style="text-align: center">'.$u['feedback_tipedata'].'</td>
                    <td style="text-align: center">'.$u['feedback_algoritma'].'</td>
                    <td>
                        <div class="text-center">
                            <a class="btn btn-xs btn-warning" style="color: #fff;" href="'.base_url().'">
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