<?php


class Product extends MY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";

        $this->load->model("product_model");
        $this->load->model("product_image_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        //Tablodan verilerin getirilmesi...
        $items = $this->product_model->get_all(
            array(), "rank ASC"
        );

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    //yeni ürün sayfasına gitmek
    public function new_product()
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
      $this->form_validation->set_rules("description", "Açıklama", "trim");
      $this->form_validation->set_message(
          array(
              "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
          )
      );
      $validate = $this->form_validation->run();

      if ($validate){

          $insert = $this->product_model->add(
              array(
                  "url"         => converToSEO($this->input->post("title")),
                  "title"       => $this->input->post("title"),
                  "description" => $this->input->post("description"),
                  "rank"        => 0,
                  "isActive"    => true,
                  "createdAt"   => date("Y-m-d H:i:s")
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
             redirect(base_url("product"));

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
    public function update_product($id){
        $viewData = new stdClass();

        $item = $this->product_model->get(
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
    public function update($id){
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("description", "Açıklama", "trim");
        $this->form_validation->set_message(

            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır."
            )
        );
        $validate = $this->form_validation->run();

        if ($validate){

            $update = $this->product_model->update(
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
            redirect(base_url("product"));

        }
        else{
            $viewData = new stdClass();

            $item = $this->product_model->get(
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
        if (!isAllowedDeleteModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
        $product_images = $this->product_image_model->get_all(
          array(
              "product_id" => $id
          )
        );

        $delete_image = $this->product_image_model->delete(
            array(
                "product_id" => $id
            )
        );

        if ($delete_image){
            foreach ($product_images as $product_image){
                $paths = array(
                    $path1 = "uploads/$this->viewFolder/348x215/$product_image->img_url",
                    $path2 = "uploads/$this->viewFolder/70x70/$product_image->img_url",
                    $path3 = "uploads/$this->viewFolder/372x224/$product_image->img_url",
                    $path4 = "uploads/$this->viewFolder/1140x450/$product_image->img_url"
                );

                foreach ($paths as $path)
                    unlink($path);
            }
        }

        $delete = $this->product_model->delete(
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
        redirect(base_url("product"));

    }

    public function imageDelete($id, $parent_id){

        $fileName = $this->product_image_model->get(
            array(
                "id"  => $id
            )
        );

        if($fileName){
            $paths = array(
                $path1 = "uploads/$this->viewFolder/348x215/$fileName->img_url",
                $path2 = "uploads/$this->viewFolder/70x70/$fileName->img_url",
                $path3 = "uploads/$this->viewFolder/372x224/$fileName->img_url",
                $path4 = "uploads/$this->viewFolder/1140x450/$fileName->img_url"
            );

            foreach ($paths as $path)
                $delete_folder = unlink($path);

            if (!$delete_folder){
                $alert = array(
                    "title" => "İşlem başarısız",
                    "text" => "Dosya yolu doğru değil veya böyle bir resim yok",
                    "type" => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("product/image_form/$parent_id"));

            }else{

                $delete = $this->product_image_model->delete(
                    array(
                        "id" => $id
                    )
                );
                if ($delete){
                    $alert = array(
                        "title"   => "Tebrikler",
                        "text"    => "İşleminiz başarılı bir şekilde gerçekleştirildi.",
                        "type"    => "success"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("product/image_form/$parent_id"));
                }
                else{
                    $alert = array(
                        "title"   => "İşlem başarısız",
                        "text"    => "Silinecek fotoğraf veritabanında kayıtlı değil.",
                        "type"    => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("product/image_form/$parent_id"));
                    unset($_SESSION['alert']);
                }

            }
        }else{
            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Silinecek fotoğraf bulunamadı....",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("product/image_form/$parent_id"));
            unset($_SESSION['alert']);
        }
    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_model->update(
                array(
                    "id" => $id,
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }

    }

    public function imageIsActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_image_model->update(
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
            $this->product_model->update(
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

    public function imageRankSetter(){
        $data = $this->input->post("data");

        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id){
            $this->product_image_model->update(
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

    public function image_form($id){
        $viewData = new stdClass();

        $item = $this->product_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item_images =  $this->product_image_model->get_all(
          array(
              "product_id" => $id,
          ),
            "rank ASC"
        );


        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function image_upload($id){

        $file_name = rand().rand().converToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)). "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        $image1140x450 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/", 1140,450, $file_name);
        $image372x224 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/", 372,224, $file_name);
        $image348x215 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/", 348,215, $file_name);
        $image70x70 = upload_image($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder/", 70,70, $file_name);


        if ($image1140x450 && $image348x215 && $image70x70 && $image372x224) {


            $this->product_image_model->add(
                array(
                    "img_url"       => $file_name,
                    "rank"          => 0,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s"),
                    "product_id"    => $id
                )
            );
        }
        else{
                echo "islem basarisiz";
        }

    }

    public function refresh_image_list($id){
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item_images =  $this->product_image_model->get_all(
            array(
                "product_id" => $id
            )
        );

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

        echo $render_html;


    }

    public function isCoverSetter($id, $parent_id){
        if($id && $parent_id){
            $isCover = ($this->input->post("data") == "true") ? 1 : 0;

            //bu kayıt kapak fotoğrafı olacaktır dediğin..
            $this -> product_image_model->update(
                array(
                    "id"            => $id,
                    "product_id"    => $parent_id
                ),
                array(
                    "isCover"       => $isCover
                )
            );

            //kapak olmayan kayıtlar kapalı hale getiriliyor.
            $this->product_image_model->update(
                array(
                    "id !="         => $id,
                    "product_id"    => $parent_id
                ),
                array(
                    "isCover"       => 0
                )
            );

            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images =  $this->product_image_model->get_all(
                array(
                    "product_id" => $parent_id
                ),
                    "rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

            echo $render_html;



        }
    }

}
