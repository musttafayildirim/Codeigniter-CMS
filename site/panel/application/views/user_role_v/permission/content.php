<?php $permissions = json_decode($item->permissions); ?>

<div class="row">
<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->title;?> Kayıtlı Yetki Güncelleniyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("user_roles/update_permissions/$item->id"); ?>" method="post">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>Modül Adı</th>
                        <th>Görüntüleme</th>
                        <th>Ekleme</th>
                        <th>Düzenleme</th>
                        <th>Silme</th>
                    </thead>

                    <tbody>

                        <?php foreach (getControllerList() as $ControllerName): ?>
                            <tr>
                                <td><?php echo $ControllerName ?></td>
                                <td class="w50 text-center">
                                    <input
                                        <?php echo (isset($permissions->$ControllerName->read)) ? "checked" : "";?>
                                            name="permissions[<?php echo $ControllerName?>][read]" type="checkbox" data-switchery data-color="#10c469"/>
                                </td>
                                <td class="w50 text-center">
                                    <input
                                        <?php echo (isset($permissions->$ControllerName->write)) ? "checked" : "";?>
                                            name="permissions[<?php echo $ControllerName?>][write]" type="checkbox" data-switchery data-color="#10c469"/>
                                </td>
                                <td class="w50 text-center">
                                    <input
                                        <?php echo (isset($permissions->$ControllerName->update)) ? "checked" : "";?>
                                            name="permissions[<?php echo $ControllerName?>][update]" type="checkbox" data-switchery data-color="#10c469"/>
                                </td>
                                <td class="w50 text-center">
                                    <input
                                        <?php echo (isset($permissions->$ControllerName->delete)) ? "checked" : "";?>
                                            name="permissions[<?php echo $ControllerName?>][delete]" type="checkbox" data-switchery data-color="#10c469"/>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>

                <hr>

                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Yetkilendir</button>
                <a href="<?php echo base_url("user_roles"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>