<?php $settings = get_settings();?>
<meta charset="utf-8">
<title><?php echo $settings->company_name . " | " . $settings->slogan;?> </title>
<meta name="description" content="<?php echo character_limiter(strip_tags($settings->about_us), 300)?>">
<meta name="author" content="Mustafa YILDIRIM">

<!-- Mobile Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if (isset($opengraph)){?>
    <meta property="og:title" content="<?php echo $news->title;?>"/>
    <meta property="og:description" content="<?php echo character_limiter(strip_tags($news->description), 150);?>"/>
    <?php if ($news->news_type == "image"){ ?>
        <meta property="og:image" content="<?php echo get_image("news_v",$news->img_url,"513x317");?>"/>
    <?php }else{ ?>
        <meta property="og:video" content="<?php echo "$news->video_url";?>"/>
    <?php } ?>

<?php }?>

<?php $this->load->view("includes/include_style"); ?>