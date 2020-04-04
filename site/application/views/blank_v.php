<!DOCTYPE html>
<!--[if IE 9]> <html lang="zxx" class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html lang="zxx" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html dir="ltr" lang="tr">
<!--<![endif]-->
<?php $this->load->view("includes/head");?>

<!-- body classes:  -->
<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
<!-- "gradient-background-header": applies gradient background to header -->
<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
<body class="front-page">

<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">
    <!--    Header sayfası eklendi-->
    <?php $this->load->view('includes/header');?>

    <div id="page-start"></div>

    <?php $this->load->view("{$viewFolder}/content");?>

    <!--Footer sayfası eklendi-->
    <?php $this->load->view('includes/footer');?>

</div>
<!-- page-wrapper end -->

<?php $this->load->view('includes/include_script') ?>
</body>
</html>
