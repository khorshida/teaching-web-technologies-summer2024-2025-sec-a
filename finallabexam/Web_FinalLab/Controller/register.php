<?php
require_once('../Model/employersModel.php');

if(isset($_POST['register'])){
    $employer = array(
        'employer_name' => $_POST['employer_name'],
        'company_name' => $_POST['company_name'],
        'contact_no' => $_POST['contact_no'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
    );
    
    if(addEmployer($employer)){
        header("Location: ../View/Register.php?message=Registration successful! Please login.");
        exit();
    } else {
        header("Location: ../View/Register.php?error=Registration failed! Username may already exist.");
        exit();
    }
}
?>