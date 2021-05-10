<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST["send"])):
    include "../../config/connection.php";
    include "../../phpmailer/vendor/autoload.php";
    session_start();

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    try{
        $upit = "SELECT * FROM users 
        WHERE username = ? AND password = ?";
        $prepared = $conn->prepare($upit);
        $prepared->execute([$username,$password]);
        $user = $prepared->fetch();
    }
    catch(Exception $e){
        $error = $e->getMessage();
        logUserError("database",$error);
        header("location:../../index.php?error=".$error);
    }
    if($user):
        $_SESSION["account"] = $user;
        header("location:../../index.php");
    else:
        $query = "SELECT * FROM users where username = ?";
        $prep= $conn->prepare($query);
        $prep->execute([$username]);
        $found = $prep->fetch();
        if($found){
            try{
            $mail = new PHPMailer(TRUE);
            $mail->setFrom("gadget.shop.advanced@gmail.com","Admin");
            $mail->addAddress($found->email,"User");
            $mail->Subject = "Incorrect login";
            $mail->Body = "Failed to login to gadget shop advanced,incorrect password";

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "gadget.shop.advanced@gmail.com";
            $mail->Password = "predragovic98";
            $mail->SMTPSecure = "ssl";
            if(!$mail->send()){
                $error = "username or password did not match";
                header("location:../../index.php?error=".$error.",".$mail->ErrorInfo);
            }
            var_dump($mail->send());
            }
            catch(Exception $e){
                $error = $e->getMessage();
                logUserError("mail",$error);
                header("location:../../index.php?error=".$error);
            }
        }

        $error = "username or password did not match";
        logUserError("login",$error);
        header("location:../../index.php?error=$error");
        endif;
    else:
        http_response_code(400);
    endif;

?>