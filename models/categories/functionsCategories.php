<?php
function getAllCategories(){
    return executeQuery("select * from categories");
}

?>