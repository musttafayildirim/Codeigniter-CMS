<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Galeriler Listesi
                    <a href="<?php echo base_url("galleries/new_gallery"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="#">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th><i class="fa fa-reorder"></i></th>
                            <th>Başlık</th>
                            <th>Galeri Tipi</th>
                            <th>Klasör Adı</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("galleries/rankSetter");?>">

                        <?php foreach ($items as $item){ ?>
                        <tr id="ord-<?php echo $item->id; ?>">
                            <td class="order"><i class="fa fa-reorder"></i></td>
                            <td class="text-center"><?php echo $item->title; ?></td>
                            <td class="text-center"><?php echo $item->gallery_type; ?></td>
                            <td class="text-center"><?php echo $item->folder_name; ?></td>
                            <td class="w50">
                                <input
                                        data-url = "<?php echo base_url("galleries/isActiveSetter/$item->id"); ?>";
                                        type="checkbox"
                                        class="isActive"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td style="width: 300px;" class="text-center">
                                <button
                                        data-url="<?php echo base_url("galleries/delete/$item->id")?>"
                                        class="btn btn-danger mw-xs remove-btn">
                                        <i class="fa fa-trash-o"> Sil </i>
                                </button>

                                <?php
                                if($item->gallery_type == "image"){
                                    $btn_icon = "fa-image";
                                    $type_text = "Resim Ekle";
                                }
                                else if($item->gallery_type == "video"){
                                    $btn_icon = "fa-play-circle";
                                    $type_text = "Video Ekle";
                                }
                                else{
                                    $btn_icon = "fa-folder";
                                    $type_text = "Dosya Ekle";
                                }
                                ?>

                                <a href="<?php echo base_url("galleries/update_galleries/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"> Düzenle </i></a>
                                <a href="<?php echo base_url("galleries/upload_form/$item->id"); ?>" class="btn btn-success mw-xs"><i class="fa <?php echo $btn_icon; ?>"> <?php echo $type_text;?> </i></a>
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