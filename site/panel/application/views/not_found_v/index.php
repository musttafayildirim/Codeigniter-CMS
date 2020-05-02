<?php $settings = get_settings();?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("includes/head"); ?>
</head>

<body class="simple-page">
<div id="back-to-home">
    <a href="<?php echo base_url();?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="<?php echo base_url();?>">
            <span><i class="fa fa-gg"></i></span>
            <span><?php echo $settings->company_name;?></span>
        </a>
    </div><!-- logo -->
    <h1 id="_404_title" class="animated shake">404</h1>
    <h5 id="_404_msg" class="animated slideInUp">Oops, bir hata oluştu. Böyle bir sayfa bulunmuyor!</h5>

</div><!-- .simple-page-wrap -->
</body>
</html>