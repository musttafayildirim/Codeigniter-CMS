<?php


class Slides extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "slides_v";
        $this->load->model("slide_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->slide_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_slide()
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
          redirect(base_url("slides/new_slide"));
      }

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_rules("description", "Açıklama", "trim");

      if ($this->input->post("allowButton")){
          $this->form_validation->set_rules("button_caption", "Buton Başlığı", "required|trim");
          $this->form_validation->set_rules("button_url", "URL Bilgisi", "trim|prep_url|required");
      }

      $this->form_validation->set_message(
          array(
              "required"    => "<strong>{field}</strong> alanı doldurulmalıdır.",
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {
          $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

          $image1920x650 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 1920,650, $file_name);
          $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


          if ($image1920x650 && $image70x70 ) {

              $insert = $this->slide_model->add(
                  array(
                      "title" => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      'button_caption' => $this->input->post("button_caption"),
                      'button_url' => $this->input->post("button_url"),
                      'allowButton' => $this->input->post("allowButton") ? 1 : 0,
                      "img_url" => $file_name,
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
              redirect(base_url("slides"));

          } else {
              $alert = array(
                  "title" => "Opppss",
                  "text" => "Resim yüklenme esnasında bir problem oluştu.",
                  "type" => "error"
              );
              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("slides/new_slide"));
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
    public function update_slide($id){
        $viewData = new stdClass();

        $item = $this->slide_model->get(
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
        $this->form_validation->set_rules("description", "Açıklama", "trim");

        if ($this->input->post("allowButton")){
            $this->form_validation->set_rules("button_caption", "Buton Başlığı", "required|trim");
            $this->form_validation->set_rules("button_url", "URL Bilgisi", "trim|prep_url|required");
        }

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            if ($_FILES["img_url"]["name"] !== "") {

                $select_img = $this->slide_model->get(
                    array(
                        "id" => $id
                    )
                );

                if($select_img){
                    $paths = array(
                        $path1 = "uploads/$this->viewFolder/1920x650/$select_img->img_url",
                        $path2 = "uploads/$this->viewFolder/70x70/$select_img->img_url"
                    );

                    foreach ($paths as $path)
                        unlink($path);
                }

                $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image1920x650 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 1920,650, $file_name);
                $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


                if ($image1920x650 && $image70x70 ) {
                    $data = array(
                        "title" => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "img_url" => $file_name,
                        'button_caption' => $this->input->post("button_caption"),
                        'button_url' => $this->input->post("button_url"),
                        'allowButton' => $this->input->post("allowButton") ? 1 : 0,
                    );
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("slides/update_slides/$id"));
                }
            } else {
                $data = array(
                    "title" => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                );
            }

            $update = $this->slide_model->update(array("id" => $id), $data);

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
        redirect(base_url("slides"));
    }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->slide_model->get(
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

        $select_img = $this->slide_model->get(
            array(
                "id" => $id
            )
        );

        $delete = $this->slide_model->delete(
          array(
              "id" => $id
          )
        );

        if($select_img){

            $paths = array(
                $path1 = "uploads/$this->viewFolder/1920x650/$select_img->img_url",
                $path2 = "uploads/$this->viewFolder/70x70/$select_img->img_url",
            );

            foreach ($paths as $path)
                unlink($path);

            $delete = $this->slide_model->delete(
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
            redirect(base_url("slides"));

        }
        else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );
        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("slides"));

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->slide_model->update(
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
            $this->slide_model->update(
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
