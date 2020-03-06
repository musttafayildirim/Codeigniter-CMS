<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("includes/head"); ?>
    <?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_style"); ?>
</head>

<body class="simple-page">
<!--============= start main area -->
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="simple-page-wrap">
        <section class="app-content">
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
        </section><!-- #dash-content -->
    </div><!-- .wrap -->
</main>
<!--========== END app main -->

<?php $this->load->view("includes/include_script"); ?>
</body>
</html>