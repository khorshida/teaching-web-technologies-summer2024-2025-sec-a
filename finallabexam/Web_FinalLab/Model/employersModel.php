<?php
    require_once('connection.php');

    
    function employerLogin($employer){
        $con = getConnection();
        $sql = "SELECT * FROM employers WHERE username='{$employer['username']}' AND password='{$employer['password']}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    
    
    function getEmployerById($id){
        $con = getConnection();
        $sql = "SELECT * FROM employers WHERE id={$id}";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

   
    function addEmployer($employer){
        $con = getConnection();
        $sql = "INSERT INTO employers (employer_name, company_name, contact_no, username, password) 
                VALUES ('{$employer['employer_name']}', '{$employer['company_name']}', '{$employer['contact_no']}', '{$employer['username']}', '{$employer['password']}')";
        
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }

  
    function deleteEmployer($id){
        $con = getConnection();
        $sql = "DELETE FROM employers WHERE id={$id}";
        
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }

    
    function getAllEmployers(){
        $con = getConnection();
        $sql = "SELECT * FROM employers";
        $result = mysqli_query($con, $sql);
        $employers = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($employers, $row);
        }

        return $employers;
    }

   
    function updateEmployer($employer){
        $con = getConnection();
        $sql = "UPDATE employers SET 
                employer_name='{$employer['employer_name']}', 
                company_name='{$employer['company_name']}', 
                contact_no='{$employer['contact_no']}', 
                username='{$employer['username']}' 
                WHERE id={$employer['id']}";
        
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            return false;
        }
    }

  
    function searchEmployers($searchTerm){
        $con = getConnection();
        $sql = "SELECT * FROM employers 
                WHERE employer_name LIKE '%{$searchTerm}%' 
                OR company_name LIKE '%{$searchTerm}%' 
                OR username LIKE '%{$searchTerm}%' 
                OR contact_no LIKE '%{$searchTerm}%'";
        
        $result = mysqli_query($con, $sql);
        $employers = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($employers, $row);
        }

        return $employers;
    }
?>