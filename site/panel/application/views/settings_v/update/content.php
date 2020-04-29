<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">
                    <?php echo $item->company_name;?> Güncelleniyor
                </h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("settings/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="m-b-lg nav-tabs-horizontal">
                                    <!-- tabs list -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab" aria-expanded="true">Site Bilgileri</a></li>
                                        <li role="presentation" class=""><a href="#tab-7" aria-controls="tab-7" role="tab" data-toggle="tab" aria-expanded="false">Adres Bilgisi</a></li>
                                        <li role="presentation" class=""><a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab" aria-expanded="false">Hakkımızda</a></li>
                                        <li role="presentation" class=""><a href="#tab-3" aria-controls="tab-2" role="tab" data-toggle="tab" aria-expanded="false">Vizyonumuz</a></li>
                                        <li role="presentation" class=""><a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab" aria-expanded="false">Misyonumuz</a></li>
                                        <li role="presentation" class=""><a href="#tab-5" aria-controls="tab-5" role="tab" data-toggle="tab" aria-expanded="false">Sosyal Medya</a></li>
                                        <li role="presentation" class=""><a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab" aria-expanded="false">Logo</a></li>
                                    </ul><!-- .nav-tabs -->
                                    <!-- Tab panes -->
                                    <div class="tab-content p-md">
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_info");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/address");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/about");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/vision");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/mission");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/social_media");?>
                                        <?php $this->load->view("$viewFolder/$subViewFolder/tabs/logo");?>
                                    </div><!-- .tab-content  -->
                                </div><!-- .nav-tabs-horizontal -->
                            </div><!-- .widget -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline"><i class="fa fa-save"></i> Güncelle</button>
                    <a href="<?php echo base_url("settings"); ?>" class="btn btn-danger btn-md"><i class="fa fa-close"></i> İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>