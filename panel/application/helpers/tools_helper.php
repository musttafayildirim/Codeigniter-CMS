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