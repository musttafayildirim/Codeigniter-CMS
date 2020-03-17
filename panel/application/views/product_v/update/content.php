<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <?php echo $item->title;?> Kayıtlı Ürün Güncelleniyor
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("product/update/$item->id"); ?>" method="post">
                                <div class="form-group">
                                    <label >Başlık</label>
                                    <input type="text"
                                           class="form-control"
                                           placeholder="Başlık"
                                           name="title"
                                           value="<?php echo isset($form_error) ? set_value("title") : $item->title;?>">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label >Açıklama</label>
                                    <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}" style="display: none;">
                                        <?php echo isset($form_error) ? set_value("description") : $item->description;?>
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                                <a href="<?php echo base_url("product"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>