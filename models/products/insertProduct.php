<?php
if(isset($_POST["send"])):
    include "../../models/categories/functionsCategories.php";
    include "functionsProducts.php";

    $name = $_POST["productName"];
    $description = $_POST["productDesc"];
    $price = $_POST["productPrice"];
    $categoryId = $_POST["productCat"];

    $file = $_FILES["productPicture"];
    
    $message ="Category ID must be either:";
    $found = false;
    $categories = getAllCategories();
    foreach($categories as $category):
        if($category->id == $categoryId)
            $found = true;
        else
            $message .= $category->id.",";
    endforeach;
    if(!$found):
        logUserError("CategoryID",$error);
        header("location:../../index.php?page=admin&message=".$message);
    else:
        $lastInserted = uploadPicture($file);
        if($lastInserted > 0):
            try{
                $query = "insert into products values(null,?,?,?,?,?)";
                $prepared = $conn->prepare($query);
                $prepared->execute([$name,$description,$price,$categoryId,$lastInserted]);
                
                    $message = "successfully added new product";
                    header("location:../../index.php?page=admin&message=".$message);
            }
            catch(Exception $e){
                $message = $e->getMessage();
                logUserError("databese",$message);
                header("location:../../index.php?page=admin&message=".$message);

            }    
             
        else:
            $message = "error in uploading file";
            logUserError("file",$message);
            header("location:../../index.php?page=admin&message=".$message);
        endif;
    endif;

else:
    http_response_code(400);
endif;
?>