<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->title;?> kayıtlı markayı güncelliyorsunuz....
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("brand/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label >Başlık</label>
                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                    <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                    <?php } ?>
                </div>

                <div class="row image_upload_container">
                    <div class="form-group col-md-11 image_upload_container"
                        <label>File input</label>
                        <input
                                type="file"
                                name="img_url"
                                class="form-control">
                    </div>

                    <div class="form-group col-md-1 img-responsive img-fluid">
                        <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>"
                             alt="">
                    </div>

                </div>

                <hr class="widget-separator">

                <br>
                <div class="row container-fluid">
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url("brand"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </div>


            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>