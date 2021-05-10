<?php
$meni = executeQuery("SELECT * FROM menu");

foreach($meni as $item):
if($item->class_name == "admin" || $item->class_name == "user"):
    if(!empty($_SESSION["account"])):
        if($_SESSION["account"]->Role_ID == 1 && $item->class_name == "admin"):
            

         ?>
         <li class = "<?=$item->class_name?>" ><a href = "<?=$item->path?>"><?=$item->name?></a></li>
         <li class = "logoutli" >
            <a class ="logout" href = "models/login/logout.php">LOGOUT</a>
        </li>
         <?php 
         elseif($_SESSION["account"]->Role_ID == 2 && $item->class_name == "user"):

         ?>
         <li class = "<?=$item->class_name?>" ><a href = "<?=$item->path?>"><?=$item->name?></a></li>
         <li class = "logoutli" >
            <a class ="logout" href = "models/login/logout.php">LOGOUT</a>
        </li>
         <?php endif; endif; else: ?>

    <li class ="<?=$item->class_name?>"><a href ="<?=$item->path ?>"><?=$item->name?></a></li>
    
     <?php endif; endforeach;?>
