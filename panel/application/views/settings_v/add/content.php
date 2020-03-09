<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("settings/save"); ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="m-b-lg nav-tabs-horizontal">
                                    <!-- tabs list -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab" aria-expanded="true">Site Bilgileri</a></li>
                                        <li role="presentation" class=""><a href="#tab-7" aria-controls="tab-1" role="tab" data-toggle="tab" aria-expanded="false">Adres Bilgisi</a></li>
                                        <li role="presentation" class=""><a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab" aria-expanded="false">Hakkımızda</a></li>
                                        <li role="presentation" class=""><a href="#tab-3" aria-controls="tab-2" role="tab" data-toggle="tab" aria-expanded="false">Vizyonumuz</a></li>
                                        <li role="presentation" class=""><a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab" aria-expanded="false">Misyonumuz</a></li>
                                        <li role="presentation" class=""><a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab" aria-expanded="false">Sosyal Medya</a></li>
                                        <li role="presentation" class=""><a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab" aria-expanded="false">Logo</a></li>
                                    </ul><!-- .nav-tabs -->
                                    <!-- Tab panes -->
                                    <div class="tab-content p-md">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab-1">
                                            <h4 class="m-b-md">Şirket Adı</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control"  placeholder="Şirket Adı" name="company_name" value="<?php echo isset($form_error) ? set_value("company_name") : "";?>">
                                                <?php if(isset($form_error)){ ?>
                                                    <small class="pull-right input-form-error"><?php echo form_error( "company_name");?></small>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Telefon 1</h4>
                                                    <input type="tel" class="form-control"  placeholder="(000)-000-000-00" name="phone_1" value="<?php echo isset($form_error) ? set_value("phone_1") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "phone_1");?></small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Telefon 2</h4>
                                                    <input type="tel" class="form-control"  placeholder="Diğer telefon numaranızı giriniz." name="phone_2" value="<?php echo isset($form_error) ? set_value("phone_2") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "phone_2");?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Faks 1</h4>
                                                    <input type="tel" class="form-control"  placeholder="Faks numaranızı giriniz." name="fax_1" value="<?php echo isset($form_error) ? set_value("fax_1") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "fax_1");?></small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Faks 2</h4>
                                                    <input type="tel" class="form-control"  placeholder="Diğer faks numaranızı giriniz." name="fax_2" value="<?php echo isset($form_error) ? set_value("fax_2") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "fax_2");?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-7">
                                            <h4 class="m-b-md">Adres Bilgisi</h4>
                                            <div class="form-group">
                                                <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;"></textarea>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-2">
                                            <h4 class="m-b-md">Hakkımızda</h4>
                                            <div class="form-group">
                                                <textarea name="about" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;"></textarea>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-3">
                                            <h4 class="m-b-md">Vizyonumuz</h4>
                                            <div class="form-group">
                                                <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;"></textarea>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-4">
                                            <h4 class="m-b-md">Misyonumuz</h4>
                                            <div class="form-group">
                                                <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;"></textarea>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-5">
                                            <h4 class="m-b-md">E-Posta</h4>
                                            <div class="form-group">
                                                <input type="email" class="form-control"  placeholder="E-Posta adresinizi giriniz." name="email" value="<?php echo isset($form_error) ? set_value("email") : "";?>">
                                                <?php if(isset($form_error)){ ?>
                                                    <small class="pull-right input-form-error"><?php echo form_error( "email");?></small>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Facebook</h4>
                                                    <input type="url" class="form-control"  placeholder="Telefon numaranızı giriniz." name="facebook" value="<?php echo isset($form_error) ? set_value("facebook") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "facebook");?></small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Twitter</h4>
                                                    <input type="url" class="form-control"  placeholder="Twitter hesabınızı giriniz." name="twitter" value="<?php echo isset($form_error) ? set_value("twitter") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "twitter");?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">Instagram</h4>
                                                    <input type="url" class="form-control"  placeholder="Instagram hesabınızı giriniz." name="instagram" value="<?php echo isset($form_error) ? set_value("instagram") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "instagram");?></small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h4 class="m-b-md">LinkedIn</h4>
                                                    <input type="url" class="form-control"  placeholder="LinkedIn hesabınızı giriniz." name="linkedin" value="<?php echo isset($form_error) ? set_value("linkedin") : "";?>">
                                                    <?php if(isset($form_error)){ ?>
                                                        <small class="pull-right input-form-error"><?php echo form_error( "linkedin");?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab-6">
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <h4 class="m-b-md">Logo</h4>
                                                    <input type="file" name="img_url" class="form-control">
                                                </div>
                                            </div>
                                        </div><!-- .tab-pane  -->
                                    </div><!-- .tab-content  -->
                                </div><!-- .nav-tabs-horizontal -->
                            </div><!-- .widget -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                    <a href="<?php echo base_url("settings"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>