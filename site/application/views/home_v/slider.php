<div class="slideshow">

    <!-- slider revolution start -->
    <!-- ================ -->
    <div class="slider-revolution-5-container">
        <div id="slider-banner-fullwidth-big-height" class="slider-banner-fullwidth-big-height rev_slider" data-version="5.0">
            <ul class="slides">

            <?php foreach ($slides as $slide){ ?>
                <!-- slide 1 start -->
                <!-- ================ -->
                <li data-transition="fadefromright" data-slotamount="default" data-masterspeed="default" data-title="<?php echo $slide->title;?>">

                    <!-- main image -->
                    <img src="<?php echo get_image("slides_v", $slide->img_url, "1920x650" )?>" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover"  class="rev-slidebg">

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption dark-translucent-bg caption-box text-left hidden-sm-down"
                         style="background-color: rgba(0, 0, 0, 0.7);"
                         data-x="left"
                         data-y="center"
                         data-start="1300"
                         data-whitespace="normal"
                         data-transform_idle="o:1;"
                         data-transform_in="y:[100%];sX:1;sY:1;o:0;s:1150;e:Power4.easeInOut;"
                         data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;"
                         data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                         data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;">
                        <h2 class="title"><?php echo $slide->title;?></h2>
                        <div class="separator-2 clearfix"></div>
                        <p><?php echo $slide->description;?></p>

                        <?php if($slide->allowButton){?>
                        <div class="text-right"><a class="btn btn-small btn-gray-transparent margin-clear" href="<?php echo $slide->button_url;?>"><?php echo $slide->button_caption;?></a></div>
                        <?php } ?>
                    </div>

                </li>
                <!-- slide 1 end -->
            <?php } ?>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!-- slider revolution end -->

</div>