<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni Eğitim Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("courses/save"); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label >Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : "";?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="datetimepicker1">Eğitim Tarihi</label>
                                        <input type="hidden"
                                               name="event_date"
                                               id="datetimepicker1"
                                               data-plugin="datetimepicker"
                                               data-options="{ inline: true, viewMode: 'days', format: 'YYYY-MM-DD HH:mm:ss'}"
                                               value="<?php echo isset($form_error) ? set_value("event_date") : "";?>"
                                        />
                                    </div><!-- END column -->
                                    <div class="form-group col-md-8">
                                        <label >Açıklama</label>
                                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                            <?php echo isset($form_error) ? set_value("description") : "" ?>
                                        </textarea>
                                    </div>


                                <div class="form-group image_upload_container">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="img_url" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("courses"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>