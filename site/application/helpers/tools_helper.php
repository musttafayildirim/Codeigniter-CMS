<?php

function get_product_cover_image($product_id){
    $t = &get_instance();
    $t->load->model("product_image_model");

    $cover_image = $t->product_image_model->get(
        array(
            "isCover" => 1,
            "product_id" => $product_id
        )
    );

    if (empty($cover_image)){
        $cover_image = $t->product_image_model->get(
            array(
                "product_id" => $product_id
            )
        );
    }

    return !empty($cover_image) ? $cover_image->img_url : "";
}
