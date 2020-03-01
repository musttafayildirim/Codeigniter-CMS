<?php


class UserOperation extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
    }

    public function index()
    {
        $viewData = new stdClass();

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function login()
    {
        $viewData = new stdClass();

        $viewData-> viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }


}
