<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Ürün Listesi
                    <a href="<?php echo base_url("product/new_product"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("product/new_product"); ?>">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th><i class="fa fa-reorder"></i></th>
                            <th>#id</th>
                            <th>URL</th>
                            <th>Başlık</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody class="sortable" data-url="<?php echo base_url("product/rankSetter");?>">

                        <?php foreach ($items as $item){ ?>
                        <tr id="ord-<?php echo $item->id; ?>">
                            <td class="order"><i class="fa fa-reorder"></i></td>
                            <td class="w50 text-center">#<?php echo $item->id; ?></td>
                            <td><?php echo $item->url; ?></td>
                            <td><?php echo $item->title; ?></td>
                            <td class="w50">
                                <input
                                        data-url = "<?php echo base_url("product/isActiveSetter/$item->id"); ?>";
                                        type="checkbox"
                                        class="isActive"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td class="w175">
                                <button
                                        data-url="<?php echo base_url("product/delete/$item->id")?>"
                                        class="btn btn-danger mw-xs remove-btn">
                                        <i class="fa fa-trash-o"></i></button>
                                <a href="<?php echo base_url("product/update_product/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?php echo base_url("product/image_form/$item->id"); ?>" class="btn btn-success mw-xs"><i class="fa fa-image"></i></a>
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