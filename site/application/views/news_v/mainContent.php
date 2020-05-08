<div class="main col-lg-8">

    <!-- page-title start -->
    <!-- ================ -->
    <h1 class="page-title"><?php echo $news->title;?></h1>
    <!-- page-title end -->

    <!-- blogpost start -->
    <!-- ================ -->
    <article class="blogpost">
        <header>
            <div class="post-info mb-4">
                    <span class="post-date">
                      <i class="icon-calendar"></i>
                      <span class="month"><?php echo get_readable_date($news->createdAt);?></span>
                    </span>
                <span class="comments"><i class="icon-chat"></i><?php echo $news->viewCount;?> Görüntülenme</span>
            </div>
        </header>
        <div class="blogpost-content">
            <div id="carousel-blog-post" class="carousel slide mb-4" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php if($news->news_type == 'image'){ ?>
                            <div class="overlay-container">
                                <img src="<?php echo get_image("news_v", $news->img_url, "730x451");?>" alt="<?php echo $news->url;?>">
                                <a class="overlay-link popup-img" href="<?php echo get_image("news_v", $news->img_url, "730x451");?>"><i class="fa fa-search-plus"></i></a>
                            </div>
                        <?php }else{ ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $news->video_url?>" allowfullscreen></iframe>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p><?php echo $news->description;?></p>
        </div>
        <footer class="clearfix">
            <div class="link pull-right">
                <ul class="social-links circle small colored clearfix margin-clear text-right animated-effect-1">
                    <li class="twitter">
                        <a class="share-button" target="_blank" href="https://www.twitter.com/intent/tweet?text=<?php echo $news->title;?>&url=<?php echo base_url("haber-detayi/$news->url");?>"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="facebook">
                        <a class="share-button" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo base_url("haber-detayi/$news->url");?>&t=<?php echo $news->title;?>"><i class="fa fa-facebook"></i></a>
                    </li>
                </ul>
            </div>
        </footer>
    </article>
    <!-- blogpost end -->
</div>

