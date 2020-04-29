<?php

function converToSEO($text){
    $turkce     = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", " ", "?", "_", "!", "'", "+", "%", "&", "/", "(", ")", "=");
    $convert    = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

    return strtolower(str_replace($turkce, $convert, $text));
}


function get_readable_date($time){
    return strftime('%e %B %Y', strtotime($time));
}

function get_active_user(){
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if($user)
        return $user;
    else
        return false;
}

function send_email($toEmail="", $subject="", $message=""){
    $t = get_instance();
    $t->load->model("email_model");
    $email = $t->email_model->get(
        array(
            "isActive" =>1
        )
    );
    $config = array(
        'protocol'      => $email->protocol,
        "smtp_host"     => $email->host,
        "smtp_port"     => $email->port,
        "smtp_user"     => $email->user,
        "smtp_pass"     => $email->password,
        "starttls"      => true,
        "charset"       => "utf-8",
        "mailtype"      => "html",
        "wordwrap"      => true,
        "newline"       => "\r\n"
    );
    $t->load->library('email', $config);
    $t->email->from($email->from);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);
    return $t->email->send();
}

function get_settings(){

    $t = &get_instance();
    $t->load->model("setting_model");

    if ($t->session->userdata("settings")){
        $settings = $t->session->userdata("settings");
    }
    else{
        $settings = $t->setting_model->get();
        if (!$settings){
            $settings = new  stdClass();
            $settings->company_name = "NULL";
            $settings->logo         = "default";
        }
        $t->session->set_userdata("settings", $settings);
    }
    return $settings;
}

function get_category_title($category_id = 0){
    $t = &get_instance();
    $t->load->model("portfolio_category_model");

    $category = $t->portfolio_category_model->get(
        array(
            "id"  => $category_id
        )
    );
    if ($category)
        return $category->title;
    else
        return "<b style='color: #681313'>Tanımlanmayan Kategori</b>";
}

function upload_image($file, $uploadPath, $width, $height, $name){

    $t = get_instance();
    $t->load->library("simpleimagelib");

    if(!is_dir("{$uploadPath}/{$width}x{$height}")){
        mkdir("{$uploadPath}/{$width}x{$height}");
    }

    $upload_error = false;
    try {
        // Create a new SimpleImage object
        $simpleImage = $t->simpleimagelib->get_simple_image_instance();

        // Magic! ✨
        $simpleImage
            ->fromFile($file)
            ->thumbnail($width, $height, 'center')
            ->toFile("{$uploadPath}/{$width}x{$height}/$name", null, 75);

        // And much more! 💪
    } catch(Exception $err) {
        // Handle errors
        $error =  $err->getMessage();
        $upload_error = true;
    }
    if ($upload_error){
        echo $error;
    }
    else{
        return true;
    }
}

function get_image($path = "", $image = "", $resolution = "50x50"){
    if ($image != ""){
        if(file_exists(FCPATH . "uploads/$path/$resolution/$image")){
            $image = base_url("uploads/$path/$resolution/$image");
        }else{
            $image = base_url("assets/assets/images/default_image.png");
        }

    }else{
       $image = base_url("assets/assets/images/default_image.png");
    }
    return $image;
}

function get_page_list($page = ""){

    $page_list = array(
        "home_v"            => "Anasayfa",
        "about_v"           => "Hakkımızda Sayfası",
        "brand_list_v"      => "Markalar Sayfası",
        "contact_list_v"    => "İletişim Sayfası",
        "course_list_v"     => "Eğitimler Listesi",
        "news_list_v"       => "Haberler Sayfası",
        "portfolio_list_v"  => "Portfolyo Sayfası",
        "product_list_v"    => "Ürünler Sayfası",
        "reference_list_v"  => "Referanslar Sayfası",
        "service_list_v"    => "Servisler Sayfası",
        "gallery"           =>"galeri için yapılacak",
    );

    return (empty($page)) ? $page_list : $page_list[$page];

}

