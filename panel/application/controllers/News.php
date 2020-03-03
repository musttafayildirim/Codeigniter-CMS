<?php


class News extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "news_v";

        $this->load->model("news_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->news_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_news()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni ürünün eklenmesi
    public function save(){
      $this->load->library("form_validation");

      $news_type = $this->input->post("news_type");

      if($news_type === "image"){
          if($_FILES["img_url"]["name"] == ""){

              $alert = array(
                  "title"   => "İşlem başarısız",
                  "text"    => "Lütfen bir resim ekleyiniz!",
                  "type"    => "error"
              );
              $this->session->set_flashdata("alert", $alert);
              redirect(base_url("news/new_news"));
          }
        else{

        }
      }
      else if($news_type === "video"){
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
      }

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate){
          if($news_type === "image"){
              $file_name = converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
              $config["allowed_types"] = "jpg|jpeg|png";
              $config["upload_path"] = "uploads/$this->viewFolder/";
              $config["file_name"] = $file_name;

              $this->load->library("upload", $config);
              $upload = $this->upload->do_upload("img_url");


              if($upload){

                  $uploaded_file = $this->upload->data("file_name");

                  $data = array(
                      "url"         => converToSEO($this->input->post("title")),
                      "title"       => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      "news_type"   => $news_type,
                      "img_url"     => $uploaded_file,
                      "video_url"     => '#',
                      "rank"        => 0,
                      "isActive"    => true,
                      "createdAt"   => date("Y-m-d H:i:s")
                  );
              }
              else{
                  $alert = array(
                      "title"   => "Opppss",
                      "text"    => "Resim yüklenme esnasında bir problem oluştu.",
                      "type"    => "error"
                  );
                  $this->session->set_flashdata("alert", $alert);
                  redirect(base_url("news/new_news"));
              }

          }
          else if($news_type === "video"){
              $data = array(
                  "url"         => converToSEO($this->input->post("title")),
                  "title"       => $this->input->post("title"),
                  "description" => $this->input->post("description"),
                  "news_type"   => $news_type,
                  "img_url"     => '#',
                  "video_url"   => $this->input->post("video_url"),
                  "rank"        => 0,
                  "isActive"    => true,
                  "createdAt"   => date("Y-m-d H:i:s")
              );
          }
          $insert = $this->news_model->add($data);

          if($insert){
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
             redirect(base_url("news"));

      }
      else{
          $viewData = new stdClass();

          $viewData-> viewFolder = $this->viewFolder;
          $viewData->subViewFolder = "add";
          $viewData->form_error = "true";
          $viewData->news_type = $news_type;

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
    public function update_news($id){
        $viewData = new stdClass();

        $item = $this->news_model->get(
            array(
                "id" => $id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //düzenlenen veriyi veri tabanına kaydetmek
    public function update1($id){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(

            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate){

            $update = $this->news_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "url"         => converToSEO($this->input->post("title")),
                    "title"       => $this->input->post("title"),
                    "description" => $this->input->post("description")
                )
            );

            if($update){
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
            redirect(base_url("news"));

        }
        else{
            $viewData = new stdClass();

            $item = $this->news_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";
            $viewData->item = $item;


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

    public function update($id){
        $this->load->library("form_validation");

        $news_type = $this->input->post("news_type");

        if($news_type === "video"){
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate){
            if($news_type === "image"){

                if ($_FILES["img_url"]["name"] !== ""){
                    $file_name = converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["upload_path"] = "uploads/$this->viewFolder/";
                    $config["file_name"] = $file_name;

                    $this->load->library("upload", $config);
                    $upload = $this->upload->do_upload("img_url");

                    if($upload){
                        $uploaded_file = $this->upload->data("file_name");
                        $data = array(
                            "url"         => converToSEO($this->input->post("title")),
                            "title"       => $this->input->post("title"),
                            "description" => $this->input->post("description"),
                            "news_type"   => $news_type,
                            "img_url"     => $uploaded_file,
                            "video_url"     => '#'
                        );
                    }
                    else{
                        $alert = array(
                            "title"   => "Opppss",
                            "text"    => "Resim yüklenme esnasında bir problem oluştu.",
                            "type"    => "error"
                        );
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("news/update_news/$id"));
                    }
                }
                else{
                    $data = array(
                        "url"         => converToSEO($this->input->post("title")),
                        "title"       => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                    );
                }
            }
            else if($news_type === "video"){
                $data = array(
                    "url"         => converToSEO($this->input->post("title")),
                    "title"       => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "news_type"   => $news_type,
                    "img_url"     => '#',
                    "video_url"   => $this->input->post("video_url")
                );
            }
            $update = $this->news_model->update(array("id" => $id), $data);

            if($update){
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
            redirect(base_url("news"));

        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";
            $viewData->news_type = $news_type;

            $viewData->item = $this->news_model->get(
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
        
        $delete = $this->news_model->delete(
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
        redirect(base_url("news"));

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->news_model->update(
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
            $this->news_model->update(
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
