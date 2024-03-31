<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$host = "localhost";
$user = "root";
$database = "KnowledgeNest";
$password = "";



if ($conn = new mysqli($host, $user, $password, $database)) {

} else {
    echo 'Database Error';
    exit;
}
?>