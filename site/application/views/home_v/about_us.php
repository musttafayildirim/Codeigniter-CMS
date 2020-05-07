<?php $settings = get_settings();?>
<section class="pv-40">
    <div class="container">
        <div class="row">


            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">
                <h3 class="title">Bizim <strong class="text-default">Hakkımızda</strong></h3>
                <div class="separator-2"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <p><?php echo $settings->about_us?></p>
                    </div>
                    <div class="col-lg-6">
                        <div class="owl-carousel content-slider-with-controls">
                            <?php foreach ($products as $product){ ?>
                                <div class="overlay-container overlay-visible">
                                    <img src="<?php echo get_image("product_v", get_product_cover_image($product->id),"540x325") ?>"
                                         alt="<?php echo $product->title?>">
                                    <div class="overlay-bottom hidden-sm-down">
                                        <div class="text">
                                            <h3 class="title"><?php echo $product->title?></h3>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url("urun-detay/$product->url") ?>" class="overlay-link" title="<?php echo $product->title?>"><i class="icon-link-1"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>