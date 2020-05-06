<?php


class Userpass extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "userpass_v";
        $this->load->model("user_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        $user = get_active_user();

        $item = $this->user_model->get(
            array(
                "id" => $user->id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update()
    {
        $this->load->library("form_validation");
        $user = get_active_user();

        $this->form_validation->set_rules("current_password",    "Mevcut Şifre", "required|trim");
        $this->form_validation->set_rules("update_password",     "Güncel Şifre", "required|trim");
        $this->form_validation->set_rules("update_password_rep", "Güncel Şifre Tekrarı", "required|trim|matches[update_password]");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "matches"  => "Girilen şifreler uyuşmuyor."
            )
        );

        $validate = $this->form_validation->run();

        if($validate){

            if (md5($this->input->post("current_password")) != $user->password){
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text"  => "Şifreyi yanlış girdiniz.",
                    "type"  => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("kullanici-sifre"));
            }


            $data = array(
                "password"  => md5($this->input->post("update_password")),
            );

            $update = $this->user_model->update(array("id" => $user->id), $data);

            if ($update){
                $alert = array(
                    "title" => "Tebrikler",
                    "text" => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                    "type" => "success"
                );
            }else{
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text" => "Lütfen zorunlu olan alanları doldurunuz!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("kullanici-sifre"));
        }else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "list";
            $viewData->form_error = "true";

            $viewData->item = $this->user_model->get(
                array(
                    "id" => $user->id
                )
            );

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen bilgileri kontrol ediniz.",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);
        }
    }
}
