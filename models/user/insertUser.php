<?php
if(isset($_POST["send"])):
    include "functionsUser.php";
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPass = $_POST["passwordC"];
    if($_POST["role"] != 0)
        $roleID = $_POST["role"];
    else
        $roleID = 2;
    $file = $_FILES["fileUser"];

    $register = userRegister($username,$email,$password,$confirmPass,$roleID,$file);
    if(!$register):
        $message = implode(" ",$register);
        header("location:../../index.php?page=admin&message=".$message);
    else:
        $message = "successfully added new user";
        header("location:../../index.php?page=admin&message=".$message);
    endif;
else:
    http_response_code(400);
endif;
?>