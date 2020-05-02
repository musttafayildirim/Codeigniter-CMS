<?php


class Useroperation extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
    }

    public function login()
    {
        if(get_active_user())
            redirect(base_url());

        $viewData = new stdClass();
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login(){

        if(get_active_user())
            redirect(base_url());

        $this->load->library("form_validation");
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
            )
        );

        if($this->form_validation->run() == FALSE){
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = "true";

            $alert = array(
                "title"   => "İşlem başarısız",
                "text"    => "Lütfen bilgilerinizi kontrol ediniz!",
                "type"    => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
            unset($_SESSION['alert']);

        }
        else{
            $username = $this->user_model->get(
                array(
                    "user_name" => $this->input->post("user_name"),
                )
            );
            $user =  $this->user_model->get(
                array(
                    "user_name" => $this->input->post("user_name"),
                    "password"  => md5($this->input->post("password")),
                )
            );
            $isActive =  $this->user_model->get(
                array(
                    "user_name" => $this->input->post("user_name"),
                    "password"  => md5($this->input->post("password")),
                    "isActive"  => 1
                )
            );

            if($username) {
                    if ($user) {
                        if ($isActive){
                            $alert = array(
                                "title" => "İşlem başarılı",
                                "text" => "$user->full_name hoşgeldiniz",
                                "type" => "success"
                            );

                            setUserRoles();

                            $this->session->set_userdata("user", $user);
                            $this->session->set_flashdata("alert", $alert);
                            redirect(base_url());
                        }
                        else{
                            $alert = array(
                                "title" => "İşlem başarısız",
                                "text" => "Lütfen yöneticinizle irtibata geçiniz!",
                                "type" => "error"
                            );
                            $this->session->set_flashdata("alert", $alert);
                            redirect(base_url("login"));
                            unset($_SESSION['alert']);
                        }

                    } else {
                        $alert = array(
                            "title" => "İşlem başarısız",
                            "text" => "Lütfen şifrenizi kontrol ediniz!",
                            "type" => "error"
                        );
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("login"));
                        unset($_SESSION['alert']);
                    }
            }
            else{
                $alert = array(
                    "title"   => "İşlem başarısız",
                    "text"    => "Böyle bir kullanıcı bulunamadı!",
                    "type"    => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
                unset($_SESSION['alert']);
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('user');
        redirect(base_url('login'));
    }

    public function forget_password()
    {
        if(get_active_user())
            redirect(base_url());

        $viewData = new stdClass();
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function reset_password(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "E-posta", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<strong>{field}</strong> alanı doldurulmalıdır.",
                "valid_email" => "Lütfen geçerli bir <strong>email</strong> adresi giriniz."
            )
        );
        if ($this->form_validation->run() == FALSE){
            $viewData = new stdClass();

            $viewData-> viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = "true";

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        else{
           $user = $this->user_model->get(
               array(
                   "isActive"   => 1,
                   "email"      => $this->input->post("email")
               )
           );

           if($user){
               //Random şifre oluşturma işlemi
               $this->load->helper("string");
               $temp_password = random_string();
               //mail gönderme helperını kullanarak mailimizi gönderiyoruz...
               $send = send_email($user->email, "Şifremi Unuttum", "Sisteme tekrar giriş yapabilmek için kullanmanız gereken şifre : <strong>{$temp_password}</strong>");

               if($send){
                    $this->user_model->update(
                        array(
                            'id' => $user->id
                        ),
                        array(
                            'password' => md5($temp_password)
                        )
                    );

                   $alert = array(
                       "title"   => "Tebrikler",
                       "text"    => "Şifreniz başarılı bir şekilde sıfırlanmıştır. Lütfen <strong>E-Posta</strong> adresinizi kontrol ediniz.",
                       "type"    => "success"
                   );

                   $this->session->set_flashdata("alert", $alert);
                   redirect(base_url("login"));
                   unset($_SESSION['alert']);
               }

               else{
                   $alert = array(
                       "title"   => "OPSSS!!!!!",
                       "text"    => "E-posta gönderme sırasında bir hata oluştu.",
                       "type"    => "error"
                   );

                   $this->session->set_flashdata("alert", $alert);
                   redirect(base_url("reset-password"));
                   unset($_SESSION['alert']);
               }

           }
           else{
               $alert = array(
                   "title"   => "İşlem başarısız",
                   "text"    => "Böyle bir kullanıcıya ait <strong>E-posta</strong> adresi bulunamadı.",
                   "type"    => "error"
               );

               $this->session->set_flashdata("alert", $alert);
               redirect(base_url("reset-password"));
               unset($_SESSION['alert']);
           }

        }
    }


}
