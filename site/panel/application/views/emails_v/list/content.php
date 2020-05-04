<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    E-Postalar Listesi
                    <?php if(isAllowedAddModule($this->router->fetch_class())): ?>
                        <a href="<?php echo base_url("email/new_email"); ?>" class="btn btn-info pull-right btn-xs"><i class="fa fa-plus"></i> Yeni Ekle</a>
                    <?php endif; ?>
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($items)) { ?>
                    <div class="alert alert-info alert-dismissible text-center">
                        <p>Burada herhangi bir kayıt bulunamadı.
                            <?php if(isAllowedAddModule($this->router->fetch_class())): ?>
                                Eklemek için lütfen <a href="<?php echo base_url("email/new_email"); ?>">tıklayınız.</a>
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
                                <th>#id</th>
                                <th>E-Posta Başlık</th>
                                <th>Protokol</th>
                                <th>Host</th>
                                <th>Port</th>
                                <th>Kullanıcının Mail Adresi</th>
                                <th>Kime</th>
                                <th>Durum</th>
                                <?php if(isAllowedDeleteModule($this->router->fetch_class()) || isAllowedUpdateModule($this->router->fetch_class())): ?>
                                    <th>İşlem</th>
                                <?php endif;?>
                            </tr>
                            </thead>

                            <tbody class="text-center">
                            <?php foreach ($items as $item){ ?>
                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td class="text-center w100"><?php echo $item->user_name; ?></td>
                                <td class="text-center w50"><?php echo $item->protocol; ?></td>
                                <td class="text-center w100"><?php echo $item->host; ?></td>
                                <td class="text-center w50"><?php echo $item->port; ?></td>
                                <td class="text-center"><?php echo $item->user; ?></td>
                                <td class="text-center"><?php echo $item->to; ?></td>
                                <td class="w50">
                                    <input
                                            data-url = "<?php echo base_url("email/isActiveSetter/$item->id"); ?>";
                                            type="checkbox"
                                            class="isActive"
                                            data-switchery="true"
                                            data-color="#10c469"
                                            <?php echo ($item->isActive) ? "checked": ""  ?>
                                    >
                                </td>
                                <?php if(isAllowedDeleteModule($this->router->fetch_class()) || isAllowedUpdateModule($this->router->fetch_class())): ?>
                                    <td>
                                        <?php if(isAllowedDeleteModule($this->router->fetch_class())): ?>
                                            <button
                                                    data-url="<?php echo base_url("email/delete/$item->id")?>"
                                                    class="btn btn-danger mw-xs remove-btn">
                                                    <i class="fa fa-trash-o"></i>
                                            </button>
                                        <?php endif;?>
                                        <?php if(isAllowedUpdateModule($this->router->fetch_class())): ?>
                                            <a href="<?php echo base_url("email/update_email/$item->id"); ?>" class="btn btn-info mw-xs"><i class="fa fa-pencil-square-o"></i></a>
                                        <?php endif;?>
                                    </td>
                                <?php endif;?>
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