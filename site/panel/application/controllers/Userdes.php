<?php


class Userdes extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "userdes_v";
        $this->load->model("user_model");
        $this->load->model("user_role_model");

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

        $viewData->user_roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update()
    {
        $this->load->library("form_validation");
        $user = get_active_user();
        $oldUser = $this->user_model->get(
            array(
                "id" => $user->id
            )
        );

        if ($oldUser->user_name != $this->input->post("user_name")){
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        }
        if ($oldUser->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[users.email]");
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

        if($validate){
            if ($_FILES["img_url"]["name"] !== "") {

                $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);

                if ($image70x70) {
                    $data = array(
                        "user_name"     => $this->input->post("user_name"),
                        "full_name"     => $this->input->post("full_name"),
                        "email"         => $this->input->post("email"),
                        "img_url"       => $file_name,
                    );
                }else{
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("kullanici-guncelleme"));
                }
            }else{
                $data = array(
                    "user_name"     => $this->input->post("user_name"),
                    "full_name"     => $this->input->post("full_name"),
                    "email"         => $this->input->post("email")
                );
            }
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
            redirect(base_url("kullanici-guncelleme"));
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
