<?php


class Email extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "emails_v";
        $this->load->model("email_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->email_model->get_all(
            array()
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_email()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni ürünün eklenmesi
    public function save(){
      $this->load->library("form_validation");

      $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
      $this->form_validation->set_rules("protocol", "Protokol", "required|trim");
      $this->form_validation->set_rules("host", "Host", "required|trim");
      $this->form_validation->set_rules("port", "Port", "required|trim");
      $this->form_validation->set_rules("user", "Kullanıcı Adı", "required|trim");
      $this->form_validation->set_rules("password", "E-Posta Adresi", "required|trim");
      $this->form_validation->set_rules("from", "E-Posta Adresi (from)", "required|trim");
      $this->form_validation->set_rules("to", "E-Posta Adresi (to)", "required|trim");

      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
              "valid_email" => "Lütfen geçerli bir mail adresi giriniz.",
          )
      );

      $validate = $this->form_validation->run();

      if ($validate){
          $insert = $this->email_model->add(
              array(
                  "user_name"   => $this->input->post("user_name"),
                  "to"          => $this->input->post("to"),
                  "from"        => $this->input->post("from"),
                  "user"        => $this->input->post("user"),
                  "port"        => $this->input->post("port"),
                  "host"        => $this->input->post("host"),
                  "protocol"    => $this->input->post("protocol"),
                  "password"    => $this->input->post("password"),
                  "isActive"    => true,
                  "createdAt"   => date("Y-m-d H:i:s")
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
          redirect(base_url("email"));
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
    public function update_email($id){
        $viewData = new stdClass();

        $item = $this->email_model->get(
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

        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("protocol", "Protokol", "required|trim");
        $this->form_validation->set_rules("host", "Host", "required|trim");
        $this->form_validation->set_rules("port", "Port", "required|trim");
        $this->form_validation->set_rules("user", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("password", "E-Posta Adresi", "required|trim");
        $this->form_validation->set_rules("from", "E-Posta Adresi (from)", "required|trim");
        $this->form_validation->set_rules("to", "E-Posta Adresi (to)", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "valid_email" => "Lütfen geçerli bir mail adresi giriniz.",
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $update = $this->email_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "user_name"   => $this->input->post("user_name"),
                    "to"          => $this->input->post("to"),
                    "from"        => $this->input->post("from"),
                    "user"        => $this->input->post("user"),
                    "port"        => $this->input->post("port"),
                    "host"        => $this->input->post("host"),
                    "protocol"    => $this->input->post("protocol"),
                    "password"    => $this->input->post("password"),
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
            redirect(base_url("email"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->email_model->get(
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


    public function delete($id){
        
        $delete = $this->email_model->delete(
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
        redirect(base_url("email"));

    }

    public function isActiveSetter($id)
    {

        if ($id) {

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->email_model->update(
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
