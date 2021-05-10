<?php
$user = getOne($_SESSION["account"]->id);
?>
<div id="article">
    <div id = "message">
    <p><?=@ $_GET["message"];?></p>
    </div>
    <a href="index.php?page=profilePic"><img src = "<?=$user->profile?>" id = "profilePic"/></a>
    <div class ="userInfo">Account Information<hr>
        
        <p>Username:<b><?=$user->username?></b><a class= "editLink" id = "editUsername" href = "#">Edit</a></p>
        <p>Email:<b><?=$user->email?></b><a class ="editLink" id = "editEmail" href = "#">Edit</a></p>
        <button><a id = "editPass" href = "#">Change Password</a></button>
        <button><a id = "uploadImage" href = "#">Upload Image</a></button>
        <form class = "editForme" id = "formPass" action = "models/user/updateUser.php" method = "post">
            <input type = "password" name = "editPass" placeholder = "New Password"/>
            <input type = "password" name = "editPass2" placeholder = "Repeat new Password"/>
            <input type = "submit" name ="sendPassword"/>
        </form>
    </div>
</div>
<div id="sidebar2">
    <form class = "editForme" id = "formUsername" action = "models/user/updateUser.php" method = "post">
        <input type = "text" name = "editUsername" placeholder = "New Username"/>
        <input type = "submit" name ="sendUsername"/>
    </form></br>
    <form class = "editForme" id = "formEmail" action = "models/user/updateUser.php" method = "post">
        <input type = "text" name = "editEmail" placeholder = "New Email"/>
        <input type = "submit" name ="sendEmail"/>
    </form>
    <form action = "models/user/updateUser.php" method = "post" class = "editForme" id = "formPicture" enctype="multipart/form-data">
            <p class ="pText">UPLOAD IMAGE TO PROFILE</p>
            <input type = "file" name = "file"/>
            <input type = "submit" name = "sendPicture"  value ="Upload Picture" />
        </form>
            
</div>

