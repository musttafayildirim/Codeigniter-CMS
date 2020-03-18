<!DOCTYPE html>
<!--[if IE 9]> <html lang="tr" class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html lang="tr" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html dir="ltr" lang="tr">

<head>
<?php $this->load->view("includes/head");?>
</head>

<body class="front-page page-loader-5 no-trans">
<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">
    <?php $this->load->view("includes/header"); ?>
    <div id="page-start"></div>


    <?php $this->load->view("includes/footer") ;?>
</div>
<!-- page-wrapper end -->
<?php $this->load->view("includes/include_script") ?>
</body>
</html>
