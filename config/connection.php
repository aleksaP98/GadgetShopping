<?php
require_once "config.php";

logSiteVisit();

try{
$conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";characterset=utf-8",USERNAME,PASSWORD);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    echo $e->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function executeQueryOneRow($query){
    global $conn;
    return $conn->query($query)->fetch();
}

function logSiteVisit(){
    $open = fopen(VISITLOG, "a");
    if($open){
        fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$_SERVER['REQUEST_TIME']}\t{$_SERVER['REMOTE_ADDR']}\n");
        fclose($open);
    }
}
function logUserError($error,$message){
    $open = fopen(ERRORLOG, "a");
    if($open){
        fwrite($open,"$error:\t$message\n");
        fclose($open);
    }


}

?>
