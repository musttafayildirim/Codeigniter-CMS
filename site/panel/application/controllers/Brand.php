<?php


class Brand extends MY_Controller

{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "brand_v";
        $this->load->model("brand_model");

        if(!get_active_user())
            redirect(base_url("login"));


    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->brand_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_brand()
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
          redirect(base_url("brand/new_brand"));
      }

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {

          $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

          $image350x216 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 350,216, $file_name);
          $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


          if ($image350x216 && $image70x70) {

              $insert = $this->brand_model->add(
                  array(
                      "title" => $this->input->post("title"),
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
              redirect(base_url("brand"));

          } else {
              $alert = array(
                  "title" => "Opppss",
                  "text" => "Resim yüklenme esnasında bir problem oluştu.",
                  "type" => "error"
              );
              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("brand/new_brand"));
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
    public function update_brand($id){
        $viewData = new stdClass();

        $item = $this->brand_model->get(
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

                $brand = $this->brand_model->get(
                    array(
                        "id" => $id
                    )
                );

                if($brand){
                    $paths = array(
                        $path1 = "uploads/$this->viewFolder/350x216/$brand->img_url",
                        $path2 = "uploads/$this->viewFolder/70x70/$brand->img_url",
                    );

                    foreach ($paths as $path)
                        $delete_img = unlink($path);

                    if(!$delete_img){
                        $alert = array(
                            "title"   => "İşlem başarısız",
                            "text"    => "Fotoğraf silinirken bir sorunla karşılaşıldı.",
                            "type"    => "error"
                        );

                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("brand/update_brand/$id"));

                    }
                }

                $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image350x216 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 350,216, $file_name);
                $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


                if ($image350x216 && $image70x70) {

                    $data = array(
                        "title" => $this->input->post("title"),
                        "img_url" => $file_name,
                    );
                } else {
                    $alert = array(
                        "title" => "Opppss",
                        "text" => "Resim yüklenme esnasında bir problem oluştu.",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("brand/update_brand/$id"));
                }
            } else {
                $data = array(
                    "title" => $this->input->post("title")
                );
            }

            $update = $this->brand_model->update(array("id" => $id), $data);

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
        redirect(base_url("brand"));
    }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->brand_model->get(
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

        $brand = $this->brand_model->get(
            array(
                "id" => $id
            )
        );

        if($brand){
            $paths = array(
                $path1 = "uploads/$this->viewFolder/350x216/$brand->img_url",
                $path2 = "uploads/$this->viewFolder/70x70/$brand->img_url",
            );

            foreach ($paths as $path)
                $delete_img = unlink($path);

            if(!$delete_img) {
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text" => "Dosya yolu doğru değil veya böyle bir resim yok",
                    "type" => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("brand"));
            }else{
                $delete = $this->brand_model->delete(
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
                redirect(base_url("brand"));
            }
        }
        else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Veri tabanında bu habere ait bir resim yok",
                "type"    => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("brand"));
    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->brand_model->update(
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
            $this->brand_model->update(
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
