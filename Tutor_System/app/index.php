<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$_SESSION['login_id'] = $username;

if ($role== 'tutee') {
    header("Location: homepage-tuteelogin.php");
}

if ($role=='tutor'){
    header("Location: homepage-tutorlogin.php");
       
}
    

