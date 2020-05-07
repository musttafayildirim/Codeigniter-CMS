<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Hizmetlerimiz</h1>
                <div class="separator-2"></div>
                <?php $index = 0;?>
                <?php if($services){ ?>
                <?php foreach ($services as $service){
                    if (($index % 2) == 0){?>
                        <div class="image-box style-4 light-gray-bg">
                            <div class="row grid-space-0">
                                <div class="col-lg-6">
                                    <div class="overlay-container">

                                        <img id="<?php echo $service->url;?>" src="<?php echo get_image("services_v", $service->img_url, "555x343");?>" alt="<?php echo $service->title;?>">
                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $service->title ?></em></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="body">
                                        <div class="pv-30 hidden-lg-down"></div>
                                        <h3><?php echo $service->title;?></h3>
                                        <div class="separator-2"></div>
                                        <p class="margin-clear"><?php echo character_limiter(strip_tags($service->description), 600) ;?></p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="image-box style-4 light-gray-bg">
                            <div class="row grid-space-0">
                                <div class="col-lg-6">
                                    <div class="body">
                                        <div class="pv-30 hidden-lg-down"></div>
                                        <h3><?php echo $service->title;?></h3>
                                        <div class="separator-2"></div>
                                        <p class="margin-clear"><?php echo character_limiter(strip_tags($service->description), 600) ;?></p>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="overlay-container">

                                        <img id="<?php echo $service->url;?>" src="<?php echo get_image("services_v", $service->img_url, "555x343"); ?>" alt="<?php echo $service->title;?>">
                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $service->title ?></em></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } $index++; ?>
                <?php } }else if(empty($services)){ ?>
                    <div class="alert col-md-12  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Herhangi bir hizmet eklenmemiştir.
                    </div>
                <?php } ?>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>