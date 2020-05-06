<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Merhaba <?php echo $item->full_name ?> Bilgilerini Güncelliyorsun
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                <form action="<?php echo base_url("kullanici-guncellemes"); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Kullanıcı Adı</label>
                            <input type="text" class="form-control" value="<?php echo isset($form_error) ? set_value("user_name") : $item->user_name; ?>"  placeholder="Kullanıcı Adı" name="user_name">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "user_name");?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label >Ad Soyad</label>
                            <input type="text" class="form-control" value="<?php echo isset($form_error) ? set_value("full_name") : $item->full_name; ?>"  placeholder="Ad Soyad" name="full_name">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "full_name");?></small>
                            <?php } ?>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >E-Posta Adresi</label>
                            <input type="email" class="form-control" value="<?php echo isset($form_error) ? set_value("email") : $item->email; ?>"  placeholder="E-Posta Adresi" name="email">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "email");?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-5 image_upload_container">
                        <label>Profil Resmi</label>
                        <input
                                type="file"
                                name="img_url"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-1 img-responsive img-fluid">
                            <img src="<?php echo get_image($viewFolder, $item->img_url, "70x70"); ?>"
                                 alt="<?php echo $item->img_url?>">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>