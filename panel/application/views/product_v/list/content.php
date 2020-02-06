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
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="#">tıklayınız.</a></p>
                </div>
                    <?php }else{ ?>
                <div class="table-responsive">
                    <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>URL</th>
                            <th>Başlık</th>
                            <th>Açıklama</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#id</th>
                            <th>URL</th>
                            <th>Başlık</th>
                            <th>Açıklama</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        <?php foreach ($items as $item){ ?>
                        <tr>
                            <td>#<?php echo $item->id; ?></td>
                            <td><?php echo $item->url; ?></td>
                            <td><?php echo $item->title; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td>
                                <input
                                        type="checkbox"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger mw-xs"><i class="fa fa-trash-o"></i></a>
                                <a href="<?php echo base_url("product/update_product/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
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