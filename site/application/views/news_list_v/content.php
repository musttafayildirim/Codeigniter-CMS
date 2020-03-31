<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Haberler Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->

                <!-- timeline grid start -->
                <!-- ================ -->
                <div class="timeline clearfix">
                    <?php $count = 0 ;?>
                    <?php foreach ($news as $new) { ?>
                    <!-- timeline grid item start -->
                    <div class="timeline-item pull-<?php echo (($count++ % 2) == 0) ? "left" : "right" ; ?>">
                        <!-- blogpost start -->
                        <article class="blogpost shadow-2 light-gray-bg bordered <?php echo ($new->news_type == 'video') ? "object-non-visible" : "" ?>"
                            <?php echo ($new->news_type == 'video') ? 'data-animation-effect="fadeInUpSmall" data-effect-delay="100"' : "" ?>>
                            <?php if($new->news_type == 'image'){ ?>
                            <div class="overlay-container">
                                <img src="<?php echo base_url("panel/uploads/news_v/$new->img_url")?>" alt="">
                                <a class="overlay-link" href="<?php echo base_url("haber-detayi/$new->url") ?>"><i class="fa fa-link"></i></a>
                            </div>
                            <?php }else{ ?>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?php echo $new->video_url ?>"></iframe>
                                </div>
                            <?php } ?>
                            <header>
                                <h2><a href="<?php echo base_url("haber-detayi/$new->url") ?>"><?php echo $new->title;?></a></h2>
                                <input type="hidden" value="<?php echo $new->id;?>">
                                <div class="post-info">
                        <span class="post-date">
                          <i class="icon-calendar"></i>
                          <span class="month"><?php echo get_readable_date($new->createdAt);?></span>
                        </span>
                                    <span class="comments"><i class="icon-eye"></i><?php echo $new->viewCount?> Görüntülenme</span>
                                </div>
                            </header>
                            <div class="blogpost-content">
                                <p><?php echo character_limiter(strip_tags($new->description), 300);?></p>
                            </div>
                            <footer class="clearfix">
                                <div class="link pull-right"><i class="icon-link"></i><a href="<?php echo base_url("haber-detayi/$new->url") ?>">Devamını oku</a></div>
                            </footer>
                        </article>
                        <!-- blogpost end -->
                    </div>
                    <!-- timeline grid item end -->

                    <?php }?>

                </div>
                <!-- timeline grid end -->

            </div>
            <!-- main end -->

        </div>
    </div>
</section>
<!-- main-container end -->