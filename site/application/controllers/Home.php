<?php

class Home extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder ="homepage";
    }

    public function index(){
        echo $this->viewFolder;
    }

    public function product_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "product_list_v";
        $this->load->model("product_model");
        $this->load->helper("text");

        $viewData->products = $this->product_model->get_all(
          array(
              "isActive" => 1
          ), "rank ASC"
        );


        $this->load->view($viewData->viewFolder, $viewData);
    }
}