<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Resim Galerileri</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row">
                    <?php if ($images){
                        foreach ($images as $image){ ?>
                            <div class="col-sm-4">
                                <div class="image-box shadow text-center mb-20">
                                    <div class="overlay-container overlay-visible">
                                        <img src="<?php echo base_url("assets/images");?>/portfolio-4.jpg" alt="">
                                        <a href="<?php echo base_url("resim-galerisi-detay/$image->url") ?>" class="overlay-link"><i class="fa fa-link"></i></a>
                                        <div class="overlay-bottom hidden-xs">
                                            <div class="text">
                                                <p class="lead margin-clear"><?php echo $image->title?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php }else{ ?>
                    <div class="col-md-12 alert  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Burada hiçbir video galerisi bulunmamaktadır.
                    </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>