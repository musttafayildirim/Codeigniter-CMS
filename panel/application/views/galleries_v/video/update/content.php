<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <strong>Video</strong>  bağlantınızı güncelliyorsunuz
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("galleries/update_galleries_video/$item->id/$item->gallery_id"); ?>" method="post">
<!--                        Video bağlantısının görüntüleneceği yer...-->
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Video bağlantınızı buraya ekleyebilirsiniz."
                               name="url"
                               value="<?php echo $item->url; ?>">
                    </div>

                <hr class="widget-separator">
                <div class="row container-fluid">
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url("galleries/gallery_video_list/$item->gallery_id"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </div>


            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>