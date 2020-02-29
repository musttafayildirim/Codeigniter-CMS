<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <?php echo "$gallery->title galerisine ait videolar";?>
                    <a href="<?php echo base_url("galleries/new_gallery_video_form/$gallery->id"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("galleries/new_gallery_video_form/$gallery->id")?>">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th><i class="fa fa-reorder"></i></th>
                            <th>#id</th>
                            <th>URL</th>
                            <th>Video</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody class="sortable text-center" data-url="<?php echo base_url("galleries/gallery_video_rankSetter");?>">


                        <?php foreach ($items as $item){ ?>
                        <tr id="ord-<?php echo $item->id; ?>">
                            <td class="order"><i class="fa fa-reorder"></i></td>
                            <td class="w50 text-center">#<?php echo $item->id; ?></td>
                            <td class="text-center"><?php echo $item->url; ?></td>
                            <td class="text-center w100">
                                <iframe
                                        src="<?php echo $item->url; ?>"
                                        frameborder="0"
                                        allow="accelerometer;
                                        autoplay;
                                        encrypted-media;
                                        gyroscope;
                                        picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                            </td>
                            <td class="w50">
                                <input
                                        data-url = "<?php echo base_url("galleries/gallery_video_isActiveSetter/$item->id"); ?>";
                                        type="checkbox"
                                        class="isActive"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td class="w150">
                                <button
                                        data-url="<?php echo base_url("galleries/gallery_video_delete/$item->id/$gallery->id")?>"
                                        class="btn btn-danger mw-xs remove-btn">
                                        <i class="fa fa-trash-o"></i></button>
                                <a href="<?php echo base_url("galleries/update_gallery_video_form/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
                            </td>
                        </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>

                    <?php   } ?>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>