<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Kullanıcılar Listesi
                    <?php if(isAdmin()): ?>
                        <a href="<?php echo base_url("users/new_user"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                    <?php endif; ?>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <p>Burada herhangi bir kayıt bulunamadı. Eklemek için lütfen <a href="<?php echo base_url("users/new_user"); ?>">tıklayınız.</a></p>
                </div>
                        <?php } else { ?>
                <div class="table-responsive content-container">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead class="text-secondary bg-inverse">
                        <tr>
                            <th>#id</th>
                            <th>Kullanıcı Adı</th>
                            <th>Ad Soyad</th>
                            <th>E-posta Adresi</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>

                        <tbody class="text-center">
                        <?php foreach ($items as $item){ ?>
                        <tr>
                            <td class="w50 text-center">#<?php echo $item->id; ?></td>
                            <td><?php echo $item->user_name; ?></td>
                            <td><?php echo $item->full_name; ?></td>
                            <td class="text-center"><?php echo $item->email; ?></td>
                            <td class="w50">
                                <input
                                        data-url = "<?php echo base_url("users/isActiveSetter/$item->id"); ?>";
                                        type="checkbox"
                                        class="isActive"
                                        data-switchery="true"
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked": ""  ?>
                                >
                            </td>
                            <td style="width: 300px;">
                                <button
                                        data-url="<?php echo base_url("users/delete/$item->id")?>"
                                        class="btn btn-danger mw-xs remove-btn">
                                        <i class="fa fa-trash-o"></i>
                                </button>
                                <a href="<?php echo base_url("users/update_user/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?php echo base_url("users/update_password_form/$item->id"); ?>" class="btn btn-primary mw-xs"><i class="fa fa-key"> Şifreyi Değiştir </i></a>
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