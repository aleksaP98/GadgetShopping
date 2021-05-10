<?php
if(isset($_POST["username"])):
     include "../user/functionsUser.php";
     include "../../config/connection.php";
     header("content-type:application/json");

	$username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Cpassword = $_POST["Cpassword"];

    $register = userRegister($username,$email,$password,$Cpassword);
    if($register):
        echo json_encode($register);
        http_response_code(200);
    else:
        echo json_encode($register);
        http_response_code(422);
    endif;

else:
    http_response_code(400);
endif;    
?>