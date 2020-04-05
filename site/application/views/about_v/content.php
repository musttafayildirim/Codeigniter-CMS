<div class="banner dark-translucent-bg" style="background-image:url('<?php echo base_url("panel/uploads/settings_v/sehrin-isiklari.jpg")?>'); background-position: 50% 70%;">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-12 text-center pv-20">
                <h3 class="title logo-font object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><?php echo $about->company_name;?></h3>
                <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
                <p class="text-center object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><?php echo $about->slogan?></p>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->
<!-- main-container start -->
<!-- ================ -->
<section class="main-container padding-bottom-clear">

    <div class="container">
        <div class="row">
            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">
                <h3 class="title">Kimiz <strong>Biz</strong></h3>
                <div class="separator-2"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <p><?php echo $about->about_us?></p>
                    </div>
                </div>
            </div>
            <!-- main end -->

        </div>
    </div>

    <!-- section start -->
    <!-- ================ -->
    <div class="section light-gray-bg pv-20">
        <div class="container">
            <h3 class="mt-4">Neden <strong>Bizi Seçmelisiniz</strong></h3>
            <div class="separator-2"></div>
            <div class="row">
                <!-- accordion start -->
                <!-- ================ -->
                <div class="col-lg-12">
                    <div id="accordion" class="collapse-style-1" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="fa fa-tasks pr-10"></i>Misyonumuz
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-block">
                                    <?php echo $about->mission?>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="true" aria-controls="collapseThree">
                                        <i class="fa fa-lightbulb-o pr-10"></i>Vizyonumuz
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-block">
                                    <?php echo $about->vision?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- accordion end -->
            </div>
            <!-- clients start -->
            <!-- ================ -->
            <div class="separator"></div>
        </div>
    </div>
    <!-- section end -->

</section>
<!-- main-container end -->
