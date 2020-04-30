<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->user_name;?> Kayıtlı Kullanıcının Yetkileri Güncelleniyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("users/update_permissions/$item->id"); ?>" method="post">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>Modül Adı</th>
                        <th>Görüntüleme</th>
                        <th>Ekleme</th>
                        <th>Düzenleme</th>
                        <th>Silme</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Users</td>
                            <td class="w50 text-center">
                                <input type="checkbox" data-switchery data-color="#10c469"/>
                            </td>
                            <td class="w50 text-center">
                                <input type="checkbox" data-switchery data-color="#10c469"/>
                            </td>
                            <td class="w50 text-center">
                                <input type="checkbox" data-switchery data-color="#10c469"/>
                            </td>
                            <td class="w50 text-center">
                                <input type="checkbox" data-switchery data-color="#10c469"/>
                            </td>
                        </tr>

                    </tbody>

                </table>

                <hr>

                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Şifreyi Güncelle</button>
                <a href="<?php echo base_url("users"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>