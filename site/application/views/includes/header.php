<?php $settings = get_settings();?>
<!-- header-container start -->
<div class="header-container">

    <!-- header start -->
    <!-- classes:  -->
    <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
    <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
    <!-- "full-width": mandatory class for the full-width menu layout -->
    <!-- "centered": mandatory class for the centered logo layout -->
    <!-- ================ -->
    <header class="header  fixed   dark clearfix">

        <div class="container">
            <div class="row">
                <div class="col-md-2 ">
                    <!-- header-first start -->
                    <!-- ================ -->
                    <div class="header-first clearfix">

                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="index.html"><img id="logo_img" src="<?php echo base_url("assets/images");?>/logo_purple.png" alt="The Project"></a>
                        </div>

                        <!-- name-and-slogan -->
                        <div class="site-slogan">
                           <?php echo $settings->slogan;?>
                        </div>

                    </div>
                    <!-- header-first end -->

                </div>
                <div class="col-md-10">

                    <!-- header-second start -->
                    <!-- ================ -->
                    <div class="header-second clearfix">

                        <!-- main-navigation start -->
                        <!-- classes: -->
                        <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                        <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                        <!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
                        <!-- ================ -->
                        <div class="main-navigation  animated with-dropdown-buttons">

                            <!-- navbar start -->
                            <!-- ================ -->
                            <nav class="navbar navbar-default" role="navigation">
                                <div class="container-fluid">

                                    <!-- Toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>

                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                        <!-- main-menu -->
                                        <ul class="nav navbar-nav ">


                                            <li class="active"><a href="index.html">Anasayfa</a></li>
                                            <li class="dropdown ">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url("hakkimizda");?>">Hakkımızda</a>
                                                <ul class="dropdown-menu">
                                                    <li ><a href="<?php echo base_url("hakkimizda");?>">Hakkımızda</a></li>
                                                    <li ><a href="<?php echo base_url("portfolyo-listesi"); ?>">Portfolyo</a></li>
                                                    <li ><a href="<?php echo base_url("haberler-listeleniyor");?>">Haberler</a></li>
                                                    <li ><a href="<?php echo base_url("referanslarimiz"); ?>">Referanslar</a></li>
                                                    <li ><a href="<?php echo base_url("hizmetlerimiz"); ?>">Hizmetlerimiz</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown ">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Galeriler</a>
                                                <ul class="dropdown-menu">
                                                    <li ><a href="features-dark-page.html">Resim Galerileri</a></li>
                                                    <li ><a href="features-typography.html">Video Galerileri</a></li>
                                                    <li ><a href="features-backgrounds.html">Dosya Galerileri</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo base_url("urun-listesi"); ?>">Ürünler</a></li>
                                            <li><a href="<?php echo base_url("egitim-listesi"); ?>">Eğitimler</a></li>
                                            <li><a href="<?php echo base_url("beraber-calistigimiz-markalar"); ?>">Markalar</a></li>
                                            <li><a href="<?php echo base_url("iletisim-sayfasi");?>">İletişim</a></li>

                                        </ul>
                                        <!-- main-menu end -->

                                    </div>

                                </div>
                            </nav>
                            <!-- navbar end -->

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
<!-- header-container end -->
