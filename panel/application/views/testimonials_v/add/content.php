<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Ziyaretçi Notu Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("testimonials/save"); ?>" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Ad Soyad</label>
                                    <input type="text" class="form-control"  placeholder="Adınızı ve Soyadınızı Giriniz" name="full_name" value="<?php echo isset($form_error) ? set_value("full_name") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "full_name");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Şirket Adı</label>
                                    <input type="text" class="form-control"  placeholder="Şirket Adını Giriniz" name="company" value="<?php echo isset($form_error) ? set_value("company") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "company");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Başlık</label>
                                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : ""?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Mesaj</label>
                                    <textarea name="description" class="form-control"><?php echo isset($form_error) ? set_value("description") : ""?></textarea>
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "description");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group image_upload_container">
                                    <label>Görsel Seçiniz</label>
                                    <input type="file" name="img_url" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("testimonials"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>