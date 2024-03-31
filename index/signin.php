<?php

session_start();
include("../database/db.php");
$errors=[];

$remember_me = isset($_POST['remember_me']);

if(isset($_POST['login'])){

    $sigInEmail=$_POST['email2'];
    if(empty($sigInEmail)){
        $error_msg['Email2'] = "Email Address is Required";
    }
    
    $signInPassword=$_POST['password2'];
        if(empty($signInPassword)){
            $error_msg['Password2'] = "Password is Required";
        }
    

    if($sigInEmail && $signInPassword){
    $signInPassword=md5($signInPassword);
    $sql="SELECT * FROM students WHERE stu_email='".$sigInEmail."' AND stu_pass='".$signInPassword."'";
    if($user_data=$conn->query($sql)){
        if($user_data->num_rows > 0){
            $user=mysqli_fetch_assoc($user_data);
            $_SESSION['stu_id']=$user['stu_id'];
            $_SESSION['stu_email']=$user['stu_email'];
            if ($remember_me) {
                $cookie_expire = time() + (86400 * 30);
                setcookie("remember_stu_id", $user['stu_id'], $cookie_expire, "/");
                setcookie("remember_stu_email", $user['stu_email'], $cookie_expire, "/");
            }
            header("Location:home.php");
            exit;
            
        }else{
            $errors[]="Recheck Email & Password";
        }
    }else{
        $errors[]="Logging Failed";
    }
}
}
include("login-signup.php");
?>