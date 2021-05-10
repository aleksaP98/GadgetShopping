<?php
$user = getOne($_SESSION["account"]->id);

$userPictures = getPictures($_SESSION["account"]->id);

?>
<div id="article">
    <div id = "message">
    <p><?=@ $_GET["message"];?></p>
    </div>
    <p class = "pText">CURRENT PROFILE PICTURE</P>
    <img src = "<?=$user->profile?>"/>
    <hr>
    <p class = "pText">CHOSE NEW PROFILE PICTURE</p>
    <?php  foreach($userPictures as $picture):?>
    <a  href = "models/user/updateUser.php?idUser=<?=$_SESSION["account"]->id?>&idPicture=<?=$picture->id?>"><img  class = "profilePicture" src = "<?=$picture->profile?>"/></a>
<?php endforeach;?>

    
</div>