<div role="tabpanel" class="tab-pane fade" id="tab-5">
    <div class="row">
        <div class="form-group col-md-12">
            <h4 class="m-b-md">E-Posta</h4>
            <input type="email" class="form-control"  placeholder="E-Posta adresinizi giriniz." name="email" value="<?php echo isset($form_error) ? set_value("email") : "";?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "email");?></small>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Facebook</h4>
            <input type="text" class="form-control"  placeholder="Facebook hesabınızı giriniz." name="facebook" value="<?php echo isset($form_error) ? set_value("facebook") : "";?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "facebook");?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Twitter</h4>
            <input type="text" class="form-control"  placeholder="Twitter hesabınızı giriniz." name="twitter" value="<?php echo isset($form_error) ? set_value("twitter") : "";?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "twitter");?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Instagram</h4>
            <input type="text" class="form-control"  placeholder="Instagram hesabınızı giriniz." name="instagram" value="<?php echo isset($form_error) ? set_value("instagram") : "";?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "instagram");?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <h4 class="m-b-md">LinkedIn</h4>
            <input type="text" class="form-control"  placeholder="LinkedIn hesabınızı giriniz." name="linkedin" value="<?php echo isset($form_error) ? set_value("linkedin") : "";?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "linkedin");?></small>
            <?php } ?>
        </div>
    </div>
</div><!-- .tab-pane  -->
