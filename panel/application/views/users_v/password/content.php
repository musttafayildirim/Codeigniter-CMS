<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->user_name;?> kayıtlı kullanıcının şifresi değiştiriliyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("users/update_password/$item->id"); ?>" method="post">

                <div class="form-group">
                    <label >Şifre</label>
                    <input type="password" class="form-control"  placeholder="Şifrenizi buraya girebilirsiniz." name="password">
                    <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error( "password");?></small>
                    <?php } ?>
                </div>

                <div class="form-group">
                        <label >Şifre Doğrulama</label>
                        <input type="password" class="form-control"  placeholder="Şifrenizi tekrar giriniz..." name="re-password">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "re-password");?></small>
                        <?php } ?>
                </div>

                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Şifreyi Güncelle</button>
                <a href="<?php echo base_url("users"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>