<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->user_name;?> kayıtlı E-Posta güncelleniyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("email/update/$item->id"); ?>" method="post">
                <div class="form-group">

                    <div class="form-group">
                        <label >Kullanıcı Adı</label>
                        <input type="text" class="form-control"  placeholder="Kullanıcı Adı" name="user_name" value="<?php echo isset($form_error) ? set_value("user_name") : $item->user_name;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "user_name");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Protokol</label>
                        <input type="text" class="form-control"  placeholder="protokol" name="protocol" value="<?php echo isset($form_error) ? set_value("protocol") : $item->protocol;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "protocol");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Host</label>
                        <input type="text" class="form-control"  placeholder="Sunucu Adresi" name="host" value="<?php echo isset($form_error) ? set_value("host") : $item->host;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "host");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Port</label>
                        <input type="text" class="form-control"  placeholder="Port Numarası" name="port" value="<?php echo isset($form_error) ? set_value("port") : $item->port;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "port");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label >E-Posta Adresi (user)</label>
                        <input type="email" class="form-control"  placeholder="E-Posta Adresi (user)" name="user" value="<?php echo isset($form_error) ? set_value("user") : $item->user;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "user");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label >E-Posta Adresi (from)</label>
                        <input type="email" class="form-control"  placeholder="E-Posta Adresi (from)" name="from" value="<?php echo isset($form_error) ? set_value("from") : $item->from;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "from");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label >E-Posta Adresi (to)</label>
                        <input type="email" class="form-control"  placeholder="E-Posta Adresi (to)" name="to" value="<?php echo isset($form_error) ? set_value("to") : $item->to;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "to");?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label >Şifre</label>
                        <input type="password" class="form-control"  placeholder="Şifre" name="password" value="<?php echo isset($form_error) ? set_value("to") : $item->password;?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "password");?></small>
                        <?php } ?>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                <a href="<?php echo base_url("email"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>