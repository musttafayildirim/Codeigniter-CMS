<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni Kullanıcı Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("users/save"); ?>" method="post">
                                <div class="form-group">
                                    <label >Kullanıcı Adı</label>
                                    <input type="text" class="form-control"  placeholder="Kullanıcı Adı" name="user_name" value="<?php echo isset($form_error) ? set_value("user_name") : "";?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "user_name");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label >Ad Soyad</label>
                                    <input type="text" class="form-control"  placeholder="Ad Soyad" name="full_name" value="<?php echo isset($form_error) ? set_value("full_name") : "";?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "full_name");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label >E-Posta Adresi</label>
                                    <input type="email" class="form-control"  placeholder="E-Posta Adresi" name="email" value="<?php echo isset($form_error) ? set_value("email") : "";?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "email");?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="control-demo-6">Kullanıcı Rolü Seçiniz</label>
                                    <div id="control-demo-6">
                                        <select class="form-control" name="user_role_id">
                                            <?php foreach ($user_roles as $user_role){ ?>
                                                <?php $user_role_id = isset($form_error) ? set_value("user_role_id") : ""?>
                                                <option
                                                    <?php echo $user_role->id === $user_role_id ? "selected" : ""?>
                                                        value="<?php echo $user_role->id;?>"><?php echo $user_role->title;?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"><?php echo form_error( "user_role_id");?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label >Şifre</label>
                                    <input type="password" class="form-control"  placeholder="Şifre" name="password">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "password");?></small>
                                    <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("users"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>