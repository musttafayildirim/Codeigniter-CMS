<section class="clearfix pv-40">
    <div class="container">
        <div class="row justify-content-lg-center">

            <h3 class="mt-4">Bazı <strong>Çalışmalarımız</strong></h3>
            <div class="separator-2"></div>
            <div class="row grid-space-10">
                <?php foreach ($portfolios as $portfolio) { ?>
                    <div class="col-md-6 col-lg-3">
                    <div class="image-box style-2 mb-20 shadow bordered light-gray-bg text-center">
                        <div class="overlay-container">
                            <img src="<?php echo get_image("portfolio_v", get_portfolio_cover_image($portfolio->id), "269x166" ) ?>" alt="">
                            <div class="overlay-to-top">
                                <p class="small margin-clear"><em><?php echo character_limiter(strip_tags($portfolio->title), 75);?></em></p>
                            </div>
                        </div>
                        <div class="body">
                            <h3><?php echo $portfolio->title ?></h3>
                            <div class="separator"></div>
                            <p><?php echo character_limiter(strip_tags($portfolio->description), 150);?></p>
                            <a href="<?php echo base_url("portfolyo-detay/$portfolio->url");?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Daha Fazla<i class="fa fa-arrow-right pl-10"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>
</section>