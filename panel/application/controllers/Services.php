<?php


class Services extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "services_v";
        $this->load->model("service_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->service_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_service()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni referans eklenmesi
    public function save(){
      $this->load->library("form_validation");

      if($_FILES["img_url"]["name"] == ""){

          $alert = array(
              "title"   => "İşlem başarısız",
              "text"    => "Lütfen bir resim ekleyiniz!",
              "type"    => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("services/new_service"));
      }

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {

          $file_name = converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
          $config["allowed_types"] = "jpg|jpeg|png";
          $config["upload_path"] = "uploads/$this->viewFolder/";
          $config["file_name"] = $file_name;

          $this->load->library("upload", $config);
          $upload = $this->upload->do_upload("img_url");

          if ($upload) {

              $uploaded_file = $this->upload->data("file_name");

              $insert = $this->service_model->add(
                  array(
                      "url" => converToSEO($this->input->post("title")),
                      "title" => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      "img_url" => $uploaded_file,
                      "rank" => 0,
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
              redirect(base_url("services"));

          } else {
              $alert = array(
                  "title" => "Opppss",
                  "text" => "Resim yüklenme esnasında bir problem oluştu.",
                  "type" => "error"
              );
              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("services/new_services"));
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
    public function update_service($id){
        $viewData = new stdClass();

        $item = $this->service_model->get(
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

            if ($_FILES["img_url"]["name"] !== "") {
                $file_name = converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("img_url");

                if ($upload) {
                    $uploaded_file = $this->upload->data("file_name");
                    $data = array(
                        "url" => converToSEO($this->input->post("title")),
                        "title" => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "img_url" => $uploaded_file,
                    );
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("services/update_services/$id"));
                }
            } else {
                $data = array(
                    "url" => converToSEO($this->input->post("title")),
                    "title" => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                );
            }

            $update = $this->service_model->update(array("id" => $id), $data);

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
        redirect(base_url("services"));
    }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->service_model->get(
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
        
        $delete = $this->service_model->delete(
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
        redirect(base_url("services"));

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->service_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

    public function rankSetter(){
        $data = $this->input->post("data");

        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id){
            $this->service_model->update(
                array(
                    "id"        =>  $id,
                    "rank !="   =>  $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

}
