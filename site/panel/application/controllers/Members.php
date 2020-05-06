<?php


class Members extends MY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "members_v";
        $this->load->model("member_model");

        if(!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        $items = $this->member_model->get_all(
            array()
        );

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_member()
    {
        if (!isAllowedAddModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    
    //yeni ürünün eklenmesi
    public function save(){
        if (!isAllowedAddModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
      $this->load->library("form_validation");

      $this->form_validation->set_rules("email", "Abone Maili", "required|trim|valid_email|is_unique[members.email]");

      $this->form_validation->set_message(
          array(
              "required"    => "<strong>{field}</strong> alanı doldurulmalıdır.",
              "valid_email" => "Lütfen geçerli bir mail adresi yazınız..",
              "is_unique" => "<strong>{field}</strong> bu alan benzersiz olmalıdır.",
          )
      );

      $validate = $this->form_validation->run();

      if ($validate){
          $insert = $this->member_model->add(
              array(
                  "email"           => $this->input->post("email"),
                  "ip_address"      => $this->input->ip_address(),
                  "isActive"        => 1,
                  "createdAt"       => date("Y-m-d H:i:s")
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
          redirect(base_url("members"));
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

    public function update_member($id){
        if (!isAllowedUpdateModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;

        $viewData = new stdClass();

        $item = $this->member_model->get(
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
        if (!isAllowedUpdateModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;
        $this->load->library("form_validation");

        $oldMember = $this->member_model->get(
            array(
                "id" => $id
            )
        );

        $this->form_validation->set_rules("email", "Abone Maili", "required|trim|valid_email");
        if ($oldMember->email != $this->input->post("email")){
            $this->form_validation->set_rules("email", "Abone Maili", "required|trim|valid_email|is_unique[members.email]");
        }

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "is_unique" => "<strong>{field}</strong> bu alan benzersiz olmalıdır.",
                "valid_email" => "Lütfen geçerli bir mail adresi giriniz.",
            )
        );

        $validate = $this->form_validation->run();

        if ($validate) {

            $update = $this->member_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "email"        => $this->input->post("email"),
                    "ip_address"   => $this->input->ip_address(),

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
            redirect(base_url("members"));
        }
        else{
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = "true";

            $viewData->item = $this->member_model->get(
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

        $delete = $this->member_model->delete(
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
        redirect(base_url("members"));

    }

    public function isActiveSetter($id)
    {
        if (!isAllowedUpdateModule($this->router->fetch_class())):
            redirect(base_url($this->router->fetch_class()));
        endif;

        if ($id) {

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->member_model->update(
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
