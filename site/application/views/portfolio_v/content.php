<div class="pv-40 banner light-gray-bg">
    <div class="container clearfix">

        <!-- slideshow start -->
        <!-- ================ -->
        <div class="slideshow">

            <!-- slider revolution start -->
            <!-- ================ -->
            <div class="slider-revolution-5-container">
                <div id="slider-banner-boxedwidth" class="slider-banner-boxedwidth rev_slider" data-version="5.0">
                    <ul class="slides">
                        <?php if($portfolio_images) {
                            foreach ($portfolio_images as $portfolio_image) { ?>
                                <!-- slide 1 start -->
                                <!-- ================ -->
                                <li class="text-center" data-transition="slidehorizontal" data-slotamount="default" data-masterspeed="default" data-title="<?php echo $portfolio->title ?>">

                                    <!-- main image -->
                                    <img src="<?php echo base_url("panel/uploads/product_v/$portfolio_image->img_url") ?>" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover" class="rev-slidebg">

                                    <!-- Transparent Background -->
                                    <div class="tp-caption dark-translucent-bg"
                                         data-x="center"
                                         data-y="center"
                                         data-start="0"
                                         data-transform_idle="o:1;"
                                         data-transform_in="o:0;s:600;e:Power2.easeInOut;"
                                         data-transform_out="o:0;s:600;"
                                         data-width="5000"
                                         data-height="450">
                                    </div>

                                </li>
                                <!-- slide 1 end -->
                            <?php }
                        }else{ ?>
                            <!-- slide 1 start -->
                            <!-- ================ -->
                            <li class="text-center" data-transition="slidehorizontal" data-slotamount="default" data-masterspeed="default" data-title="Fotoğraf Yüklenmeli">

                                <!-- main image -->
                                <img src="<?php base_url("assets")?>/images/portfolio-item-banner-1.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover" class="rev-slidebg">

                                <!-- Transparent Background -->
                                <div class="tp-caption dark-translucent-bg"
                                     data-x="center"
                                     data-y="center"
                                     data-start="0"
                                     data-transform_idle="o:1;"
                                     data-transform_in="o:0;s:600;e:Power2.easeInOut;"
                                     data-transform_out="o:0;s:600;"
                                     data-width="5000"
                                     data-height="450">
                                </div>

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption large_white"
                                     data-x="center"
                                     data-y="110"
                                     data-start="1000"
                                     data-width="650"
                                     data-transform_idle="o:1;"
                                     data-transform_in="y:[100%];sX:1;sY:1;s:1150;e:Power4.easeInOut;"
                                     data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;"
                                     data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;">Fotoğraf Yüklenmesi Lazım
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption large_white tp-resizeme hidden-xs"
                                     data-x="center"
                                     data-y="155"
                                     data-start="1300"
                                     data-width="500"
                                     data-transform_idle="o:1;"
                                     data-transform_in="o:0;s:2000;e:Power4.easeInOut;">
                                    <div class="separator light"></div>
                                </div>
                            </li>
                            <!-- slide 1 end -->

                        <?php }?>
                        
                    </ul>
                    <div class="tp-bannertimer"></div>
                </div>
            </div>
            <!-- slider revolution end -->

        </div>
        <!-- slideshow end -->

    </div>
</div>

<section class="main-container padding-ver-clear">
    <div class="container pv-40">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-lg-8">
                <h1 class="title"><?php echo $portfolio->title;?></h1>
                <div class="separator-2"></div>
                <p><?php echo $portfolio->description;?></p>
            </div>
            <!-- main end -->
            <!-- sidebar start -->
            <!-- ================ -->
            <aside class="col-lg-4 col-xl-3 ml-xl-auto">
                <div class="sidebar">
                    <div class="block clearfix">
                        <h3 class="title">Project Info</h3>
                        <div class="separator-2"></div>
                        <ul class="list margin-clear">
                            <li><strong>Müşteri: </strong> <span class="text-right"><?php echo $portfolio->client?></span></li>
                            <li><strong>Tarih: </strong> <span class="text-right"><?php echo get_readable_date($portfolio->finishedAt); ?></span></li>
                            <li><strong>Kategori: </strong> <span class="text-right"><?php echo get_portfolio_category_title($portfolio->category_id)?></span></li>
                            <li><strong>Yer: </strong> <span class="text-right"><?php echo $portfolio->place?></span></li>
                            <li><strong>URL: </strong> <span class="text-right"><a href="<?php echo $portfolio->portfolio_url?>"><?php echo $portfolio->portfolio_url?></a></span></li>
                        </ul>
                        <a href="<?php echo $portfolio->portfolio_url;?>" target="_blank" class="btn btn-animated btn-default btn-lg">Yeni Sekmede Aç<i class="fa fa-external-link"></i></a>
                    </div>
                </div>
            </aside>
            <!-- sidebar end -->




        </div>
    </div>
</section>
<!-- main-container end -->

<!-- section start -->
<!-- ================ -->
<section class="section pv-40 light-gray-bg clearfix">
    <div class="container">
        <h3 class="mt-3">Diğer <strong>Portfolyolar</strong></h3>
        <div class="row grid-space-10">
            <div class="row">
                <?php if($other_portfolios){
                    foreach ($other_portfolios as $portfolio){ ?>
                        <div class="col-sm-4">
                            <div class="image-box style-2 mb-20 shadow bordered light-gray-bg text-center">
                                <div class="overlay-container">
                                    <?php
                                    $image = get_product_cover_image($portfolio->id);
                                    $image = ($image) ? base_url("panel/uploads/product_v/$image") : base_url("assets/images/portfolio-1.jpg");
                                    ?>

                                    <img src="<?php echo $image ?>" alt="<?php echo $portfolio->title ?>">
                                    <div class="overlay-to-top">
                                        <p class="small margin-clear"><em><?php echo $portfolio->title;?></em></p>
                                    </div>
                                </div>
                                <div class="body">
                                    <h3><?php echo $portfolio->title;?></h3>
                                    <div class="separator"></div>
                                    <p><?php echo character_limiter(strip_tags($portfolio->description), 33);?></p>
                                    <a href="<?php echo base_url("portfolyo-detay/$portfolio->url")?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Daha fazla ayrıntı<i class="fa fa-arrow-right pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{?>
                    <div class="alert col-md-12  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Ürün bulunamadı.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- section end -->