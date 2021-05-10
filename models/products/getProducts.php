<?php
include "../../config/connection.php";
include "functionsProducts.php";
header("content-type:application/json");

if(isset($_POST["limit"])):
    $limit = $_POST["limit"];
    $products = getAllProducts($limit);
    $pages = getPaginationNum();
    echo json_encode([
        "products"=>$products,
        "pages"=>$pages
    ]);
    http_response_code(200);
else:
    $products = getAllProducts();
    echo json_encode($products);
    http_response_code(200);
endif;
?>