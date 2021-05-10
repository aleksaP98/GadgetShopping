<?php
if(isset($_POST["value"])):
    header("content-type:application/json");
    include "../../config/connection.php";
    include "functionsProducts.php";
    $value = $_POST["value"] != "" ? $_POST["value"] : null;
    $id = $_POST["id"] > 0 ? $_POST["id"] : null;
    $limit = $_POST["limit"];

    $products = filterProducts($id,$value,$limit);
        $pages = countProducts($id,$value);
        echo json_encode([
            "products" => $products,
            "pages" =>$pages
            ]);
        http_response_code(200);
else:
    http_response_code(400);
endif;


?>