<?php
session_start();
include "config/connection.php";
include "models/products/functionsProducts.php";
include "models/user/functionsUser.php";
include "models/categories/functionsCategories.php";

include "views/fixed/header.php";
if(!isset($_SESSION["account"])):
    include "views/fixed/loginForm.php";
endif;

include "views/fixed/beginBodyDiv.php";

if(isset($_GET["page"])):
    switch($_GET["page"]):
        case "products":
            include "views/pages/products.php";
            break;
        case "about":
            include "views/pages/about.php";
            break;
        case "user":
        
            if(isset($_SESSION["account"])):
                if($_SESSION["account"]->Role_ID == 2)
                    include "views/pages/user.php";
            else
                http_response_code(404);
            endif;
            break;
        case "admin":
            if(isset($_SESSION["account"])):
                if($_SESSION["account"]->Role_ID ==1)
                    include "views/pages/admin.php";
            else
                http_response_code(404);
            endif;
            break;
        case "register":
            include "views/fixed/registerForm.php";
            break;
        case "profilePic":
        if(isset($_SESSION["account"])):
            if($_SESSION["account"]->Role_ID == 2)
                include "views/pages/profilePicture.php";
                break;
        else:
            http_response_code(404);
        endif;
        default:
            include "views/pages/home.php";
        break;
    endswitch;
else:
        include "views/pages/home.php";
endif;
include "views/fixed/endBodyDiv.php";
include "views/fixed/footer.php";
?>