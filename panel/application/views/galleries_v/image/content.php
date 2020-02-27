<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <?php
                    $type = $item->gallery_type;
                    if($type == "image"){
                        $type_text = "resimler";
                        $limitation_text = "(Sadece img, jpg veya jpeg seçiniz.)";
                    }

                    else if($type == "file"){
                        $type_text = "dosyalar";
                        $limitation_text = "(Sadece pdf, doc veya docx seçiniz.)";
                    }

                    else{
                        $type_text = "videolar";
                        $limitation_text = "";
                    }

                    ?>

                    <strong><?php echo $item->title; ?></strong> kaydına ait <?php echo $type_text; ?>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">

                <form data-url="<?php echo base_url("galleries/refresh_file_list/$item->id/$item->gallery_type"); ?>"
                      action="<?php echo base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name") ?>"
                      id="dropzone" class="dropzone dz-clickable" data-plugin="dropzone"
                      data-options="{ url: '<?php echo base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg"><?php echo ucfirst($type_text); ?> sürükleyin veya yüklemek için tıklayın.</h3>
                        <p class="m-b-lg text-muted"><?php echo $limitation_text; ?></p>
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
                    <?php echo ucfirst($type_text); ?> görüntüleniyor..
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body image_list_container">
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/file_list_v") ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>