<?php
include "../../config/connection.php";
header("content-type:application/json");

$users = executeQuery("select *,u.id from users u inner join pictures p on u.id_profile_pic = p.id inner join roles r on r.id = u.Role_id");
echo json_encode($users);
http_response_code(200);

?>