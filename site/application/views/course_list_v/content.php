<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Eğitimler Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <p class="lead">Burada sizin için eğitimlerimizi listeliyoruz.</p>

                <?php foreach ($courses as $course) { ?>
                    <div class="image-box style-3-b">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="overlay-container">
                                <img src="<?php echo base_url("panel/uploads/courses_v/$course->img_url") ?>" alt="">

                                <div class="overlay-to-top">
                                    <p class="small margin-clear"><em><?php echo $course->title;?></em></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8 col-xl-9">
                            <div class="body">
                                <h3 class="title"><a href="portfolio-item.html"><?php echo $course->title?></a></h3>
                                <p class="small mb-10"><i class="icon-calendar">
                                    </i> <?php echo get_readable_date($course->event_date) ?>
                                </p>
                                <div class="separator-2"></div>
                                <p class="mb-10"><?php echo character_limiter(strip_tags($course->description), 200);?></p>
                                <a href="<?php echo base_url("egitim-detay/$course->url") ?>"
                                   class="btn btn-default btn-hvr hvr-shutter-out-horizontal margin-clear">Daha fazla ayrıntı
                                    <i class="fa fa-arrow-right pl-10"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
               <?php } ?>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>
<!-- main-container end -->
