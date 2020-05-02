<?php


class My404 extends CI_Controller

{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "not_found_v";
    }

    public function index()
    {
        $viewData = new stdClass();

        $this->output->set_status_header('404');

        //View'e gönderilecek değişkenlerin set edilmesi...
        $viewData-> viewFolder = $this->viewFolder;

        $this->load->view("{$viewData->viewFolder}/index", $viewData);
    }


}
