<?php if (empty($item_images)) { ?>
    <div class="alert alert-info alert-dismissible text-center">
        <p>Burada herhangi bir resim bulunamadı.</p>
    </div>
<?php }else { ?>
    <table class="table table-bordered table-hover table-striped image_list_container">
        <thead>
        <th><i class="order fa fa-reorder"></i></th>
        <th class="w50">#id</th>
        <th>Görsel</th>
        <th>Resim Adı</th>
        <th>Durum</th>
        <th>Kapak</th>
        <th>İşlem</th>
        </thead>

        <tbody class="sortable" data-url="<?php echo base_url("product/imageRankSetter");?>">
        <?php foreach ($item_images as $image) { ?>
            <tr id="ord-<?php echo $image->id;?>">
                <td class="order"  ><i class="fa fa-reorder"></i></td>
                <td class="text-center">#<?php echo $image->id; ?></td>
                <td class="center" style="width: 75px;"><img src="<?php echo get_image($viewFolder, $image->img_url, "70x70"); ?>" alt="<?php echo $image->img_url?>" class="img-responsive"></td>
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
                    <?php if (isAllowedDeleteModule($this->router->fetch_class())):?>
                        <button
                            data-url="<?php echo base_url("product/imageDelete/$image->id/$image->product_id"); ?>"
                            class="btn btn-danger mw-xs remove-btn btn-block">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    <?php endif;?>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php } ?>
