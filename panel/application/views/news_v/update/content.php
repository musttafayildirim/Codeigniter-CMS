<div class="row">

<div class="col-md-12">
    <div class="widget">
        <header class="widget-header">
            <h4 class="widget-title">
                <?php echo $item->title;?> Kayıtlı Haber Güncelleniyor
            </h4>
        </header><!-- .widget-header -->
        <hr class="widget-separator">

        <div class="widget-body">
            <form action="<?php echo base_url("news/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label >Başlık</label>
                    <input type="text" class="form-control"  placeholder="Başlık" name="title" value="<?php echo isset($form_error) ? set_value("title") : $item->title; ?>">
                    <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label >Açıklama</label>
                    <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;">
                       <?php echo isset($form_error) ? set_value("description") : $item->description; ?>
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="control-demo-6">Haberin Türü</label>
                    <div id="control-demo-6">
                        <select class="form-control news_type_select" name="news_type">
                            <?php if (isset($form_error)) { ?>
                                <option <?php echo ($news_type === "image") ? "selected" : "" ?> value="image">Resim</option>
                                <option <?php echo ($news_type === "video") ? "selected" : "" ?> value="video">Video</option>
                                <?php
                            } else {
                                ?>
                                <option <?php echo ($item->news_type === "image") ? "selected" : "" ?> value="image">Resim</option>
                                <option <?php echo ($item->news_type === "video") ? "selected" : "" ?> value="video">Video</option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <?php if(isset($form_error)) {?>
<!--                        Resim veya video güncelleneceği zaman bir problem oluşmuşsa gösterilecek olan yapı..-->
                    <div class="form-group image_upload_container"
                         style="display: <?php echo ($news_type === "image") ? "block" : "none" ?>">
                        <label>File input</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>

                    <div class="form-group video_url_container"
                         style="display: <?php echo ($news_type === "video") ? "block" : "none" ?>">
                        <label >Video</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Video bağlantınızı buraya ekleyebilirsiniz."
                               name="video_url"
                               value="<?php echo isset($form_error) ? set_value("video_url") : $item->video_url; ?>"
                        >
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"><?php echo form_error( "video_url");?></small>
                        <?php } ?>
                    </div>

                <?php } else {?>
<!-- Resim güncelleneceği zaman başarılı bir şekilde gelmişse resmi bize gösterip güncelleme işleminin yapıldığı alan...-->
                    <div class="row image_upload_container">
                        <div class="form-group col-md-11 image_upload_container"
                             style="display: <?php echo ($item->news_type === "image") ? "block" : "none" ?>">
                            <label>File input</label>
                            <input
                                    type="file"
                                    name="img_url"
                                    class="form-control">
                        </div>

                        <div class="form-group col-md-1 img-responsive img-fluid">
                            <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>"
                                 alt="">
                        </div>

                    </div>

<!--                        Video bağlantısının görüntüleneceği yer...-->
                    <div class="form-group video_url_container" style="display: <?php echo ($item->news_type === "video") ? "block" : "none" ?>">
                        <label >Video</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Video bağlantınızı buraya ekleyebilirsiniz."
                               name="video_url"
                               value="<?php echo isset($form_error) ? set_value("video_url") : $item->video_url; ?>"
                        >
                    </div>

                <?php } ?>
                <hr class="widget-separator">
                <br>
                <div class="row container-fluid">
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url("news"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </div>


            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->

</div>