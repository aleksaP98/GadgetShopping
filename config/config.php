<?php
DEFINE("BASE_URL",$_SERVER["DOCUMENT_ROOT"] . "/php1/sajt/gadgets_shop_advanced/");

DEFINE("ENV", BASE_URL."/config/.env");
DEFINE("VISITLOG", BASE_URL."/data/logs/visitLog.txt");
DEFINE("ERRORLOG", BASE_URL."/data/logs/errorLog.txt");

DEFINE("SERVER",env("SERVER"));
DEFINE("DATABASE",env("DATABASE"));
DEFINE("USERNAME",env("USERNAME"));
DEFINE("PASSWORD",env("PASSWORD"));

function env($name){
    $file = file(ENV);
    foreach($file as $element){
        $row = explode("=",trim($element));
        if($row[0] == $name)
            return $row[1];
    }
}

?>