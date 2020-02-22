<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni Galeri Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("galleries/save"); ?>" method="post">
                                <div class="form-group">
                                    <label >Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Başlık" name="title">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="control-demo-6">Galeri Türü</label>
                                    <div id="control-demo-6">
                                        <select class="form-control" name="gallery_type">
                                            <option <?php echo (isset($gallery_type) && $gallery_type === "image") ? "selected" : "" ?> value="image">Resim</option>
                                            <option <?php echo (isset($gallery_type) && $gallery_type === "video") ? "selected" : "" ?> value="video">Video</option>
                                            <option <?php echo (isset($gallery_type) && $gallery_type === "file") ? "selected" : "" ?> value="file">Dosya</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("galleries"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>