<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni Slayt Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("slides/save"); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label >Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label >Açıklama</label>
                                    <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;">
                                        <?php echo isset($form_error) ? set_value("description") : ""?>
                                    </textarea>
                                </div>


                                <div class="form-group image_upload_container">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="img_url" class="form-control">
                                </div>


                                <div class="form-group buttonAllowed_btn">
                                    <label>Buton eklensin mi?</label><br>
                                    <input
                                            type="checkbox"
                                            data-switchery="true"
                                            data-color="#10c469"
                                            name="allowButton"
                                            <?php if(isset($form_error)){ ?>
                                                <?php echo "checked";?>
                                            <?php } ?>
                                    >
                                </div>

                                <div class="button-information-container" style="display: <?php echo (isset($form_error)) ? "block" : "none" ?>">
                                <div class="form-group">
                                    <label>Buton Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Butonun üzerindeki yazı" name="button_caption" value="<?php echo isset($form_error) ? set_value("button_caption") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "button_caption");?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>URL Bilgisi</label>
                                    <input type="url" class="form-control"  placeholder="Butona tıklandığı zaman gidilmesini istediğiniz yer" name="button_url" value="<?php echo isset($form_error) ? set_value("button_url") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "button_url");?></small>
                                    <?php } ?>
                                </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("slides"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>