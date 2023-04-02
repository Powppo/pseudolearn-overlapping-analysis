<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-header with-header">
        <h3 class="box-title"></h3>
        <div class="pull-right">
            <a href="<?= base_url() ?>feedback" class="btn btn-xs btn-flat btn-default">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a href="<?= base_url() ?>feedback/edit/<?= $this->uri->segment(3) ?>" class="btn btn-xs btn-flat btn-warning">
                <i class="fa fa-edit"></i> Edit
            </a>
        </div>
        <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?= form_open('soal/delete', array('id' => 'bulk')) ?>
                <div class="table-responsive px-4 pb-3" style="border: 0">
                    <input type="hidden" name="id_feedback" id="id_feedback" class="form-control" value="<?= $this->uri->segment(3) ?>">
                    <table id="soal" class="w-100 table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" class="select_all">
                                </th>
                                <th width="25">No.</th>
                                <th>feedback tipe data</th>
                                <th>feedback algoritma</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- <div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">Detail Kategori Soal</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?= form_open('soal/delete', array('id' => 'bulk')) ?>
                <div class="table-responsive px-4 pb-3" style="border: 0">
                    <input type="hidden" name="id_feedback" id="id_feedback" class="form-control" value="<?= $this->uri->segment(3) ?>">
                    <table id="soal" class="w-100 table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" class="select_all">
                                </th>
                                <th width="25">No.</th>
                                <th>Soal</th>
                                <th>feedback</th>
                                <th>Tgl Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div> -->
</div>

<script src="<?= base_url() ?>assets/dist/js/app/feedback/datasoal.js"></script>