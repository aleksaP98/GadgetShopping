<?php
DEFINE("PRODUCT_OFFSET",3);
function getFeatured(){
    $products = getAllProducts();
    $num = count($products);
    $random = rand(0,$num-3);
    return executeQuery("SELECT  * FROM products pr inner join pictures pic on pr.picture_id = pic.id LIMIT $random,3");
}
function getAllProducts($limit = -1){
    if($limit < 0):
        return executeQuery("SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id");
    else:
        global $conn;
        try{
        $query = "SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id LIMIT :limit,:offset";
        $prep = $conn->prepare($query);
        $limit = (int)$limit * PRODUCT_OFFSET;
        $offset = PRODUCT_OFFSET;
        $prep->bindParam(":limit",$limit,PDO::PARAM_INT);
        $prep->bindParam(":offset",$offset,PDO::PARAM_INT);
        $prep->execute();
        $products = $prep->fetchAll();
        return $products;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    endif;
}
function getNumOfProducts(){
    return executeQueryOneRow("SELECT COUNT(*) as numOfProducts FROM products");
}
function getPaginationNum(){
    $numOfProducts = getNumOfProducts();
    $paginationNum = $numOfProducts->numOfProducts;
    return ceil($paginationNum / PRODUCT_OFFSET);
}

function getOneProduct($id){
    global $conn;
    try{
        $query = "SELECT *,pr.id FROM products pr  INNER JOIN pictures pic on pr.picture_id = pic.id WHERE pr.id = ?";
        $prep = $conn->prepare($query);
        $prep->execute([$id]);
        $product = $prep->fetch();
        return $product;
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function countProducts($id=null,$value=null){
    global $conn;
    $offset = PRODUCT_OFFSET;

    if($id != null && $value == null ):
    try{
        
        $prep = $conn->prepare("SELECT COUNT(*) as numOfProducts FROM products pr inner join pictures pic on pr.picture_id = pic.id where pr.Category_ID = ?");
        $prep->bindValue(1,$id);
        $prep->execute();
        $numOfProducts = $prep->fetch();
        $pagination = $numOfProducts->numOfProducts;
        return ceil($pagination / $offset);

    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
    elseif($id == null && $value != null):
        try{
            
            $prep = $conn->prepare("SELECT COUNT(*) as numOfProducts FROM products pr inner join pictures pic on pr.picture_id = pic.id where name like ?");
            $prep->bindValue(1,"%$value%");
            $prep->execute();
            $numOfProducts = $prep->fetch();
            $pagination = $numOfProducts->numOfProducts;
            return ceil($pagination / $offset);

        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    elseif($id == null && $value == null):
        try{
            $prep = $conn->prepare("SELECT COUNT(*) as numOfProducts FROM products pr inner join pictures pic on pr.picture_id = pic.id");
            $prep->execute();
            $numOfProducts = $prep->fetch();
            $pagination = $numOfProducts->numOfProducts;
            return ceil($pagination / $offset);

        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    else:
        try{
            $prep = $conn->prepare("SELECT COUNT(*) as numOfProducts FROM products pr inner join pictures pic on pr.picture_id = pic.id where pr.Category_ID = ? AND name LIKE ?");
            $prep->bindValue(1,"%$value%");
            $prep->bindValue(2,$id);
            $prep->execute();
            $numOfProducts = $prep->fetch();
            $pagination = $numOfProducts->numOfProducts;
            return ceil($pagination / $offset);
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    endif;
}


function filterProducts($id = null ,$value = null,$limit){
    global $conn;
    $limit = (int)$limit * PRODUCT_OFFSET;
    $offset = PRODUCT_OFFSET;

    if($id != null && $value == null):
        try{
            global $conn;
            $prep = $conn->prepare("SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id where pr.Category_ID = ? LIMIT ?,?");

            $prep->bindValue(1,$id);
            $prep->bindValue(2,$limit,PDO::PARAM_INT);
            $prep->bindValue(3,$offset,PDO::PARAM_INT);
            $prep->execute();
            return $prep->fetchAll();
        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    elseif($id == null && $value != null):
        try{
        $prep = $conn->prepare("SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id where name like ? limit ?,?");
        $prep->bindValue(1,"%".$value."%");
        $prep->bindValue(2,$limit,PDO::PARAM_INT);
        $prep->bindValue(3,$offset,PDO::PARAM_INT);
        $prep->execute();
        return $prep->fetchAll();
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    elseif($id == null && $value == null):

        return getAllProducts($limit);

    else:
        try{
            $query = "SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id where pr.Category_ID = ? AND name like ? LIMIT ?,?"; 
            $prep = $conn->prepare($query);
            $prep->bindValue(1,$id);
            $prep->bindValue(2,"%".$value."%");
            $prep->bindValue(3,$limit,PDO::PARAM_INT);
            $prep->bindValue(4,$offset,PDO::PARAM_INT);
            $prep->execute();
            return $prep->fetchAll();
            }
            catch(Exception $e){
                return $e->getMessage();
            }
    endif;
}


function sortPrice($value,$ids){
    try{
        global $conn;
        if($ids != null):
            $query = "SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id where (pr.id = ?";
            if(count($ids) == 1)
                    $query.=")";
            for($i = 1;$i<count($ids);$i++):
                if($i+1 == count($ids)):
                    $query.="OR pr.id = ?)";
                else:
                    $query .= " OR pr.id = ?";
                endif;
            endfor;
            if($value == 1)
                $query.= " ORDER BY price ASC";
            else
            $query.= " ORDER BY price DESC";
            $prep = $conn->prepare($query);
            for($i = 0; $i<count($ids);$i++):
                $prep->bindValue($i+1,$ids[$i]);
            endfor;
            $prep->execute();
            return $prep->fetchAll();
        else:
            if($value == 1)
                return executeQuery("SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id ORDER BY price ASC");
            else
            return executeQuery("SELECT  *,pr.id FROM products pr inner join pictures pic on pr.picture_id = pic.id ORDER BY price DESC");
        endif;
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}


function deleteProduct($id){
    try{
        global $conn;
        $query = "delete from products where id = ?";
        $prepare = $conn->prepare($query);
        $prepare->execute([$id]);
        return "Successfully deleted product";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }


}
function updateName($name,$id){
    global $conn;
    try{
    $query = "update products set name = ? where id = ?";
    $prep = $conn->prepare($query);
    $prep->execute([$name,$id]);
    return "Successfully updated name";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function updateDescription($description,$id){
    global $conn;
    try{
    $query = "update products set description = ? where id = ?";
    $prep = $conn->prepare($query);
    $prep->execute([$description,$id]);
    return "Successfully updated description";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function updatePrice($price,$id){
    global $conn;
    try{
    $query = "update products set price = ? where id = ?";
    $prep = $conn->prepare($query);
    $prep->execute([$price,$id]);
    return "Successfully updated price";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function updateCategory($categoryId,$id){
    global $conn;
    try{
    $query = "update products set Category_ID = ? where id = ?";
    $prep = $conn->prepare($query);
    $prep->execute([$categoryId,$id]);
    return "Successfully updated category";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function updatePicture($file,$id){
    $lastId = uploadPictureProduct($file);
    if($lastId > 0):
        try{
            global $conn;
            $queryUpdate = "update products set picture_id = ? where id = ?";
            $prepareUpdate = $conn->prepare($queryUpdate);
            $prepareUpdate->execute([$lastId,$id]);
            var_dump($prepareUpdate);
            return "Successfully updated picture";
        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
            }    
    else:
        return "Picture could not be uploaded";
    endif;       
}
function uploadPictureProduct($file){
    $tmpPath = $file["tmp_name"];
    $type = $file["type"];

    if($type != "image/jpeg" && $type != "image/png")
        return $message = "File must be jpg or png";
    if($file["size"] > 10*1024*1024)
        return $message = "File is too big,Max 10MB";
    
        $fileName = $file["name"];
        global $conn;
        try{
        $insertPic = "insert into pictures values(null,null,null,?)";
        $prep = $conn->prepare($insertPic);
        $prep->execute([$fileName]);

        $lastId = $conn->lastInsertId();
            $namePieces = explode(".",$fileName);
            $extension = end($namePieces);
            $originalName = $lastId . "." . $extension;

            $uploadDir = "assets/images/product_images/";

            $uploadOriginal = $uploadDir.$originalName;
            if(move_uploaded_file($tmpPath,BASE_URL.$uploadOriginal)):
                $query = "update pictures set original = ? where id = ?";
                $prepare = $conn->prepare($query);
                $prepare->execute([$uploadOriginal,$lastId]);
                return $lastId;
            else:
                return 0;
            endif;
        }
        catch(Exception $e){
            return "There was a poblem with the database:".$e->getMessage();
        }
}

function updateProduct($name,$description,$price,$categoryId,$picture,$productId){
    
    $message = ["name"=>"","description"=>"","price"=>"","category"=>"","picture"=>""];
    if(!empty($name))
        $message ["name"] = updateName($name,$productId);
    if(!empty($description))
        $message ["description"] = updateDescription($description,$productId);
    if(!empty($price))
        $message ["price"] = updatePrice($price,$productId);
    if(!empty($categoryId))
        $message ["category"] = updateCategory($categoryId,$productId);
    if(!empty($picture["name"]))
        $message ["picture"] = updatePicture($picture,$productId);  
    return $message;

}

function exportExcel(){
    $excel = new COM("Excel.Application");

    $excel->Visible = 1;
    $excel->DisplayAlerts = 1;
    $workbook = $excel->Workbooks->Open("http://localhost/php1/sajt/gadgets_shop_advanced/data/export/products.xls") or die("did not open");
    $worksheet = $workbook->WorkSheets("products");
    $worksheet->activate;

    $products = getAllProducts();
    $cellA = $worksheet->range("A1");
    $cellA->activate;
    $cellA->value = "Product ID";
    $cellB = $worksheet->range("B1");
    $cellB->activate;
    $cellB->value = "Product Name";
    $cellC = $worksheet->range("C1");
    $cellC->activate;
    $cellC->value = "Product Description";
    $cellD = $worksheet->range("D1");
    $cellD->activate;
    $cellD->value = "Product Price";

    $br = 2;
    foreach($products as $product):
        $cell = $worksheet->range("A$br");
        $cell->activate;
        $cell->value = $product->id;

        $cell = $worksheet->range("B$br");
        $cell->activate;
        $cell->value = $product->name;

        $cell = $worksheet->range("C$br");
        $cell->activate;
        $cell->value = $product->description;

        $cell = $worksheet->range("D$br");
        $cell->activate;
        $cell->value = $product->price;

        $br++;

    endforeach;
    
    $workbook->_SaveAs("http://localhost/php1/sajt/gadgets_shop_advanced/data/export/products.xls",-4143);
    $workbook->Save();

    $workbook->Save = true;
    $workbook->Close;

    $excel->Workbooks->Close();
    $excel->Quit();

    unset($worksheet);
    unset($workbook);
    unset($excel);
}


?>

