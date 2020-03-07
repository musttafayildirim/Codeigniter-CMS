<div class="simple-page-logo animated swing">
    <a href="<?php echo base_url("dashboard") ?>">
        <span><i class="fa fa-gg"></i></span>
        <span>CMS</span>
    </a>
</div><!-- logo -->
<div class="simple-page-form animated flipInY" id="login-form">
    <h4 class="form-title m-b-xl text-center">Bilgilerinizle Giriş Yapınız</h4>
    <form action="<?php echo base_url('useroperation/do_login'); ?>" method="post">
        <div class="form-group">
            <input id="sign-in-email" type="text" class="form-control" name="user_name" placeholder="Kullanıcı Adınızı Giriniz">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "user_name");?></small>
            <?php } ?>
        </div>

        <div class="form-group">
            <input id="sign-in-password" type="password" class="form-control" name="password" placeholder="Şifrenizi Giriniz">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "password");?></small>
            <?php } ?>
        </div>

        <input type="submit" class="btn btn-primary" value="Giriş Yap">
    </form>
</div><!-- #login-form -->

<div class="simple-page-footer">
    <p><a href="<?php echo base_url('useroperation/forget_password'); ?>">Şifreni mi unuttun?</a></p>
</div><!-- .simple-page-footer -->