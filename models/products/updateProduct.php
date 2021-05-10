<?php
if(isset($_POST["sendU"])):
    include "functionsProducts.php";
    include "../../config/connection.php";
    $message =  updateProduct($_POST["name"],$_POST["description"],$_POST["price"],$_POST["category"],$_FILES["file"],$_POST["idProduct"]);
    $message = implode(" ",$message);
    header("location:../../index.php?page=admin&message=".$message);
else:
    http_response_code(400);
endif;


?>