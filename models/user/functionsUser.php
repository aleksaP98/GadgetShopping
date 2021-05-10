<?php

function getOne($id){
    global $conn;
    try{
        $query = "SELECT *,u.id FROM users u  INNER JOIN pictures p on u.id_profile_pic = p.id WHERE u.id = ?";
        $prep = $conn->prepare($query);
        $prep->execute([$id]);
        $user = $prep->fetch();
        return $user;
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function getAllUsers(){
    return executeQuery("select *,u.id from users u inner join pictures p on u.id_profile_pic = p.id inner join roles r on r.id = u.Role_id");
}
function getPictures($id){
    global $conn;
    try{
        $query = "SELECT * FROM pictures p  INNER JOIN user_pictures up on p.id = up.id_picture WHERE up.id_user = ?";
        $prep = $conn->prepare($query);
        $prep->execute([$id]);
        $user = $prep->fetchAll();
        return $user;
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}

function updateProfilePicture($idUser,$idPicture){
    global $conn;try{
        $query = "update users set id_profile_pic = ? where id = ?";
        $prep = $conn->prepare($query);
        $prep->execute([$idPicture,$idUser]);
        return $message = "Profile picture changed successfully";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}
function uploadPictureUser($file,$userId,$isProfile = false){
    $tmpPath = $file["tmp_name"];
    $type = $file["type"];
    list($width,$height) = getimagesize($tmpPath);
    $newDimensions = 300;

    if($width < $newDimensions || $height <$newDimensions)
        return $message = "Picture cant be smaller than 300x300";
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

        $uploadDir = "assets/images/user_images/";

        switch($type):
            case "image/jpeg":
                $emptyImage = imagecreatefromjpeg($tmpPath);
            break;
            case "image/png":
                $emptyImage = imagecreatefrompng($tmpPath);
            break;
        endswitch;
        $newImage = imagecreatetruecolor($newDimensions,$newDimensions);
        imagecopyresampled($newImage,$emptyImage,0,0,0,0,$newDimensions,$newDimensions,$width,$height);

        $uploadProfile = $uploadDir.$lastId."_profile.".$extension;
        switch($type):
            case "image/jpeg":
                $newImage = imagejpeg($newImage,BASE_URL.$uploadProfile);
            break;
            case "image/png":
                $newImage = imagepng($newImage,BASE_URL.$uploadProfile);
            break;
        endswitch;
        $uploadOriginal = $uploadDir.$originalName;
        if(move_uploaded_file($tmpPath,BASE_URL.$uploadOriginal)):
            $query = "update pictures set original = ?,profile=? where id = ?";
            $prepare = $conn->prepare($query);
            $prepare->execute([$uploadOriginal,$uploadProfile,$lastId]);

            $updateUserPic = "insert into user_pictures values(null,?,?)";
            $result = $conn->prepare($updateUserPic);
            $result->execute([$userId,$lastId]);

            if($isProfile):
                $updateProfilePic = "update users set id_profile_pic = ? where id = ?";
                $prepPic = $conn->prepare($updateProfilePic);
                $prepPic->execute([$lastId,$userId]);
                return $message = "Image successfully changed";
            else:
                return "image successfully uploaded";
            endif;
        else:
            return "Image could not be uploaded";
        endif;
            }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
}

function adminUpdate($username,$email,$password,$confirmPass,$role,$id,$file){

    $message = ["username"=>"","email"=>"","password"=>"","role"=>"","picture"=>""];
    if(!empty($username))
        $message ["username"] = updateUsername($username,$id);
    if(!empty($email))
        $message ["email"] = updateEmail($email,$id);
    if(!empty($password) && !empty($confirmPass))
        $message ["password"] = updatePassword($password,$confirmPass,$id);
    if(!empty($role))
        $message ["role"] = updateRole($role,$id);
    if(!empty($file))
        $message ["picture"] = uploadPictureUser($file,$id,true);  
    return $message;

}
function updateRole($role,$id){
    global $conn;
    try{
        $query = "update users set Role_ID = ? where id = ?";
        $prep = $conn->prepare($query);
        $prep->execute([$role,$id]);
        return $message = "Role successfully updated";
    }
    catch(Exception $e){
        return "There was a problem with the database:".$e->getMessage();
    }
}

function updateUsername($username,$id){
    global $conn;
    
    $regUser = "/^([A-z]\s*){2,15}/";
    $message;
    if(preg_match($regUser,$username)):
        try{
            $query = "UPDATE users set username = ? where id = ?";
            $prepare = $conn->prepare($query);
            $prepare->execute([$username,$id]);
            return $message = "Username successfully updated";
        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    else:
       return $message = "Username must start with a letter,Min length 2,Max 15";
    endif;
}

function updateEmail($email,$id){
    global $conn;
    
    $regEmail = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    $message;
    if(preg_match($regEmail,$email)):
        try{
            $query = "UPDATE users set email = ? where id = ?";
            $prepare = $conn->prepare($query);
            $prepare->execute([$email,$id]);
            return $message = "Email successfully updated";
        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    else:
       return $message = "Email is not in good format";
    endif;
}

function updatePassword($noviPass,$noviPass2,$id){
    global $conn;
    
    $greskaPass = "";
    $regPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";
    
    $query = "select password from users where id = ?";
    $prepare = $conn->prepare($query);
    $prepare->execute([$id]);
    $currentPassword = $prepare->fetch();
    
    $newPasswordHash = md5($noviPass);

    if(!preg_match($regPass,$noviPass))
            $greskaPass = "Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15";
    if($noviPass != $noviPass2)
            $greskaPass = "Passwords do not match";
    if($currentPassword == $newPasswordHash)
        $greskaPass = "New password cant be the same as old password";
    
    if($greskaPass == ""):
        try{
            $priprema = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $priprema->execute([$newPasswordHash,$id]);
            return $greskaPass = "Password successfully updated";
        }
        catch(Exception $e){
            return "There was a problem with the database:".$e->getMessage();
        }
    else:
        return $greskaPass;
    endif;
}


function userRegister($username,$email,$password,$confirmPass,$role = 2,$picture = null){
    global $conn;
    $regUser = "/^([A-z]\s*){2,15}/";
	$regEmail = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    $regPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";

    $greske = [];

    if(!preg_match($regUser,$username))
        $greske[] = "Username must beggin with a letter,MIN 2,MAX 15 characters";
    if(!preg_match($regEmail,$email))
        $greske[] = "Email is not in good format";
    if(!preg_match($regPass,$password))
        $greske[] = "Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15";
    if($password != $confirmPass)
        $greske[] = "password does not match";
    
        if(count($greske) == 0):
            try{
			$password = md5($password);
			$upitInsert = "INSERT INTO users(username,email,password,Role_ID,id_profile_pic)
			VALUES(?,?,?,?,?)";
			$priprema = $conn->prepare($upitInsert);
            $rezultat = $priprema->execute([$username,$email,$password,$role,26]);
                if($picture == null):
                    return true;
                else:
                    $lastInserted = $conn->lastInsertId();
                   return uploadPicture($picture,$lastInserted,true);
                endif;
            }
            catch(Exception $e){
                return "There was a problem with the database:".$e->getMessage();
            }
        else:
            
            return $greske;
        endif;
}

function exportWord(){
    $word = new COM("Word.Application");
    
    $word->Visible = 1;

    $word->Documents->Open("http://localhost/php1/sajt/gadgets_shop_advanced/data/export/aboutMe.doc");

    $word->Selection->TypeText(`
        Full Name:Aleksa Predragović
        Index Number:289/18
        I was born in Belgrade on the 14th of March 1998. I graduated electro-technical high school "Nikola Tesla" profile: "Electro-Technician of Telecommunications".
        I'm currently studding on the ICT College of applied studies, profile: "Web Programming",index number:289/18.
        My goal for this website is to show the functions of PHP`);
    $word->Documents[1]->SaveAs("http://localhost/php1/sajt/gadgets_shop_advanced/data/export/aboutMe.doc");

    $word->Quit;

    unset($word);

}
?>