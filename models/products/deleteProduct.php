<?php
if(isset($_POST["id"])):
    header("content-type:application/json");
    include "functionsProducts.php";
    include "../../config/connection.php";
    $message = deleteProduct($_POST["id"]);
    echo json_encode($message);
else:
    http_response_code(400);
endif;
?>