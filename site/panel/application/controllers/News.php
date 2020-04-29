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
      $this->form_validation->set_rules("description", "Açıklama", "trim");

      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate){
          if($news_type === "image"){
              $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

              $image513x317 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 513,317, $file_name);
              $image730x451 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 730,451, $file_name);
              $image60x37 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 60,37, $file_name);
              $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


              if ($image513x317 && $image730x451 && $image60x37 && $image70x70) {

                  $data = array(
                      "url"         => converToSEO($this->input->post("title")),
                      "title"       => $this->input->post("title"),
                      "description" => $this->input->post("description"),
                      "news_type"   => $news_type,
                      "img_url"     => $file_name,
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

    public function update($id){
        $this->load->library("form_validation");

        $news_type = $this->input->post("news_type");

        if($news_type === "video"){
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();

        if ($validate){
            if($news_type === "image"){
                if ($_FILES["img_url"]["name"] !== ""){
                    $image = $this->news_model->get(
                        array(
                            "id" => $id
                        )
                    );

                    if (!$image){
                        $alert = array(
                            "title" => "İşlem başarısız",
                            "text"  => "Böyle bir haber bulanamadı.",
                            "type"  => "error"
                        );

                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("news"));
                    }
                    else{
                       $paths = array(
                            $path1 = "uploads/$this->viewFolder/60x37/$image->img_url",
                            $path2 = "uploads/$this->viewFolder/70x70/$image->img_url",
                            $path3 = "uploads/$this->viewFolder/513x317/$image->img_url",
                            $path4 = "uploads/$this->viewFolder/730x451/$image->img_url"
                        );

                        foreach ($paths as $path)
                            $delete_folder = unlink($path);
                        if(!$delete_folder) {
                            $alert = array(
                                "title" => "İşlem başarısız",
                                "text" => "Dosya yolu doğru değil veya böyle bir resim yok",
                                "type" => "error"
                            );

                            $this->session->set_flashdata("alert", $alert);
                            redirect(base_url("news"));

                        }
                        else{
                            $file_name = rand().rand().converToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                            $image513x317 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 513,317, $file_name);
                            $image730x451 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 730,451, $file_name);
                            $image60x37 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 60,37, $file_name);
                            $image70x70 = upload_image($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


                            if ($image513x317 && $image730x451 && $image60x37 && $image70x70) {
                                $data = array(
                                    "url"         => converToSEO($this->input->post("title")),
                                    "title"       => $this->input->post("title"),
                                    "description" => $this->input->post("description"),
                                    "news_type"   => $news_type,
                                    "img_url"     => $file_name,
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

        $news = $this->news_model->get(
          array(
              "id" => $id
          )
        );
        if ($news->news_type == "image"){
            if ($news){
                $paths = array(
                    $path1 = "uploads/$this->viewFolder/60x37/$news->img_url",
                    $path2 = "uploads/$this->viewFolder/70x70/$news->img_url",
                    $path3 = "uploads/$this->viewFolder/513x317/$news->img_url",
                    $path4 = "uploads/$this->viewFolder/730x451/$news->img_url"
                );

                foreach ($paths as $path)
                    $delete_folder = unlink($path);
                if(!$delete_folder) {
                    $alert = array(
                        "title" => "İşlem başarısız",
                        "text" => "Dosya yolu doğru değil veya böyle bir resim yok",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("news"));
                }else{
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
            }
        }
        else if($news->news_type == "video"){
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
