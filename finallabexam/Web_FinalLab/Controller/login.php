<?php
session_start();
require_once('../Model/employersModel.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $employer = array(
        'username' => $username,
        'password' => $password
    );
    
    if(employerLogin($employer)){
        $_SESSION['username'] = $username;
        header("Location: ../View/dashboard.php");
        exit();
    } else {
        header("Location: ../View/Register.php?error=Invalid username or password");
        exit();
    }
}
?>