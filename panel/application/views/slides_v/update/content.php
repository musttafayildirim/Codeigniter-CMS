<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo ucfirst($item->title);?> Kayıtlı Hizmet Güncelleniyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("slides/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label >Başlık</label>
                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : $item->title?>">
                    <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label >Açıklama</label>
                    <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;">
                        <?php echo isset($form_error) ? set_value("description") : $item->description;?>
                    </textarea>
                </div>

                        <div class="row">
                            <div class="row image_upload_container">
                                <div class="form-group col-md-11 image_upload_container"
                                <label>File input</label>
                                <input
                                        type="file"
                                        name="img_url"
                                        class="form-control">
                            </div>

                            <div class="form-group col-md-1 img-responsive img-fluid">
                                <img src="<?php echo get_image($viewFolder, $item->img_url, "70x70"); ?>"
                                     alt="<?php echo $item->title?>">
                            </div>
                        </div>

                        <div class="form-group buttonAllowed_btn">
                            <label>Buton eklensin mi?</label><br>
                            <input
                                    type="checkbox"
                                    data-switchery="true"
                                    data-color="#10c469"
                                    name="allowButton"
                                    <?php echo ($item->allowButton) ? "checked" : "";?>
                            >
                        </div>

                        <div class="button-information-container" style="display:  <?php echo ($item->allowButton) ? "block" : "none";?>">
                            <div class="form-group">
                                <label>Buton Başlık</label>
                                <input type="text" class="form-control"  placeholder="Butonun üzerindeki yazı" name="button_caption" value="<?php echo isset($form_error) ? set_value("button_caption") : $item->button_caption?>">
                                <?php if(isset($form_error)){ ?>
                                    <small class="pull-right input-form-error"><?php echo form_error( "button_caption");?></small>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label>URL Bilgisi</label>
                                <input type="url" class="form-control"  placeholder="Butona tıklandığı zaman gidilmesini istediğiniz yer" name="button_url" value="<?php echo isset($form_error) ? set_value("button_url") : $item->button_url?>">
                                <?php if(isset($form_error)){ ?>
                                    <small class="pull-right input-form-error"><?php echo form_error( "button_url");?></small>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                <hr class="widget-separator">

                <br>
                <div class="row container-fluid">
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url("slides"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </div>


            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>