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
                <h1 class="page-title"><?php echo $gallery->title ?></h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row">

                    <?php if ($items){
                        foreach ($items as $item){ ?>
                                <div class="col-sm-4 mb-sm-4">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $item->url;?>" allowfullscreen></iframe>
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

