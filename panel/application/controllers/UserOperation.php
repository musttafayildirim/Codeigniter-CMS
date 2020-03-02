<?php


class UserOperation extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
    }

    public function login()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login(){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            )
        );

        if($this->form_validation->run() == FALSE){
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = "true";

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen bilgilerinizi kontrol ediniz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);

        }
        else{
            $username = $this->user_model->get(
                array(
                    "user_name" =>  $this->input->post("user_name"),
                )
            );
            $user =  $this->user_model->get(
                array(
                    "user_name" =>  $this->input->post("user_name"),
                    "password"  => md5($this->input->post("password"))
                )
            );

                if($username) {
                        if ($user) {
                            $alert = array(
                                "title" => "İşlem başarılı",
                                "text" => "$user->full_name hoşgeldiniz",
                                "type" => "success"
                            );
                            $this->session->set_userdata("user", $user);
                            $this->session->set_flashdata("alert", $alert);
                            redirect(base_url());
                        } else {
                            $alert = array(
                                "title" => "İşlem başarısız",
                                "text" => "Lütfen şifrenizi kontrol ediniz!",
                                "type" => "error"
                            );
                            $this->session->set_flashdata("alert", $alert);
                            redirect(base_url("login"));
                            unset($_SESSION['alert']);
                        }
                }
                else{
                    $alert = array(
                        "title"   => "İşlem başarısız",
                        "text"    => "Böyle bir kullanıcı bulunamadı!",
                        "type"    => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                    unset($_SESSION['alert']);
                }
        }
    }



}