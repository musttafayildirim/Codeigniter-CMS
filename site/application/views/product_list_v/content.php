<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title">Ürünler Listesi</h1>
                <div class="separator-2"></div>
                <br>
                <div class="row">
                    <?php if($products){
                        foreach ($products as $product){ ?>
                        <div class="col-sm-4">
                            <div class="image-box style-2 mb-20 shadow bordered light-gray-bg text-center">
                                <div class="overlay-container">

                                    <img src="<?php echo get_image("product_v", get_product_cover_image($product->id),"348x215") ?>" alt="<?php echo $product->title ?>">
                                    <div class="overlay-to-top">
                                        <p class="small margin-clear"><em><?php echo $product->title;?> <br> <?php echo character_limiter(strip_tags($product->description), 15);?></em></p>
                                    </div>
                                </div>
                                <div class="body">
                                    <h3><?php echo character_limiter(strip_tags($product->title), 15);?></h3>
                                    <div class="separator"></div>
                                    <p><?php echo character_limiter(strip_tags($product->description), 33);?></p>
                                    <a href="<?php echo base_url("urun-detay/$product->url")?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Daha fazla ayrıntı<i class="fa fa-arrow-right pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else{?>
                        <div class="alert col-md-12  alert-icon alert-info" role="alert">
                            <i class="fa fa-info-circle"></i>
                            Ürün bulunamadı.
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
</section>