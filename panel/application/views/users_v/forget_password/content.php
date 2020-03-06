<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>Infinity</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="reset-password-form">
        <h4 class="form-title m-b-xl text-center">Forgot Your Password ?</h4>

        <form action="<?php echo base_url('useroperation/reset_password'); ?>">
            <div class="form-group">
                <input id="reset-password-email" type="email" class="form-control" placeholder="email">
            </div>
            <input type="submit" class="btn btn-primary" value="RESET YOUR PASSWORD">
        </form>
    </div><!-- #reset-password-form -->
