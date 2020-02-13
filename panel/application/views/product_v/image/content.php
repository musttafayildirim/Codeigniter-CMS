<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <strong><?php echo $item->title; ?></strong> kaydına ait resimler
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">

                <form action="<?php echo base_url("product/image_upload/$item->id") ?>" class="dropzone dz-clickable" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("product/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Dosyaları sürükleyin veya yüklemek için tıklayın.</h3>
                        <p class="m-b-lg text-muted">(Sadece img, jpg veya jpeg seçiniz. )</p>
                    </div>
                </form>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>


<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Resim alanı
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">


            <div class="widget-body">
                <?php if (empty($item_images)) { ?>
                    <div class="alert alert-info alert-dismissible text-center">
                        <p>Burada herhangi bir resim bulunamadı.</p>
                    </div>
                <?php }else { ?>
                   <table class="table table-bordered table-hover table-striped">
                       <thead>
                       <th>#id</th>
                       <th>Görsel</th>
                       <th>Resim Adı</th>
                       <th>Durum</th>
                       <th>Cover</th>
                       <th>İşlem</th>
                       </thead>

                       <tbody>
                       <?php foreach ($item_images as $image) { ?>
                       <tr>
                           <td class="w100 text-center">#<?php echo $image->id; ?></td>
                           <td class="w100"><img src="<?php echo base_url("uploads/{$viewFolder}/$image->img_url"); ?>" alt="<?php echo base_url("uploads/{$viewFolder}/$image->img_url"); ?>" class="img-responsive"></td>
                           <td><?php echo $image->img_url;?></td>
                           <td  class="w100 text-center">
                               <input
                                   data-url = "<?php echo base_url("product/isActiveSetter/"); ?>";
                                   type="checkbox"
                                   class="isActive"
                                   data-switchery="true"
                                   data-color="#10c469"
                               ?>
                            </td>

                           <td class="w100 text-center">
                               <input
                                       data-url = "<?php echo base_url("product/isActiveSetter/"); ?>";
                                       type="checkbox"
                                       class="isActive"
                                       data-switchery="true"
                                       data-color="#10c469"
                                       ?>
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

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>