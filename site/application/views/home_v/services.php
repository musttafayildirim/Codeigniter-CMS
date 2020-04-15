<?php $settings = get_settings();?>
<section class="light-gray-bg pv-40 border-clear">
    <div class="container">

        <!-- page-title start -->
        <!-- ================ -->
        <h1 class="page-title text-center">Bazı <strong>Hizmetlerimiz</strong></h1>
        <div class="separator"></div>
        <br>
        <!-- page-title end -->

        <div class="row">
            <?php foreach ($services as $service){ ?>
                <div class="col-md-4">
                <div class="image-box style-2 mb-20">
                    <div class="overlay-container overlay-visible">
                        <img
                                src="<?php echo get_image("services_v", $service->img_url, "350x217");?>"
                                alt="<?php echo $service->title;?>"
                        >
                        <a href="<?php echo base_url("hizmetlerimiz/#$service->url");?>" class="overlay-link"><i class="fa fa-link"></i></a>
                        <div class="overlay-bottom">
                            <div class="text">
                                <p class="lead margin-clear text-left mobile-visible"><?php $service->title?></p>
                            </div>
                        </div>
                    </div>
                    <div class="body padding-horizontal-clear">
                        <p><?php echo character_limiter(strip_tags($service->description), 100);?></p>
                        <a class="link-dark" href="<?php echo base_url("hizmetlerimiz/#$service->url");?>">Daha Fazla</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</section>