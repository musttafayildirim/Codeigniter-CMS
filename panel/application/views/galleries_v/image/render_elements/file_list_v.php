<?php
$type = $gallery_type;
if($type == "image")
    $type_text = "resim";
else if($type == "file")
    $type_text = "dosya";
?>

<?php if (empty($item_images)) {?>

    <div class="alert alert-info alert-dismissible text-center">
        <p>Burada herhangi bir <?php echo $type_text;?> bulunamadı.</p>
    </div>
<?php }else { ?>
    <table class="table table-bordered table-hover table-striped image_list_container">
        <thead>
        <th><i class="order fa fa-reorder"></i></th>
        <th class="w50">#id</th>
        <th><?php echo ucfirst($type_text); ?></th>
        <th><?php echo ucfirst($type_text); ?> Yolu/Adı</th>
        <th>Durum</th>
        <th>İşlem</th>
        </thead>

        <tbody class="sortable" data-url="<?php echo base_url("galleries/fileRankSetter/$gallery_type");?>">
        <?php foreach ($item_images as $image) { ?>
            <tr id="ord-<?php echo $image->id;?>">
                <td class="order"  ><i class="fa fa-reorder"></i></td>
                <td class="text-center w50">#<?php echo $image->id; ?></td>
                <td class="w150 text-center">
                    <?php if($gallery_type == "image"){ ?>
                        <img src="<?php echo base_url("$image->url"); ?>" alt="<?php echo base_url("$image->url"); ?>" class="img-responsive">
                    <?php } else if($gallery_type == "file"){ ?>
                    <i class="fa fa-folder fa-2x"></i>
                    <?php } ?>
                </td>
                <td><?php echo $image->url;?></td>
                <td  class="w100 text-center">
                    <input
                        data-url = "<?php echo base_url("galleries/fileIsActiveSetter/$image->id/$gallery_type"); ?>";
                        type="checkbox"
                        class="isActive"
                        data-switchery="true"
                        data-color="#10c469"
                        <?php echo ($image->isActive) ? "checked" : ""; ?>

                </td>

                <td class="w100 text-center">
                    <button
                        data-url="<?php echo base_url("galleries/fileDelete/$image->id/$image->gallery_id/$gallery_type"); ?>"
                        class="btn btn-danger mw-xs remove-btn btn-block">
                        <i class="fa fa-trash-o"></i></button> </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php } ?>
