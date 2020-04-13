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
                        <div class="col-3 mb-4">
                            <div class="overlay-container">
                                <img  src="<?php echo get_image("galleries_v/images/$gallery->folder_name", $item->url, "253x156");?>" alt="">
                                <a href="<?php echo get_image("galleries_v/images/$gallery->folder_name", $item->url,"897x635");?>" class="overlay-link small popup-img" title="<?php echo $gallery->title;?>">
                                    <i class="fa fa-plus"></i>

                                <img  src="<?php echo get_image("galleries_v/images/$gallery->folder_name", $item->url, "253x156");?>" alt="">
                                <a href="<?php echo get_image("galleries_v/images/$gallery->folder_name", $item->url,"897x635") ?>" class="overlay-link small popup-img" title="<?php echo $gallery->title;?>">
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