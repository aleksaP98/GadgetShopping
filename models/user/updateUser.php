<?php
include "functionsUser.php";

if(isset($_POST["sendUsername"])):
    
    $message = updateUsername($_POST["editUsername"],$_SESSION["account"]->id);
    

elseif(isset($_POST["sendEmail"])):
    
 $message =  updateEmail($_POST["editEmail"],$_SESSION["account"]->id);
   header("location:../../index.php?page=user&message=".$message);

elseif(isset($_POST["sendPassword"])):

   $message = updatePassword($_POST["editPass"],$_POST["editPass2"],$_SESSION["account"]->id);
    header("location:../../index.php?page=user&message=".$message);

elseif(isset($_POST["adminUpdate"])):

  $message =  adminUpdate($_POST["username"],$_POST["email"],$_POST["password"],$_POST["passwordC"],$_POST["role"],$_POST["idUser"],$_FILES["fileUser"]);
  $message = implode(" ",$message);
  header("location:../../index.php?page=admin&message=".$message);

elseif(isset($_POST["sendPicture"])):
    
  if(!empty($_FILES["file"]["name"])):
      $message = uploadPicture($_FILES["file"],$_SESSION["account"]->id);
  else:
      $message = "Please select an image";
  endif;
    header("location:../../index.php?page=user&message=".$message);

elseif(isset($_GET["idUser"]) && isset($_GET["idPicture"])):

    $message = updateProfilePicture($_GET["idUser"],$_GET["idPicture"]);
    header("location:../../index.php?page=user&message=".$message);

else:
    http_response_code(400);
endif;

?>