<?php
if(isset($_POST["limit"])):
    header("content-type:application/json");
    include "functionsProducts.php";
    include "../../config/connection.php";
    $id = $_POST["id"];
    $limit = $_POST["limit"];
    $value = $_POST["value"] != "" ? $_POST["value"] : null;
    if($id == 0):
        $filteredProducts = getAllProducts($limit);
        $pages = getPaginationNum();
        echo json_encode([
            "products"=>$filteredProducts,
            "pages"=>$pages
            ]);
        http_response_code(200);
    else:
        $filteredProducts = filterProducts($id,$value,$limit);
        $pages = countProducts($id,$value);
        echo json_encode([
            "products" => $filteredProducts,
            "pages" => $pages
        ]);
        http_response_code(200);
    endif;

else:
    http_response_code(400);
endif;


?>