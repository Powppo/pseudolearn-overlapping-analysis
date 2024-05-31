<?php if ($this->ion_auth->is_admin()) : ?>
    <div class="row">
        <?php foreach ($info_box as $info) : ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-<?= $info->box ?>">
                    <div class="inner">
                        <p><?= $info->title; ?></p>
                    </div>
                    <a href="<?= base_url() . strtolower($info->title); ?>" class="small-box-footer">
                        Lihat <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <style type="text/css">
            .col-centered {
                display: inline-block;
                float: none;
                text-align: center;
                margin-right: -4px;
            }

            hr {
                width: 100%;
                height: 1px;
                background-color: black;
                margin-right: auto;
                margin-left: auto;
                margin-bottom: 1px;
                border-width: 2px;
                border-color: black;
            }
        </style>
    </div>


<?php endif; ?>