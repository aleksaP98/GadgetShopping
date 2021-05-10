<?php
session_start();
if(isset($_SESSION["account"])):
    
    
    $_SESSION["account"] = null;
    header("location:../../index.php");
endif;
?>