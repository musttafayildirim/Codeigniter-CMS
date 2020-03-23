<!-- ================ -->
<div class="banner dark-translucent-bg" style="background-image:url('<?php echo base_url("panel/uploads/courses_v/$course->img_url");?>'); background-position: 50% 21%;">
    <!-- breadcrumb end -->
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-8 text-center pv-20">
                <h2 class="title object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><strong><?php echo $course->title ?></strong></h2>
                <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
                <p><?php echo character_limiter(strip_tags($course->description), 250)  ;?> </p>
                <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
                <h2 class="title object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><i class="fa fa-calendar"></i><strong> <?php echo get_readable_date($course->event_date) ?></strong></h2>


            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<section class="main-container padding-ver-clear">
    <div class="container pv-40">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-lg-12">
                <h1 class="title"><?php echo $course->title;?></h1>
                <div class="separator-2"></div>
                <p><?php echo $course->description;?></p>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->

<!-- section start -->
<!-- ================ -->
<section class="section pv-40 light-gray-bg clearfix">
    <div class="container">
        <h3 class="mt-3">Diğer <strong>Eğitimler</strong></h3>
        <div class="row grid-space-10">
            <div class="row">
                <?php if($other_courses){
                    foreach ($other_courses as $course){ ?>
                        <div class="col-sm-4">
                            <div class="image-box style-2 mb-20 shadow bordered light-gray-bg text-center">
                                <div class="overlay-container">

                                    <img src="<?php echo base_url("panel/uploads/courses_v/$course->img_url");?>" alt="<?php echo $course->title ?>">
                                    <div class="overlay-to-top">
                                        <p class="small margin-clear"><em><?php echo $course->title;?></em></p>
                                    </div>
                                </div>
                                <div class="body">
                                    <h3><?php echo $course->title;?></h3>
                                    <div class="separator"></div>
                                    <p><?php echo character_limiter(strip_tags($course->description), 33);?></p>
                                    <a href="<?php echo base_url("egitim-detay/$course->url")?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Daha fazla ayrıntı<i class="fa fa-arrow-right pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{?>
                    <div class="alert col-md-12  alert-icon alert-info" role="alert">
                        <i class="fa fa-info-circle"></i>
                       Başka bir eğitim bulunmamaktadır.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- section end -->