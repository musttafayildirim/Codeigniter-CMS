<!-- header-container start -->
<div class="header-container">
    <!-- header start -->
    <!-- classes:  -->
    <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
    <!-- "fixed-desktop": enables fixed navigation only for desktop devices e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "fixed-all": enables fixed navigation only for all devices desktop and mobile e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
    <!-- "centered": mandatory class for the centered logo layout -->
    <!-- ================ -->
    <header class="header dark fixed fixed-desktop clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-auto hidden-md-down pl-2">
                    <!-- header-first start -->
                    <!-- ================ -->
                    <div class="header-first clearfix">

                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="index.html"><img id="logo_img" src="<?php echo base_url("assets")?>/images/logo_purple.png" alt="The Project"></a>
                        </div>

                        <!-- name-and-slogan -->
                        <div class="site-slogan">
                            Multipurpose HTML5 Template
                        </div>

                    </div>
                    <!-- header-first end -->

                </div>
                <div class="col-lg-10 ml-lg-auto">

                    <!-- header-second start -->
                    <!-- ================ -->
                    <div class="header-second clearfix">

                        <!-- main-navigation start -->
                        <!-- classes: -->
                        <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                        <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                        <!-- ================ -->
                        <div class="main-navigation main-navigation--mega-menu  animated">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">
                                <div class="navbar-brand clearfix hidden-lg-up">

                                    <!-- logo -->
                                    <div id="logo-mobile" class="logo">
                                        <a href="index.html"><img id="logo-img-mobile" src="<?php echo base_url("assets")?>/images/logo_purple.png" alt="The Project"></a>
                                    </div>

                                    <!-- name-and-slogan -->
                                    <div class="site-slogan">
                                        Multipurpose HTML5 Template
                                    </div>

                                </div>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-1" aria-controls="navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <!-- main-menu -->
                                    <ul class="navbar-nav ml-xl-auto">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url("ana-sayfa") ?>" class="nav-link" id="third-dropdown">Anasayfa</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url("urun-listesi") ?>" class="nav-link" id="third-dropdown" aria-haspopup="true" aria-expanded="false">Ürünler</a>
                                        </li>
                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" id="third-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hakkımızda</a>
                                            <ul class="dropdown-menu" aria-labelledby="third-dropdown">
                                                <li ><a href="features-dark-page.html">Hakkımızda</a></li>
                                                <li ><a href="<?php echo base_url("portfolyo-listesi") ?>">Portfolyo</a></li>
                                                <li ><a href="features-backgrounds.html">Haberler</a></li>
                                                <li ><a href="<?php echo base_url("referanslarimiz");?>">Referanslar</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo base_url("egitim-listesi") ?>" class="nav-link" id="third-dropdown" aria-haspopup="true" aria-expanded="false">Eğitim</a>
                                        </li>
                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" id="third-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Galeri</a>
                                            <ul class="dropdown-menu" aria-labelledby="third-dropdown">
                                                <li ><a href="features-dark-page.html">Resim Galerisi</a></li>
                                                <li ><a href="features-typography.html">Video Galerisi</a></li>
                                                <li ><a href="features-backgrounds.html">Dosya Galerisi</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link" id="third-dropdown"  aria-haspopup="true" aria-expanded="false">Markalar</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link" id="third-dropdown" aria-haspopup="true" aria-expanded="false">İletişim</a>
                                        </li>



                                    </ul>
                                    <!-- main-menu end -->
                                </div>
                            </nav>
                        </div>
                        <!-- main-navigation end -->
                    </div>
                    <!-- header-second end -->

                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
</div>
