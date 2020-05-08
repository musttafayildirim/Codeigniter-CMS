<?php $settings = get_settings();?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="<?php echo character_limiter(strip_tags($settings->about_us), 300)?>" />
<link rel="shortcut icon" sizes="196x196" href="<?php echo get_image("settings_v",$settings->favicon,"32x32"); ?>">
<title><?php echo $settings->company_name?> | CMS</title>

<?php $this -> load -> view("includes/include_style.php"); ?>

