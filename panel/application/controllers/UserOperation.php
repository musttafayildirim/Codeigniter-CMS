<?php


class UserOperation extends CI_Controller
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

    public function send_email(){
        $config = array(
            'protocol'      => "smtp",
            "smtp_host"     => "ssl://smtp.gmail.com",
            "smtp_port"     => "465",
            "smtp_user"     => "mailmusttafayildirim@gmail.com",
            "smtp_pass"     => "mustafa1997.",
            "starttls"      => true,
            "charset"       => "utf-8",
            "mailtype"      => "html",
            "wordwrap"      => true,
            "newline"       => "\r\n"
        );


        $this->load->library('email', $config);

        $this->email->from("mailmusttafayildirim@gmail.com");
        $this->email->to("mustafa.yildirim1997@gmail.com");
        $this->email->subject("deneme");
        $this->email->message("deneme içeririk");

        $send = $this->email->send();

        if($send)
            echo "başarılı";
        else
            echo "başarısızız";
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
               $this->load->model("email_model");

               $email = $this->email_model->get(
                   array(
                       "isActive" =>1
                   )
               );

               $config = array(
                   'protocol'      => $email->protocol,
                   "smtp_host"     => $email->host,
                   "smtp_port"     => $email->port,
                   "smtp_user"     => $email->user,
                   "smtp_pass"     => $email->password,
                   "starttls"      => true,
                   "charset"       => "utf-8",
                   "mailtype"      => "html",
                   "wordwrap"      => true,
                   "newline"       => "\r\n"
               );


               $this->load->library('email', $config);

               $this->email->from($email->from);
               $this->email->to($user->email);
               $this->email->subject("deneme");
               $this->email->message("deneme içeririk");

               $send = $this->email->send();

               if($send)
                   echo "başarılı";
               else
                   echo "başarısızız";

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
