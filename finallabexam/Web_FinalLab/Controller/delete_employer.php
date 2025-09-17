<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../View/Register.php");
    exit();
}

require_once('../Model/employersModel.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    if(deleteEmployer($id)){
        header("Location: ../View/dashboard.php?message=Employer deleted successfully");
        exit();
    } else {
        header("Location: ../dashboard.php?error=Failed to delete employer");
        exit();
    }
}
?>