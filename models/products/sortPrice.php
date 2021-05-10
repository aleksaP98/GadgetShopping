<?php
if(isset($_POST["value"])):
    header("content-type:application/json");
    include "../../config/connection.php";
    include "functionsProducts.php";
    $value = $_POST["value"];

    if(isset($_POST["ids"]))
        $ids = $_POST["ids"];
    else
        $ids = null;
    $products = sortPrice($value,$ids);
    echo json_encode($products);
    http_response_code(200);

else:
    http_response_code(400);
endif;


?>