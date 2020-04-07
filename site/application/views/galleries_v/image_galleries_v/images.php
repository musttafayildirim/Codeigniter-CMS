<section class="main-container">
    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-lg-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title"><?php echo $gallery->title?></h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row grid-space-20">
                    <?php foreach ($items as $item){ ?>
                        <div class="col-3">
                            <div class="overlay-container">
                                <img  src="<?php echo base_url("assets/images");?>/portfolio-1.jpg" alt="">
                                <a href="<?php echo base_url("assets/images");?>/portfolio-1.jpg" class="overlay-link small popup-img" title="Second image title">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="space-bottom"></div>

            </div>
        </div>
    </div>
</section>