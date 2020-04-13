<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Referanslarımız</h1>
                <div class="separator-2"></div>
                <?php $index = 0;?>
                <?php if($references){ ?>
                <?php foreach ($references as $reference){
                    if (($index % 2) == 0){?>
                        <div class="image-box style-4 light-gray-bg">
                            <div class="row grid-space-0">
                                <div class="col-lg-6">
                                    <div class="overlay-container">
                                        <img src="<?php echo get_image("reference_v", $reference->img_url, "555x343");;?>" alt="<?php echo $reference->title;?>">
                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $reference->title ?></em></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="body">
                                        <div class="pv-30 hidden-lg-down"></div>
                                        <h3><?php echo $reference->title;?></h3>
                                        <div class="separator-2"></div>
                                        <p class="margin-clear"><?php echo character_limiter(strip_tags($reference->description), 600) ;?></p>
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
                                        <h3><?php echo $reference->title;?></h3>
                                        <div class="separator-2"></div>
                                        <p class="margin-clear"><?php echo character_limiter(strip_tags($reference->description), 600) ;?></p>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="overlay-container">
                                        <img src="<?php echo base_url("panel/uploads/reference_v/$reference->img_url");?>" alt="<?php echo $reference->title;?>">
                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $reference->title ?></em></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } $index++; ?>
                <?php } }else if(empty($references)){ ?>
                    <div class="alert col-md-12  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                        Herhangi bir referans eklenmemiştir.
                    </div>
                <?php } ?>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>