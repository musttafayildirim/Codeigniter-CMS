<?php if (empty($item_images)) { ?>
    <div class="alert alert-info alert-dismissible text-center">
        <p>Burada herhangi bir resim bulunamadı.</p>
    </div>
<?php }else { ?>
    <table class="table table-bordered table-hover table-striped image_list_container">
        <thead>
        <th><i class="fa fa-reorder"></i></th>
        <th>#id</th>
        <th>Görsel</th>
        <th>Resim Adı</th>
        <th>Durum</th>
        <th>Kapak</th>
        <th>İşlem</th>
        </thead>

        <tbody class="sortable" data-url="<?php echo base_url("product/imageRankSetter");?>">
        <?php foreach ($item_images as $image) { ?>
            <tr id="ord-<?php echo $image->id;?>">
                <td><i class="fa fa-reorder"></i></td>
                <td class="w100 text-center">#<?php echo $image->id; ?></td>
                <td class="w100"><img src="<?php echo base_url("uploads/{$viewFolder}/$image->img_url"); ?>" alt="<?php echo base_url("uploads/{$viewFolder}/$image->img_url"); ?>" class="img-responsive"></td>
                <td><?php echo $image->img_url;?></td>
                <td  class="w100 text-center">
                    <input
                        data-url = "<?php echo base_url("product/imageIsActiveSetter/$image->id"); ?>";
                        type="checkbox"
                        class="isActive"
                        data-switchery="true"
                        data-color="#10c469"
                        <?php echo ($image->isActive) ? "checked" : ""; ?>

                </td>

                <td class="w100 text-center">
                    <input
                        data-url = "<?php echo base_url("product/isCoverSetter/$image->id/$image->product_id"); ?>";
                        type="checkbox"
                        class="isCover"
                        data-switchery="true"
                        data-color="#f9c851"
                        <?php echo ($image->isCover) ? "checked" : ""; ?>
                </td>
                <td class="w100 text-center">
                    <button
                        data-url="<?php echo base_url("product/delete/")?>"
                        class="btn btn-danger mw-xs remove-btn btn-block">
                        <i class="fa fa-trash-o"></i></button> </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php } ?>
