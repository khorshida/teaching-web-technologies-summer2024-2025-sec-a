<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../View/Register.php");
    exit();
}

require_once('../Model/employersModel.php');

if(isset($_POST['add_employer'])){
    $employer = array(
        'employer_name' => $_POST['employer_name'],
        'company_name' => $_POST['company_name'],
        'contact_no' => $_POST['contact_no'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
    );
    
    if(addEmployer($employer)){
        header("Location: ../View/dashboard.php?message=Employer added successfully");
        exit();
    } else {
        header("Location: ../dashboard.php?error=Failed to add employer");
        exit();
    }
}
?>