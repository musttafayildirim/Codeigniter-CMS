<?php


class Users extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->user_model->get_all(
            array()
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_user()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni ürünün eklenmesi
    public function save(){
      $this->load->library("form_validation");

      $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
      $this->form_validation->set_rules("full_name", "Adı Soyadı", "trim");
      $this->form_validation->set_rules("email", "E-Posta Adresi", "required|trim|valid_email|is_unique[users.email]");
      $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[12]");

      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
              "is_unique" => "<strong>{field}</strong> bu alan benzersiz olmalıdır.",
              "valid_email" => "Lütfen geçerli bir mail adresi giriniz.",
              "min_length" => "Şifreniz en az 6 karakter ile oluşturulabilir.",
              "max_length" => "Şifreniz en fazla 12 karakter ile oluşturulabilir."
          )
      );

      $validate = $this->form_validation->run();

      if ($validate){
          $insert = $this->user_model->add(
              array(
                  "user_name" => $this->input->post("user_name"),
                  "full_name" => $this->input->post("full_name"),
                  "email"     => $this->input->post("email"),
                  "password"  => md5($this->input->post("password")),
                  "isActive"  => true,
                  "createdAt" => date("Y-m-d H:i:s")
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
          redirect(base_url("users"));
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
    public function update_user($id){
        $viewData = new stdClass();

        $item = $this->user_model->get(
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

        $oldUser = $this->user_model->get(
            array(
                "id" => $id
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

        if ($validate) {

            $update = $this->user_model->update(
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
            redirect(base_url("users"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->user_model->get(
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

        $item = $this->user_model->get(
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

            $update = $this->user_model->update(
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
            redirect(base_url("users"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = "true";

            $viewData->item = $this->user_model->get(
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
        
        $delete = $this->user_model->delete(
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
        redirect(base_url("users"));

    }

    public function isActiveSetter($id)
    {

        if ($id) {

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->user_model->update(
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
