<?php
session_start();

// Lưu thời gian còn lại của quiz vào session nếu người dùng đang làm quiz
if (isset($_SESSION['quiz_start_time'])) {
    $elapsedTime = time() - $_SESSION['quiz_start_time'];
    $_SESSION['remaining_quiz_time'] -= $elapsedTime;
}

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

session_destroy();
header('Location:../index/home.php');
?>
