<?php $settings = get_settings(); ?>
<!-- ================ -->
<div class="banner dark-translucent-bg" style="background-image:url('<?php echo base_url("panel/uploads/settings_v/contact-us-1.jpg")?>'); background-position: 50% 20%;">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12 text-center pv-20">
                <h1 class="page-title text-center">Bizimle iletişime geçin</h1>
                <div class="separator"></div>
                <p class="lead text-center"> Lütfen bize sorularınızı, yorumlarınızı ve önerilerinizi göndermekten çekinmeyin.<br> Her e-postayı okuyoruz ve sizin fikirlerinizi önemsiyoruz.</p>
                <ul class="list-inline mb-20 text-center">
                    <li class="list-inline-item"><i class="text-default fa fa-map-marker pr-2"></i> <?php echo $settings->address?></li>
                    <li class="list-inline-item"><a href="tel:+00 1234567890" class="link-dark"><i class="text-default fa fa-phone pl-10 pr-2"></i> <?php echo $settings->phone_1 ?></a></li>
                    <li class="list-inline-item"><a href="mailto:<?php echo $settings->email ?>" class="link-dark"><i class="text-default fa fa-envelope-o pl-10 pr-2"></i> <?php echo $settings->email ?></a></li>
                </ul>
                <div class="separator"></div>
                <ul class="social-links circle animated-effect-1 margin-clear text-center space-bottom">
                    <?php if($settings->facebook){?>
                        <li class="facebook"><a target="_blank" href="<?php echo $settings->facebook;?>"><i class="fa fa-facebook"></i></a></li>
                    <?php }?>
                    <?php if($settings->twitter){?>
                        <li class="twitter"><a target="_blank" href="<?php echo $settings->twitter;?>"><i class="fa fa-twitter"></i></a></li>
                    <?php }?>
                    <?php if($settings->instagram){?>
                        <li class="instagram"><a target="_blank" href="<?php echo $settings->instagram;?>"><i class="fa fa-instagram"></i></a></li>
                    <?php }?>
                    <?php if($settings->linkedIn){?>
                        <li class="linkedin"><a target="_blank" href="<?php echo $settings->linkedIn;?>"><i class="fa fa-linkedin"></i></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->
<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12 space-bottom">
                <h2 class="title">Bize Yazın</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <p>Bizimle iletişime geçmek için lütfen aşağıdaki alanları kullanınız.</p>
                        <div class="alert alert-success hidden-xs-up hidden" id="MessageSent">
                            We have received your message, we will contact you very soon.
                        </div>
                        <div class="contact-form">
                            <form id="" class="margin-clear" role="form" method="post" action="<?php echo base_url("mesaj-gonder"); ?>">
                                <div class="form-group has-feedback">
                                    <label for="name">Ad*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo isset($form_error) ? set_value("name") : "" ?>">
                                    <i class="fa fa-user form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email">E-posta*</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                                    <i class="fa fa-envelope form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="subject">Konu*</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="">
                                    <i class="fa fa-navicon form-control-feedback"></i>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="message">Mesajınız*</label>
                                    <textarea class="form-control" rows="6" id="message" name="message" placeholder=""></textarea>
                                    <i class="fa fa-pencil form-control-feedback"></i>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <?php echo $captcha["image"]; ?>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Doğrulama kodu..">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <button type="submit" class="submit-button btn btn-default">Gönder</button>
                            </form>
                        </div>
                    </div>
                    <!-- sidebar start -->
                    <!-- ================ -->
                    <aside class="col-lg-4 col-xl-3 ml-xl-auto">
                        <div class="sidebar">
                            <div class="block clearfix">
                                <h3 class="title">Buradayız</h3>
                                <div class="separator-2"></div>
                                <ul class="list">
                                    <li><i class="fa fa-home pr-10"></i><?php echo $settings->address?></li>
                                    <li><i class="fa fa-phone pr-10"></i><abbr title="Telefon">T:</abbr> <?php echo $settings->phone_1?></li>
                                    <?php if($settings->fax_1){?>
                                        <li><i class="fa fa-fax pr-10 pl-1"></i><abbr title="Fax">F:</abbr> <?php echo $settings->fax_1;?></li>
                                    <?php } ?>
                                    <li><i class="fa fa-envelope pr-10"></i><a href="mailto:<?php echo $settings->email;?>"><?php echo $settings->email;?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar">
                            <div class="block clearfix">
                                <h2 class="title">Takip edin</h2>
                                <div class="separator-2"></div>
                                <ul class="social-links circle small margin-clear clearfix animated-effect-1">
                                    <?php if ($settings->facebook){?>
                                        <li class="facebook"><a target="_blank" href="<?php echo $settings->facebook?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if ($settings->twitter){?>
                                        <li class="twitter"><a target="_blank" href="<?php echo $settings->twitter?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php } ?>
                                    <?php if ($settings->instagram){?>
                                        <li class="instagram"><a target="_blank" href="<?php echo $settings->instagram?>"><i class="fa fa-instagram"></i></a></li>
                                    <?php } ?>
                                    <?php if ($settings->linkedIn){?>
                                        <li class="linkedin"><a target="_blank" href="<?php echo $settings->linkedIn?>"><i class="fa fa-linkedin"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </aside>
                    <!-- sidebar end -->
                </div>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->

<!-- section start -->
<!-- ================ -->

<section class="section pv-40 parallax  dark-translucent-bg" style="background-image:url('<?php echo base_url("panel/uploads/settings_v/space.jpg")?>'); background-position:50% 60%;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="call-to-action text-center">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-12">
                            <h2 class="title">Bültene Abone ol</h2>
                            <p>Yazılarımızdan, haberlerimizden ve en güncel eğitimlerimizden haberdar olmak için lütfen bültene kayıt olun.</p>
                            <div class="separator"></div>
                            <form class="form-inline margin-clear d-flex justify-content-center" action="<?php echo base_url("abone-ol") ?>" method="post">
                                <div class="form-group has-feedback">
                                    <label class="sr-only" for="subscribe2">E-Posta Adresi</label>
                                    <input type="email" class="form-control form-control-lg" id="subscribe2" placeholder="E-posta adresinizi bu alana yazınız" name="subscribe_email" required="">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <i class="fa fa-envelope form-control-feedback"></i>
                                </div>
                                <button type="submit" class="btn btn-lg btn-gray-transparent btn-animated margin-clear ml-3">Gönder <i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->