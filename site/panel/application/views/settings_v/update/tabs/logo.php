<div role="tabpanel" class="tab-pane fade" id="tab-6">
    <div class="row">
        <div class="col-md-1 fixed-bottom" style="margin-top: 20px;">
            <img src="<?php echo get_image($viewFolder, $item->logo, "70x70"); ?>"
                 alt="<?php echo $item->company_name;?>"
                 class="img-responsive">
        </div>
        <div class="form-group col-md-11 ">
            <h4 class="m-b-md">Masaüstü Logosu Yükleyiniz</h4>
            <input type="file" name="logo" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 fixed-bottom" style="margin-top: 20px;">
            <img src="<?php echo get_image($viewFolder, $item->mobile_logo, "70x70"); ?>"
                 alt="<?php echo $item->company_name;?>"
                 class="img-responsive">
        </div>
        <div class="form-group col-md-11 ">
            <h4 class="m-b-md">Mobil Logosu Yükleyiniz</h4>
            <input type="file" name="mobile_logo" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-1 fixed-bottom" style="margin-top: 20px;">
            <img src="<?php echo get_image($viewFolder, $item->favicon, "70x70"); ?>"
                 alt="<?php echo $item->company_name;?>"
                 class="img-responsive">
        </div>
        <div class="form-group col-md-11 ">
            <h4 class="m-b-md">Favicon</h4>
            <input type="file" name="favicon" class="form-control">
        </div>
    </div>
</div><!-- .tab-pane  -->

