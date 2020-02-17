<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni haber ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("news/save"); ?>" method="post">
                                <div class="form-group">
                                    <label >Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Başlık" name="title">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label >Açıklama</label>
                                    <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="control-demo-6">Haberin Türü</label>
                                    <div id="control-demo-6">
                                        <select class="form-control news_type_select" name="news_type">
                                            <option value="image">Resim</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group image_upload_container">
                                    <label>File input</label>
                                    <input type="file" name="img_url" class="form-control">
                                </div>

                                <div class="form-group video_url_container">
                                    <label >Video</label>
                                    <input type="text" class="form-control"  placeholder="Video bağlantınızı buraya ekleyebilirsiniz." name="video_url">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "video_url");?></small>
                                    <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("news"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>