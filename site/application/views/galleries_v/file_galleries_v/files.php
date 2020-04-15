<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title"><?php echo $gallery->title ?></h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <div class="row">

                    <?php if ($items){?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Dosya Adı</th>
                                <th class="text-center">İndir</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item){ ?>
                                    <tr>
                                        <td style="width: 50px"><?php echo $item->id?></td>
                                        <td><?php echo $item->url?></td>
                                        <td style="width: 50px">
                                            <a target="_blank" href="<?php echo base_url("panel/uploads/galleries_v/files/$gallery->folder_name/$item->url");?>" class="btn btn-animated btn-default-transparent">İndir <i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <div class="col-md-12 alert  alert-icon alert-info" role="alert">
                            <i class="fa fa-info-circle"></i>
                            Burada hiçbir video galerisi bulunmamaktadır.
                        </div>
                    <?php } ?>

                </div>


            </div>
        </div>
    </div>
</section>

