<?php
if(isset($_POST["id"])):
    include "../../config/connection.php";
    header("content-type:application/json");
    $id = $_POST["id"];
    try{
      $query = "delete from user_pictures where id_user = ?";
      $prep = $conn->prepare($query);
      $prep->execute([$id]);
      $query2 = "delete from users where id = ?";
      $prep2 = $conn->prepare($query2);
      $prep2->execute([$id]);
    http_response_code(204);
    }
    catch(PDOException $e){
      echo json_encode(["error"=>"There was a problem with the database:".$e->getMessage()]);
      http_response_code(500);
    }
else:
    http_response_code(400);
endif;

?>