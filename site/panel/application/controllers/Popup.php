<?php


class Popup extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "popups_v";
        $this->load->model("popup_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->popup_model->get_all(
            array()
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_popup()
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
      $this->form_validation->set_rules("description", "Açıklama", "trim|required");
      $this->form_validation->set_rules("page", "Hedef Sayfası", "required");

      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {

              $insert = $this->popup_model->add(
                  array(
                      "title" => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      "page" => $this->input->post("page"),
                      "unique_id"     => rand(),
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
              redirect(base_url("popup"));

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
    public function update_popup($id){
        $viewData = new stdClass();

        $item = $this->popup_model->get(
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
        $this->form_validation->set_rules("description", "Açıklama", "trim|required");
        $this->form_validation->set_rules("page", "Hedef Sayfası", "required");


        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $data = array(
                "title"         => $this->input->post("title"),
                "description"   => $this->input->post("description"),
                "page"          => $this->input->post("page"),
                "unique_id"     => rand()
            );
            $update = $this->popup_model->update(array("id" => $id), $data);

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
        redirect(base_url("popup"));
    }
    else{
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->form_error = "true";

        $viewData->item = $this->popup_model->get(
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

            $delete = $this->popup_model->delete(
                array(
                    "id" => $id
                )
            );

            if ($delete) {
                $alert = array(
                    "title" => "Tebrikler",
                    "text" => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                    "type" => "success"
                );
            }
            else{
                $alert = array(
                    "title"   => "İşlem başarısız",
                    "text"    => "Veritabanı hatası",
                    "type"    => "error"
                );
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("popup"));
    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->popup_model->update(
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
