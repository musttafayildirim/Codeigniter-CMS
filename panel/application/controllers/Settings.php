<?php


class Settings extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "settings_v";
        $this->load->model("setting_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $item = $this->setting_model->get();

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        if ($item)
            $viewData->subViewFolder = "update";
        else
            $viewData->subViewFolder = "no_content";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_setting()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }


    public function save(){
        $this->load->library("form_validation");

        if($_FILES["logo"]["name"] == ""){

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen bir resim ekleyiniz!",
                "type"    => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings/new_setting"));
        }

        $this->form_validation->set_rules("company_name", "Şirket İsmi", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules('phone_1', 'Birinci Telefon', 'required|trim|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules("facebook", "Facebook", "trim|prep_url");
        $this->form_validation->set_rules("twitter", "Twitter", "trim|prep_url");
        $this->form_validation->set_rules("linkedin", "LinkedIn", "trim|prep_url");
        $this->form_validation->set_rules("instagram", "Instagram", "trim|prep_url");

        $this->form_validation->set_message(
            array(
                "required"      => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "valid_email"   => "Lütfen geçerli bir {field} giriniz.",
                "regex_match"   => "Telefon numaranızı (5324567896) şeklinde giriniz.",
                "valid_url"     => "Lüften geçerli bir {field} alanı giriniz."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate) {

            $file_name = converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"] = "uploads/$this->viewFolder/";
            $config["file_name"] = $file_name;

            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("logo");

            if ($upload) {

                $uploaded_file = $this->upload->data("file_name");

                $insert = $this->setting_model->add(
                    array(
                        "company_name"  => $this->input->post("company_name"),
                        "about_us"      => $this->input->post("about"),
                        "mission"       => $this->input->post("mission"),
                        "vision"        => $this->input->post("vision"),
                        "phone_1"       => $this->input->post("phone_1"),
                        "phone_2"       => $this->input->post("phone_2"),
                        "fax_1"         => $this->input->post("fax_1"),
                        "fax_2"         => $this->input->post("fax_2"),
                        "email"         => $this->input->post("email"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "linkedin"      => $this->input->post("linkedin"),
                        "logo"          => $uploaded_file,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )

                );

                if ($insert) {
                    $alert = array(
                        "title" => "Tebrikler",
                        "text" => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                        "type" => "success"
                    );
                } else {
                    $alert = array(
                        "title" => "İşlem başarısız",
                        "text" => "Lütfen zorunlu olan alanları doldurunuz!",
                        "type" => "error"
                    );
                }

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("settings"));

            } else {
                $alert = array(
                    "title" => "Opppss",
                    "text" => "Resim yüklenme esnasında bir problem oluştu.",
                    "type" => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("settings/new_setting"));
            }
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = "true";

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);
        }
    }

    //düzenlenecek sayfaya gitmek
    public function update_setting($id){
        $viewData = new stdClass();

        $item = $this->setting_model->get(
            array(
                "id" => $id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id){
        $this->load->library("form_validation");

        $oldUser = $this->setting_model->get(
            array(
                "id" => $id
            )
        );

        if ($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[settings.user_name]");
        }
        if ($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[settings.email]");
        }

        $this->form_validation->set_rules("full_name", "Ad Soyad", "trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "is_unique" => "<strong>{field}</strong> bu alan benzersiz olmalıdır.",
                "valid_email" => "Lütfen geçerli bir mail adresi giriniz.",
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $update = $this->setting_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "user_name" => $this->input->post("user_name"),
                    "full_name" => $this->input->post("full_name"),
                    "email"     => $this->input->post("email")
                )
            );

            if ($update) {
                $alert = array(
                    "title" => "Tebrikler",
                    "text" => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text" => "Lütfen zorunlu olan alanları doldurunuz!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->setting_model->get(
                array(
                    "id" => $id
                )
            );

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);
        }
    }

    public function update_password_form($id){
        $viewData = new stdClass();

        $item = $this->setting_model->get(
            array(
                "id" => $id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update_password($id){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[12]");
        $this->form_validation->set_rules("re-password", "Şifre Doğrulama", "required|trim|min_length[6]|max_length[12]|matches[password]");

        $this->form_validation->set_message(
            array(
                "required"      => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "min_length"    => "Şifreniz en az 6 karakter ile oluşturulabilir.",
                "max_length"    => "Şifreniz en fazla 12 karakter ile oluşturulabilir.",
                "matches"       => "Şifreler birbirleri ile uyuşmuyor."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $update = $this->setting_model->update(
                array(
                    "id" => $id
                ),
                array(
                   "password" => md5($this->input->post("password"))
                )
            );

            if ($update) {
                $alert = array(
                    "title" => "Tebrikler",
                    "text" => "Şifre başarılı bir şekilde değiştirildi.",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text" => "Lütfen verilen uyarılara göre şifrenizi tekrar giriniz.",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = "true";

            $viewData->item = $this->setting_model->get(
                array(
                    "id" => $id
                )
            );

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen verilen uyarılara göre şifrenizi tekrar giriniz.",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);
        }
    }

    public function delete($id){
        
        $delete = $this->setting_model->delete(
          array(
              "id" => $id
          )
        );

        if($delete){
            $alert = array(
                "title"   => "Tebrikler",
                "text"    => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                "type"    => "success"
            );
        }
        else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("settings"));

    }

    public function isActiveSetter($id)
    {

        if ($id) {

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->setting_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

}
