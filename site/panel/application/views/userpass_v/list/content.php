<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Merhaba <?php echo $item->full_name ?> Şifreni Güncelliyorsun
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                <form action="<?php echo base_url("kullanici-sifres"); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-9">
                            <label >Mevcut Şifre</label>
                            <input type="password" class="form-control" value="<?php echo isset($form_error) ? set_value("current_password") : ""; ?>"  placeholder="Mevcut Parola" name="current_password">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "current_password");?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-9">
                            <label >Güncel Şifre</label>
                            <input type="password" class="form-control" value="<?php echo isset($form_error) ? set_value("update_password") : ""; ?>"  placeholder="Güncel Parola" name="update_password">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "update_password");?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-9">
                            <label >Güncel Şifre Tekrarı</label>
                            <input type="password" class="form-control" value="<?php echo isset($form_error) ? set_value("update_password_rep") : ""; ?>"  placeholder="Güncel Parola Tekrarı" name="update_password_rep">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"><?php echo form_error( "update_password_rep");?></small>
                            <?php } ?>
                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>