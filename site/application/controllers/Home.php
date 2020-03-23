<?php

class Home extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder ="homepage";
        $this->load->helper("text");
    }

    public function index(){
        echo $this->viewFolder;
    }

    public function product_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "product_list_v";
        $this->load->model("product_model");

        $viewData->products = $this->product_model->get_all(
          array(
              "isActive" => 1
          ), "rand()" , array("start" => 0, "count" => 60)
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function product_detail($url = ""){
        $viewData = new stdClass();
        $viewData->viewFolder = "product_v";
        $this->load->model("product_model");
        $this->load->model("product_image_model");

        $viewData->product = $this->product_model->get(
            array(
                "isActive"  => 1,
                "url"       => $url
            )
        );

        $viewData->product_images = $this->product_image_model->get_all(
            array(
                "isActive"      => 1,
                "product_id"    => $viewData->product->id,
            ), "rank ASC"
        );

        $viewData->other_products = $this->product_model->get_all(
            array(
                "isActive" => 1,
                "id !="    => $viewData->product->id
            ), "rand()" , array("start" => 0, "count" => 3)
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function portfolio_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "portfolio_list_v";
        $this->load->model("portfolio_model");

        $viewData->portfolios = $this->portfolio_model->get_all(
            array(
                "isActive" => 1
            ), "rand()" , array("start" => 0, "count" => 60)
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function portfolio_detail($url = ""){
        $viewData = new stdClass();
        $viewData->viewFolder = "portfolio_v";
        $this->load->model("portfolio_model");
        $this->load->model("portfolio_image_model");

        $viewData->portfolio = $this->portfolio_model->get(
            array(
                "isActive"  => 1,
                "url"       => $url
            )
        );

        $viewData->portfolio_images = $this->portfolio_image_model->get_all(
            array(
                "isActive"      => 1,
                "portfolio_id"    => $viewData->portfolio->id,
            ), "rank ASC"
        );

        $viewData->other_portfolios = $this->portfolio_model->get_all(
            array(
                "isActive" => 1,
                "id !="    => $viewData->portfolio->id
            ), "rand()" , array("start" => 0, "count" => 3)
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function course_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "course_list_v";
        $this->load->model("course_model");

        $viewData->courses = $this->course_model->get_all(
            array(
                "isActive" => 1
            ), "rank ASC, event_date ASC"
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function course_detail($url = ""){
        $viewData = new stdClass();
        $viewData->viewFolder = "course_v";
        $this->load->model("course_model");

        $viewData->course = $this->course_model->get(
            array(
                "isActive"  => 1,
                "url"       => $url
            )
        );

        $viewData->other_courses = $this->course_model->get_all(
            array(
                "isActive" => 1,
                "id !="    => $viewData->course->id
            ), "rand()" , array("start" => 0, "count" => 3)
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function reference_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "reference_list_v";
        $this->load->model("reference_model");

        $viewData->references = $this->reference_model->get_all(
            array(
                "isActive" => 1
            ), "rank ASC"
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function brand_list(){
        $viewData = new stdClass();
        $viewData->viewFolder = "brand_list_v";
        $this->load->model("brand_model");

        $viewData->brands = $this->brand_model->get_all(
            array(
                "isActive" => 1
            ), "rank ASC"
        );

        $this->load->view($viewData->viewFolder, $viewData);
    }





}