<?php


class Galleries extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "galleries_v";

        $this->load->model("gallery_model");
        $this->load->model("image_model");
        $this->load->model("file_model");
        $this->load->model("video_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->gallery_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_gallery()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni ürünün eklenmesi
    public function save(){
      $this->load->library("form_validation");

      $this->form_validation->set_rules("title", "Başlık", "required|trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate){

          $gallery_type = $this->input->post("gallery_type");
          $path = "uploads/$this->viewFolder";
          $folder_name = "";

          if ($gallery_type == "image"){
              $folder_name = converToSEO($this->input->post("title"));
              $path = "$path/images/$folder_name";
          }else if($gallery_type == "file"){
              $folder_name = converToSEO($this->input->post("title"));
              $path = "$path/files/$folder_name";
          }
          if($gallery_type !== "video"){
              if(!mkdir($path, 0777)){
                  $alert = array(
                      "title"   => "İşlem başarısız",
                      "text"    => "Dosya yolu bozuk veya izinler verilmemiş!",
                      "type"    => "error"
                  );
                  $this->session->set_flashdata("alert", $alert);
                  redirect(base_url("galleries"));
              }
          }

          $insert = $this->gallery_model->add(
              array(
                  "url"                 => converToSEO($this->input->post("title")),
                  "title"               => $this->input->post("title"),
                  "gallery_type"        => $this->input->post("gallery_type"),
                  "folder_name"         => $folder_name,
                  "rank"                => 0,
                  "isActive"            => true,
                  "createdAt"           => date("Y-m-d H:i:s")
              )
          );

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
             redirect(base_url("galleries"));

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
    public function update_galleries($id){
        $viewData = new stdClass();

        $item = $this->gallery_model->get(
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
    public function update($id, $gallery_type, $oldFolderName = ""){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(

            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate){

            $path = "uploads/$this->viewFolder";
            $folder_name = "";

            if ($gallery_type == "image"){
                $folder_name = converToSEO($this->input->post("title"));
                $path = "$path/images";
            }else if($gallery_type == "file"){
                $folder_name = converToSEO($this->input->post("title"));
                $path = "$path/files";
            }
            if($gallery_type != "video"){
                if(!rename("$path/$oldFolderName", "$path/$folder_name")){
                    $alert = array(
                        "title"   => "İşlem başarısız",
                        "text"    => "Dosya yolu bozuk veya izinler verilmemiş!",
                        "type"    => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("galleries"));
                }
            }

            $update = $this->gallery_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "url"         => converToSEO($this->input->post("title")),
                    "title"       => $this->input->post("title"),
                    "folder_name" => $folder_name
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
            redirect(base_url("galleries"));

        }
        else{
            $viewData = new stdClass();

            $item = $this->gallery_model->get(
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

    public function delete($id){
        //Silmeyi istediğimiz klasöre erişiyoruz....
        $gallery = $this->gallery_model->get(
          array(
              "id" => $id
          )
        );
        if($gallery){
            $gallery_type = $gallery->gallery_type;

            if($gallery_type != "video"){
                if($gallery_type == "image"){
                    $model = "image_model";
                    $path = "uploads/$this->viewFolder/images/$gallery->folder_name";
                    $delete_other = $this->image_model->get_all(
                        array(
                            "gallery_id" => $id
                        )
                    );
                }
                else if($gallery_type == "file"){
                    $model = "file_model";
                    $path = "uploads/$this->viewFolder/files/$gallery->folder_name";
                    $delete_other = $this->file_model->get_all(
                        array(
                            "gallery_id" => $id
                        )
                    );
                }
                if ($delete_other){
                   foreach ($delete_other as $delete_item){
                       unlink($delete_item->url);
                   }
                    $this->$model->delete(
                        array(
                            "gallery_id" => $id
                        )
                    );
                }

                $delete_folder = rmdir($path);
                if(!$delete_folder){
                    $alert = array(
                        "title"   => "İşlem başarısız",
                        "text"    => "Klasör silme sırasında bir problem oluştu.",
                        "type"    => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("galleries"));
                }
            }

             $this->video_model->delete(
                array(
                    "gallery_id" => $id
                )
            );

            $delete = $this->gallery_model->delete(
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
            redirect(base_url("galleries"));
        }
    }

    public function fileDelete($id, $parent_id, $gallery_type){

        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";

        $fileName = $this->$modelName->get(
            array(
                "id"  => $id
            )
        );

        $delete = $this->$modelName->delete(
          array(
              "id" => $id
          )
        );

        if($delete){
            unlink("$fileName->url");

            $alert = array(
                "title"   => "Tebrikler",
                "text"    => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                "type"    => "success"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("galleries/upload_form/$parent_id"));
        }
        else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("galleries/image_form/$parent_id"));
            unset($_SESSION['alert']);
        }

    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->gallery_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

    public function fileIsActiveSetter($id, $gallery_type){

        if($id && $gallery_type){
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $modelName = ($gallery_type == "image") ? "image_model" : "file_model";

            $this->$modelName->update(
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
            $this->gallery_model->update(
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

    public function file_rankSetter($gallery_type){
        $data = $this->input->post("data");

        parse_str($data, $order);
        $items = $order["ord"];

        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";

        foreach ($items as $rank => $id){

            $this->$modelName->update(
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

    public function upload_form($id){
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $item = $this->gallery_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;

        if($item->gallery_type == "image"){
            $viewData->item_images =  $this->image_model->get_all(
                array(
                    "gallery_id" => $id,
                ),
                "rank ASC"
            );

            $viewData->folder_name = $item->folder_name;
        }else if($item->gallery_type == "file"){
            $viewData->item_images =  $this->file_model->get_all(
                array(
                    "gallery_id" => $id,
                ),
                "rank ASC"
            );
        }
        else{
            $viewData->item_images =  $this->video_model->get_all(
                array(
                    "gallery_id" => $id,
                ),
                "rank ASC"
            );
        }

        $viewData->gallery_type = $item->gallery_type;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function file_upload($gallery_id, $gallery_type, $folderName){

        if($gallery_type == "image"){
            $file_name = rand().rand().converToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            $image370x216 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/images/$folderName", 370,216, $file_name);
            $image253x156 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/images/$folderName", 253,156, $file_name);
            $image897x635 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/images/$folderName", 897,635, $file_name);
            $image70x70 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/images/$folderName", 70,70, $file_name);


                if ($image370x216 && $image253x156 && $image897x635 && $image70x70) {

                    $this->image_model->add(
                        array(
                            "url"           => $file_name,
                            "rank"          => 0,
                            "isActive"      => 1,
                            "createdAt"     => date("Y-m-d H:i:s"),
                            "gallery_id"    => $gallery_id
                        )
                    );
                }else{
                    echo "islem basarisiz";
                }

            }else{
            $file_name = converToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $config["allowed_types"] = "doc|pdf|docx|xlsx";
            $config["upload_path"] = "uploads/$this->viewFolder/files/$folderName";
            $config["file_name"] = $file_name;



            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("file");

            if($upload){

                $uploaded_file = $this->upload->data("file_name");

                $modelName = ($gallery_type == "image") ? "image_model" : "file_model";


                $this->$modelName->add(
                    array(
                        "url"           => $uploaded_file,
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s"),
                        "gallery_id"    => $gallery_id
                    )
                );
            }
            else{
                echo "islem basarisiz";
            }
        }
    }

    public function refresh_file_list($gallery_id, $gallery_type, $folder_name){
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $modelName = ($gallery_type == "image") ? "image_model" : "file_model";

        $viewData->item_images =  $this->$modelName->get_all(
            array(
                "gallery_id" => $gallery_id
            )
        );
        $viewData->folder_name = $folder_name;
        $viewData->gallery_type = $gallery_type;
        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/file_list_v", $viewData, true);

        echo $render_html;


    }


    /*
     * Video İşlemleri
     * */

    public function gallery_video_list($id)
    {
        $viewData = new stdClass();

        $gallery = $this->gallery_model->get(
            array(
                "id" => $id
            )
        );

        //Tablodan verilerin getirilmesi...
        $items = $this->video_model->get_all(
            array(
                "gallery_id" => $id
            ), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/list";
        $viewData->items = $items;
        $viewData->gallery = $gallery;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_gallery_video_form($gallery_id)
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/add";
        $viewData->gallery_id = $gallery_id;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gallery_video_save($gallery_id){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("url", "Video URL", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate){

            $insert = $this->video_model->add(
                array(
                    "url"                 => $this->input->post("url"),
                    "gallery_id"          => $gallery_id,
                    "rank"                => 0,
                    "isActive"            => true,
                    "createdAt"           => date("Y-m-d H:i:s")
                )
            );

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
            redirect(base_url("galleries/gallery_video_list/$gallery_id"));

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

    public function gallery_video_isActiveSetter($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->video_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    public function gallery_video_delete($id, $parent_id){

        $delete = $this->video_model->delete(
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
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("galleries/gallery_video_list/$parent_id"));
        }
        else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen zorunlu olan alanları doldurunuz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("galleries/gallery_video_list/$parent_id"));
            unset($_SESSION['alert']);
        }

    }

    public function gallery_video_rankSetter(){
        $data = $this->input->post("data");

        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id){

            $this->video_model->update(
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

    public function update_gallery_video_form($id){
        $viewData = new stdClass();

        $item = $this->video_model->get(
            array(
                "id" => $id
            )
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_galleries_video($id, $gallery_id){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("url", "Video URL", "required|trim");
        $this->form_validation->set_message(

            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate){

            $update = $this->video_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "url"         => $this->input->post("url"),
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
            redirect(base_url("galleries/gallery_video_list/$gallery_id"));

        }
        else{
            $viewData = new stdClass();

            $item = $this->video_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video/update";
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








}
