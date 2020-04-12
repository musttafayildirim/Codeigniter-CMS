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
                <h1 class="page-title">Dosya Galerileri</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row">
                    <?php if ($files){
                        foreach ($files as $file){ ?>
                            <div class="col-sm-4">
                                <div class="image-box shadow text-center mb-20">
                                    <div class="overlay-container overlay-visible">
                                        <img src="<?php echo base_url("assets/images");?>/portfolio-4.jpg" alt="">
                                        <a href="<?php echo base_url("dosya-galerisi-detay/$file->url") ?>" class="overlay-link"><i class="fa fa-link"></i></a>
                                        <div class="overlay-bottom hidden-xs">
                                            <div class="text">
                                                <p class="lead margin-clear"><?php echo $file->title?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php }else{ ?>
                    <div class="col-md-12 alert  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Burada hiçbir dosya galerisi bulunmamaktadır.
                    </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>