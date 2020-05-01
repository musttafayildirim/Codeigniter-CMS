<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Kullanıcı Rolleri Listesi
                    <a href="<?php echo base_url("user_roles/new_user_role"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle </a>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("user_roles/new_user_role"); ?>">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th><i class="fa fa-reorder"></i></th>
                            <th>#id</th>
                            <th>Başlık</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item){ ?>
                            <tr id="ord-<?php echo $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td><?php echo $item->title; ?></td>
                                <td class="w100 text-center">
                                    <input
                                            data-url = "<?php echo base_url("user_roles/isActiveSetter/$item->id"); ?>";
                                            type="checkbox"
                                            class="isActive"
                                            data-switchery="true"
                                            data-color="#10c469"
                                            <?php echo ($item->isActive) ? "checked": ""  ?>
                                    >
                                </td>
                                <td class="w200">
                                    <button
                                            data-url="<?php echo base_url("user_roles/delete/$item->id")?>"
                                            class="btn btn-danger mw-xs remove-btn">
                                            <i class="fa fa-trash-o"></i></button>
                                    <a href="<?php echo base_url("user_roles/update_user_roles/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url("user_roles/user_permissions_form/$item->id"); ?>" class="btn btn-warning mw-xs"><i class="fa fa-low-vision" style="color: #000000" > Yetki </i></a>
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