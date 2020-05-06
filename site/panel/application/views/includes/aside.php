<?php $user = get_active_user(); ?>
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)">
                        <img
                            class="img-responsive"
                            src="<?php echo get_image("userdes_v", $user->img_url, "70x70");?>"
                            alt="<?php echo $user->user_name?>"
                        />
                    </a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="<?php echo base_url("kullanici-guncelleme"); ?>" class="username"><?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="<?php echo base_url("kullanici-guncelleme"); ?>" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url()?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("kullanici-guncelleme"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("kullanici-sifre"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-key"></i></span>
                                        <span>Şifre</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("logout");?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">


                <?php if (isAllowedViewModule('dashboard')){ ?>
                    <li>
                        <a href="<?php echo base_url("dashboard")  ?>">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Dashboards</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('settings') || isAllowedViewModule('email')){ ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Ayarlar</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu" style="display: none;">
                            <?php if (isAllowedViewModule('settings')){ ?>
                                <li><a href="<?php echo base_url("settings")?>"><span class="menu-text">Site Ayarları</span></a></li>
                            <?php } ?>
                            <?php if (isAllowedViewModule('email')){ ?>
                                <li><a href="<?php echo base_url("email") ?>"><span class="menu-text">Email Ayarları</span></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('galleries')){ ?>
                        <li>
                            <a href="<?php echo base_url('galleries'); ?>">
                                <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
                                <span class="menu-text">Galeriler</span>
                            </a>
                        </li>
                <?php } ?>
                <?php if (isAllowedViewModule('slides')){ ?>
                    <li>
                        <a href="<?php echo base_url('slides'); ?>">
                            <i class="menu-icon fa fa-sliders"></i>
                            <span class="menu-text">Slider</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('users') || isAllowedViewModule('user_roles')){ ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-user-times"></i>
                            <span class="menu-text">Kullanıcı İşlemleri</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu" style="display: none;">
                            <?php if (isAllowedViewModule('users')) { ?>
                                <li>
                                    <a href="<?php echo base_url('users'); ?>">
                                        <i class="menu-icon fa fa-user-secret"></i>
                                        <span class="menu-text">Kullanıcılar</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (isAllowedViewModule('user_roles')) { ?>
                                <li>
                                    <a href="<?php echo base_url('user_roles'); ?>">
                                        <i class="menu-icon fa fa-low-vision"></i>
                                        <span class="menu-text">Kullanıcı Rolleri</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('members')){ ?>
                    <li>
                        <a href="<?php echo base_url('members'); ?>">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">Aboneler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('testimonials')){ ?>
                    <li>
                        <a href="<?php echo base_url('testimonials');?>">
                            <i class="menu-icon fa fa-commenting"></i>
                            <span class="menu-text">Ziyaretçi Notları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('product')){ ?>
                    <li>
                        <a href="<?php echo base_url("product"); ?>">
                            <i class="menu-icon fa fa-product-hunt"></i>
                            <span class="menu-text">Ürünler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('services')){ ?>
                    <li>
                        <a href="<?php echo base_url("services"); ?>">
                            <i class="menu-icon fa fa-h-square"></i>
                            <span class="menu-text">Hizmetler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('portfolio') || isAllowedViewModule('portfolio_categories')){ ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-briefcase"></i>
                            <span class="menu-text">Portfolyo İşlemleri</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu" style="display: none;">
                            <?php if (isAllowedViewModule('portfolio_categories')){ ?>
                                <li>
                                    <a href="<?php echo base_url("portfolio_categories")?>"><span class="menu-text">Portfolyo Kategorileri</span></a>
                                </li>
                            <?php } ?>
                            <?php if (isAllowedViewModule('portfolio')){ ?>
                                <li>
                                        <a href="<?php echo base_url("portfolio")?>"><span class="menu-text">Portfolyo</span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('news')){ ?>
                    <li>
                        <a href="<?php echo base_url("news"); ?>">
                            <i class="menu-icon fa fa-newspaper-o"></i>
                            <span class="menu-text">Haberler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('courses')){ ?>
                    <li>
                        <a href="<?php echo base_url("courses"); ?>">
                            <i class="menu-icon fa fa-train"></i>
                            <span class="menu-text">Eğitimler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('brand')){ ?>
                    <li>
                        <a href="<?php echo base_url("brand") ?>">
                            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                            <span class="menu-text">Markalar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('reference')){ ?>
                    <li>
                        <a href="<?php echo base_url("reference"); ?>">
                            <i class="menu-icon fa fa-share"></i>
                            <span class="menu-text">Referanslar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule('popup')){ ?>
                    <li>
                        <a href="<?php echo base_url("popup");?>">
                            <i class="menu-icon fa fa-pied-piper"></i>
                            <span class="menu-text">Popup Hizmeti</span>
                        </a>
                    </li>
                <?php } ?>

                <li class="menu-separator"><hr></li>

                <li>
                    <a href="../" target="_blank">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text">Ana Sayfa</span>
                    </a>
                </li>
                
                <li>
                    <a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=cms" target="_blank">

                        <i class="menu-icon fa fa-database"></i>
                        <span class="menu-text">Database</span> </a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
