<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title"><?= $judul ?>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item"><?= $subjudul ?></li>
                </ol>
            </div>
            <div class="page-content fade-in-up" style="width: 100%;">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Master <?= $subjudul ?></div>
                    </div>
                    <div class="box-body">
        <div class="mt-2 mb-3" style="margin-left: 20px;">
            <a href="<?= base_url('mahasiswa/add') ?>" class="btn btn-sm btn-flat bg-purple" style="color: #fff;"><i class="fa fa-plus" style="color:white;"></i> Tambah</a>
            <!-- <a href="<?= base_url('mahasiswa/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a> -->
            <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
            <div class="pull-right">
                <button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button" style="margin-right: 20px;"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>
        <?= form_open('mahasiswa/delete', array('id' => 'bulk')); ?>
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="mahasiswa" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="100" class="text-center">Aksi</th>
                        <th width="100" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="100" class="text-center">Aksi</th>
                        <th width="100" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?= form_close() ?>
                    </div>
                </div>
               
            </div>
            <!-- END PAGE CONTENT-->
            <script src="<?= base_url() ?>assets/dist/js/app/master/mahasiswa/data.js"></script>