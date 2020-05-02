<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Slayt Listesi
                    <?php if(isAllowedAddModule($this->router->fetch_class())): ?>
                        <a href="<?php echo base_url("slides/new_slide"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                    <?php endif;?>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                    <div class="alert alert-info alert-dismissible text-center">
                        <p>Burada herhangi bir kayıt bulunamadı.
                            <?php if(isAllowedAddModule($this->router->fetch_class())): ?>
                                Eklemek için lütfen <a href="<?php echo base_url("slides/new_slide"); ?>">tıklayınız.</a>
                            <?php else:?>
                                Sistem <b>yetkilisi</b> ile görüşünüz.
                            <?php endif;?>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="table-responsive content-container">
                        <table class="table table-bordered table-hover table-condensed">
                            <thead class="text-secondary bg-inverse">
                            <tr>
                                <th><i class="fa fa-reorder"></i></th>
                                <th>#id</th>
                                <th>Başlık</th>
                                <th>Açıklama</th>
                                <th>Görsel</th>
                                <th>Durum</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody class="sortable text-center" data-url="<?php echo base_url("slides/rankSetter");?>">

                            <?php foreach ($items as $item){ ?>
                            <tr id="ord-<?php echo $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td><?php echo $item->title; ?></td>
                                <td><?php echo character_limiter(strip_tags($item->description), 150);?></td>
                                <td class="text-center" style="width: 75px">
                                        <img
                                                src="<?php echo get_image($viewFolder, $item->img_url, "70x70"); ?>"
                                                alt="<?php echo $item->title?>"
                                                class="img-rounded">
                                </td>
                                <td class="w100">
                                    <input
                                            data-url = "<?php echo base_url("slides/isActiveSetter/$item->id"); ?>";
                                            type="checkbox"
                                            class="isActive"
                                            data-switchery="true"
                                            data-color="#10c469"
                                            <?php echo ($item->isActive) ? "checked": ""  ?>
                                    >
                                </td>
                                <td class="w150">
                                    <button
                                            data-url="<?php echo base_url("slides/delete/$item->id")?>"
                                            class="btn btn-danger mw-xs remove-btn">
                                            <i class="fa fa-trash-o"></i></button>
                                    <a href="<?php echo base_url("slides/update_slide/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
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