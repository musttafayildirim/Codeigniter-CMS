<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Haberler Listesi
                    <a href="<?php echo base_url("news/new_news"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("news/new_news"); ?>">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th><i class="fa fa-reorder"></i></th>
                            <th>#id</th>
                            <th>URL</th>
                            <th>Başlık</th>
                            <th>Haber Türü</th>
                            <th>Görsel</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody class="sortable text-center" data-url="<?php echo base_url("news/rankSetter");?>">

                        <?php foreach ($items as $item){ ?>
                        <tr id="ord-<?php echo $item->id; ?>">
                            <td class="order"><i class="fa fa-reorder"></i></td>
                            <td class="w50 text-center">#<?php echo $item->id; ?></td>
                            <td><?php echo $item->url; ?></td>
                            <td><?php echo $item->title; ?></td>
                            <td class="text-center"><?php echo $item->news_type; ?></td>
                            <td class="text-center">
                                <?php if ($item->news_type === "image"){ ?>
                                    <img
                                            src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>"
                                            alt=""
                                            class="img-rounded w100">
                                <?php } else { ?>
                                    <iframe
                                            height="150"
                                            src="<?php echo $item->video_url; ?>"
                                            frameborder="0"
                                            allow="accelerometer;
                                            autoplay;
                                            encrypted-media;
                                            gyroscope;
                                            picture-in-picture"
                                            allowfullscreen>
                                    </iframe>

                                <?php } ?>


                            </td>
                            <td class="w50">
                                <input
                                        data-url = "<?php echo base_url("news/isActiveSetter/$item->id"); ?>";
                                        type="checkbox"
                                        class="isActive"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td>
                                <button
                                        data-url="<?php echo base_url("news/delete/$item->id")?>"
                                        class="btn btn-danger mw-xs remove-btn">
                                        <i class="fa fa-trash-o"></i></button>
                                <a href="<?php echo base_url("news/update_news/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
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