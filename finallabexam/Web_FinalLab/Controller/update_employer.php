<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../View/Register.php");
    exit();
}

require_once('../Model/employersModel.php');

if(isset($_POST['update_employer'])){
    $employer_data = array(
        'id' => $_POST['id'],
        'employer_name' => $_POST['employer_name'],
        'company_name' => $_POST['company_name'],
        'contact_no' => $_POST['contact_no'],
        'username' => $_POST['username']
    );
    
    
    if(!empty($_POST['password'])){
        $employer_data['password'] = $_POST['password'];
    }
    
    if(updateEmployer($employer_data)){
        header("Location: ../View/dashboard.php?message=Employer updated successfully");
        exit();
    } else {
        header("Location: ../update_employer.php?id={$_POST['id']}&error=Failed to update employer");
        exit();
    }
}
?>