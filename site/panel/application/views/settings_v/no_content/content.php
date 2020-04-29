<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Site Ayarları
                    <a href="<?php echo base_url("settings/new_setting"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("settings/new_setting"); ?>">tıklayınız.</a></p>
                </div>
                    <?php   } ?>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>