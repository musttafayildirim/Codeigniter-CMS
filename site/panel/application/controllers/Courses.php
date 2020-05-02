<?php

class courses extends MY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "courses_v";
        $this->load->model("course_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->course_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_course()
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
          redirect(base_url("courses/new_course"));
      }

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");
      $this->form_validation->set_rules("description", "Açıklama", "trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate) {

          $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

          $image255x158 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 255,158, $file_name);
          $image1327x285 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 1327,285, $file_name);
          $image271x167 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 271,167, $file_name);
          $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


          if ($image255x158 && $image1327x285 && $image70x70 && $image271x167) {

              $insert = $this->course_model->add(
                  array(
                      "url"         => converToSEO($this->input->post("title")),
                      "title"       => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      "event_date"  => $this->input->post("event_date"),
                      "img_url"     => $file_name,
                      "rank"        => 0,
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
                      "title"   => "İşlem başarısız",
                      "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                      "type"    => "error"
                  );
              }

              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("courses"));

          } else {
              $alert = array(
                  "title"   => "Opppss",
                  "text"    => "Resim yüklenme esnasında bir problem oluştu.",
                  "type"    => "error"
              );
              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("courses/new_course"));
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
    public function update_courses($id){
        $viewData = new stdClass();

        $item = $this->course_model->get(
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
        $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            if ($_FILES["img_url"]["name"] !== "") {

                $course = $this->course_model->get(
                    array(
                        "id" => $id
                    )
                );

                if($course){
                    $paths = array(
                        $path1 = "uploads/$this->viewFolder/255x158/$course->img_url",
                        $path2 = "uploads/$this->viewFolder/1327x285/$course->img_url",
                        $path3 = "uploads/$this->viewFolder/271x167/$course->img_url",
                        $path3 = "uploads/$this->viewFolder/70x70/$course->img_url"
                    );

                    foreach ($paths as $path)
                        $delete_folder = unlink($path);

                    if(!$delete_folder){
                        $alert = array(
                            "title"   => "İşlem başarısız",
                            "text"    => "Fotoğraf silinirken bir sorunla karşılaşıldı.",
                            "type"    => "error"
                        );

                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("courses/update_courses/$id"));

                    }
                }

                $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image255x158 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 255,158, $file_name);
                $image1327x285 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 1327,285, $file_name);
                $image271x167 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 271,167, $file_name);
                $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


                if ($image255x158 && $image1327x285 && $image70x70 && $image271x167) {
                    $data = array(
                        "url"           => converToSEO($this->input->post("title")),
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "img_url"       => $file_name,
                        "event_date"    => $this->input->post("event_date")
                    );
                } else {
                    $alert = array(
                        "title"     => "Opppss",
                        "text"      => "Resim yüklenme esnasında bir problem oluştu.",
                        "type"      => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("courses/update_courses/$id"));
                }
            } else {
                $data = array(
                    "url"           => converToSEO($this->input->post("title")),
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "event_date"    => $this->input->post("event_date")
                );
            }

            $update = $this->course_model->update(array("id" => $id), $data);

        if ($update) {
            $alert = array(
                "title"     => "Tebrikler",
                "text"      => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                "type"      => "success"
            );
        } else {
            $alert = array(
                "title"     => "İşlem başarısız",
                "text"      => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"      => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("courses"));
    }
        else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->course_model->get(
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

        $course = $this->course_model->get(
            array(
                "id" => $id
            )
        );

        if($course){
            $paths = array(
                $path1 = "uploads/$this->viewFolder/255x158/$course->img_url",
                $path2 = "uploads/$this->viewFolder/1327x285/$course->img_url",
                $path3 = "uploads/$this->viewFolder/271x167/$course->img_url",
                $path3 = "uploads/$this->viewFolder/70x70/$course->img_url"
            );

            foreach ($paths as $path)
                $delete_image = unlink($path);
            if(!$delete_image) {
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text"  => "Resim silinemedi.",
                    "type"  => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("courses"));
            }
            else {
                $delete = $this->course_model->delete(
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

                } else {
                    $alert = array(
                        "title" => "İşlem başarısız",
                        "text"  => "Ürün silinirken bir sorunla karşılaşıldı.",
                        "type"  => "error"
                    );
                }

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("courses"));
            }
        }
    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->course_model->update(
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
            $this->course_model->update(
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
