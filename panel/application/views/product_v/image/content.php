<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <strong><?php echo $item->title; ?></strong> kaydına ait resimler
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">

                <form data-url="<?php echo base_url("product/refresh_image_list/$item->id"); ?>" action="<?php echo base_url("product/image_upload/$item->id") ?>" id="dropzone" class="dropzone dz-clickable" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("product/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Dosyaları sürükleyin veya yüklemek için tıklayın.</h3>
                        <p class="m-b-lg text-muted">(Sadece img, jpg veya jpeg seçiniz. )</p>
                    </div>
                </form>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>


<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Resim alanı
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body image_list_container">
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v") ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>