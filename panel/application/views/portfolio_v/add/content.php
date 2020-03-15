<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    Yeni Portfolyo Ekle
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">

            <div class="widget-body">
                            <form action="<?php echo base_url("portfolio/save"); ?>" method="post">

                                <div class="row col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>Başlık</label>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Başlık"
                                               name="title"
                                               value="<?php echo isset($form_error) ? set_value("title") : ""?> "
                                        >
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"><?php echo form_error( "title");?></small>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="control-demo-6">Kategori Seçimi</label>
                                        <div id="control-demo-6">
                                            <select class="form-control" name="category_id">
                                                <?php foreach ($categories as $category){ ?>
                                                    <?php $category_id = isset($form_error) ? set_value("category_id") : ""?>
                                                    <option
                                                            <?php echo $category->id === $category_id ? "selected" : ""?>
                                                            value="<?php echo $category->id;?>"><?php echo $category->title;?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php if(isset($form_error)){ ?>
                                                <small class="pull-right input-form-error"><?php echo form_error( "category_id");?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="row col-md-6">
                                        <div class="form-group col-md-12">
                                            <label >Müşteri</label>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="Müşteriye ait ismi yazınız."
                                                   name="client"
                                                   value="<?php echo isset($form_error) ? set_value("client") : ""?> "
                                            >
                                            <?php if(isset($form_error)){ ?>
                                                <small class="pull-right input-form-error"><?php echo form_error( "client");?></small>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label >Mekan</label>
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="İşin yapıldığı yeri yazınız."
                                                   name="place"
                                                   value="<?php echo isset($form_error) ? set_value("place") : ""?> "
                                            >
                                            <?php if(isset($form_error)){ ?>
                                                <small class="pull-right input-form-error"><?php echo form_error( "place");?></small>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label >İşe ait bağlantı</label>
                                            <input type="url"
                                                   class="form-control"
                                                   placeholder="Yapılan işe ait URL bağlantısını buraya ekleyiniz."
                                                   name="portfolio_url"
                                                   value="<?php echo isset($form_error) ? set_value("portfolio_url") : ""?> "
                                            >
                                            <?php if(isset($form_error)){ ?>
                                                <small class="pull-right input-form-error"><?php echo form_error( "portfolio_url");?></small>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row col-md-6">
                                        <div class="col-md-12">
                                            <label for="datetimepicker1">Proje Teslim Tarihi</label>
                                            <input type="hidden"
                                                   name="finishedAt"
                                                   id="datetimepicker1"
                                                   data-plugin="datetimepicker"
                                                   data-options="{ inline: true,
                                                   viewMode: 'days',
                                                   format: 'YYYY:MM:DD HH:mm:ss'}"
                                                    value="<?php echo isset($form_error) ? set_value("finishedAt") : ""?>"
                                            />
                                        </div><!-- END column -->
                                    </div>
                                </div>

                                <div class="row col-md-12">
                                    <div class="form-group col-md-12">
                                        <label >Açıklama</label>
                                        <textarea name="description"
                                                  class="m-0"
                                                  data-plugin="summernote"
                                                  data-options="{height: 250}" style="display: none;">
                                                  <?php echo isset($form_error) ? set_value("description") : ""?>
                                        </textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Kaydet</button>
                                <a href="<?php echo base_url("portfolio"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                            </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->

</div>