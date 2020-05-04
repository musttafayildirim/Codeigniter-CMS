<?php


class User_roles extends MY_Controller

{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "user_role_v";
        $this->load->model("user_role_model");

        if(!get_active_user())
            redirect(base_url("login"));


    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->user_role_model->get_all(
            array()
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_user_role()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni referans eklenmesi
    public function save(){
      $this->load->library("form_validation");

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {

              $insert = $this->user_role_model->add(
                  array(
                      "title" => $this->input->post("title"),
                      "isActive" => true,
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
              redirect(base_url("user_roles"));
        }
    }

    //düzenlenecek sayfaya gitmek
    public function update_user_role($id){
        $viewData = new stdClass();

        $item = $this->user_role_model->get(
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
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $update = $this->user_role_model->update(array("id" => $id),
                array(
                    'title' => $this->input->post("title")
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
        redirect(base_url("user_roles"));
    }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->user_role_model->get(
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
        if (!isAllowedDeleteModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;

        $delete = $this->user_role_model->delete(
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
        redirect(base_url("user_roles"));

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->user_role_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

    public function user_permissions_form($id){
        $viewData = new stdClass();

        $item = $this->user_role_model->get(
            array(
                "id" => $id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "permission";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_permissions($id){

        $permissions = json_encode($this->input->post("permissions"));

        $update = $this->user_role_model->update(
            array(
                "id" => $id
            ),
            array(
                "permissions" => $permissions
            )
        );

        if ($update) {
            $alert = array(
                "title" => "Tebrikler",
                "text" => "Yetkilendirme başarılı bir şekilde değiştirildi.",
                "type" => "success"
            );
        } else {
            $alert = array(
                "title" => "İşlem başarısız",
                "text" => "Lütfen tekrar deneyiniz Yetkilendirme esnasında bir problem oluştu.",
                "type" => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("user_roles/user_permissions_form/$id"));
    }


}
