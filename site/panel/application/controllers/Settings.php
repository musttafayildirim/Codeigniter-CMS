<?php


class Settings extends MY_Controller
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
        if (!isAllowedAddModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save(){
        if (!isAllowedAddModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
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

        if($_FILES["mobile_logo"]["name"] == ""){

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen bir resim ekleyiniz!",
                "type"    => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("settings/new_setting"));
        }

        if($_FILES["favicon"]["name"] == ""){

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

            $logo_file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
            $mobile_logo_file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["mobile_logo"]["name"], PATHINFO_EXTENSION);
            $favicon_file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["favicon"]["name"], PATHINFO_EXTENSION);

            $image150x35 = upload_image($_FILES["logo"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $logo_file_name);
            $mobil_image150x35 = upload_image($_FILES["mobile_logo"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $mobile_logo_file_name);
            $image32x32 = upload_image($_FILES["favicon"]["tmp_name"], "uploads/$this->viewFolder/", 32,32, $favicon_file_name);


            if ($image150x35 && $image32x32 && $mobil_image150x35) {

                $insert = $this->setting_model->add(
                    array(
                        "company_name"  => $this->input->post("company_name"),
                        "about_us"      => $this->input->post("about"),
                        "mission"       => $this->input->post("mission"),
                        "address"       => $this->input->post("address"),
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
                        "logo"          => $logo_file_name,
                        "mobile_logo"   => $mobile_logo_file_name,
                        "favicon"       => $favicon_file_name,
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
    public function update_setting($id){
        if (!isAllowedUpdateModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
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
    public function update($id)
    {
        if (!isAllowedUpdateModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
        $this->load->library("form_validation");

        $this->form_validation->set_rules("company_name", "Şirket İsmi", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules('phone_1', 'Birinci Telefon', 'required|trim|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules("facebook", "Facebook", "trim|prep_url");
        $this->form_validation->set_rules("about", "Hakkımızda", "trim");
        $this->form_validation->set_rules("address", "Adres Bilgisi", "trim");
        $this->form_validation->set_rules("mission", "Misyon Bilgisi", "trim");
        $this->form_validation->set_rules("vision", "Vizyon Bilgisi", "trim");
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

            $data = array(
                "company_name"  => $this->input->post("company_name"),
                "about_us"      => $this->input->post("about"),
                "mission"       => $this->input->post("mission"),
                "address"       => $this->input->post("address"),
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
                "updatedAt"     => date("Y-m-d H:i:s")
            );

            if ($_FILES["logo"]["name"] !== "") {

                $delete_image = $this->setting_model->get(
                  array(
                      "id" => $id
                  )
                );

               unlink("uploads/$this->viewFolder/150x35/$delete_image->logo");

               $file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

                $image150x35 = upload_image($_FILES["logo"]["tmp_name"], "uploads/$this->viewFolder/", 150,35, $file_name);

                if ($image150x35) {
                    $data["logo"] = $file_name;
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("settings/update_setting/$id"));
                }
            }

            if ($_FILES["mobile_logo"]["name"] !== "") {

                $delete_image = $this->setting_model->get(
                    array(
                        "id" => $id
                    )
                );

                unlink("uploads/$this->viewFolder/150x35/$delete_image->mobile_logo");

                $file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["mobile_logo"]["name"], PATHINFO_EXTENSION);

                $image150x35 = upload_image($_FILES["mobile_logo"]["tmp_name"], "uploads/$this->viewFolder/", 150,35, $file_name);

                if ($image150x35) {
                    $data["mobile_logo"] = $file_name;
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("settings/update_setting/$id"));
                }
            }

            if ($_FILES["favicon"]["name"] !== "") {

                $delete_image = $this->setting_model->get(
                    array(
                        "id" => $id
                    )
                );

                unlink("uploads/$this->viewFolder/150x35/$delete_image->favicon");

                $file_name = rand().rand().converToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["favicon"]["name"], PATHINFO_EXTENSION);

                $image32x32 = upload_image($_FILES["favicon"]["tmp_name"], "uploads/$this->viewFolder/", 32,32, $file_name);

                if ($image32x32) {
                    $data["favicon"] = $file_name;
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("settings/update_setting/$id"));
                }
            }

            $update = $this->setting_model->update(array("id" => $id), $data);

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

            $settings = $this->setting_model->get();
            $this->session->set_userdata("settings", $settings);
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
}
