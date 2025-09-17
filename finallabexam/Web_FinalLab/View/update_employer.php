<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: Register.php");
    exit();
}

require_once('../Model/employersModel.php');

$employer = null;
if(isset($_GET['id'])){
    $employer = getEmployerById($_GET['id']);
    if(!$employer){
        header("Location: dashboard.php?error=Employer not found");
        exit();
    }
}

$message = isset($_GET['message']) ? $_GET['message'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Employer</title>
</head>
<body>
    <h1>Update Employer</h1>
    <a href="dashboard.php">Back to Dashboard</a>
    
    <?php if($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <?php if($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if($employer): ?>
    <form action="../Controller/update_employer.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $employer['id']; ?>">
        <table>
            <tr>
                <td>Employer Name:</td>
                <td><input type="text" name="employer_name" value="<?php echo $employer['employer_name']; ?>" required></td>
            </tr>
            <tr>
                <td>Company Name:</td>
                <td><input type="text" name="company_name" value="<?php echo $employer['company_name']; ?>" required></td>
            </tr>
            <tr>
                <td>Contact No:</td>
                <td><input type="text" name="contact_no" value="<?php echo $employer['contact_no']; ?>" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $employer['username']; ?>" required></td>
            </tr>
            <tr>
                <td>Password (leave blank to keep current):</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update_employer" value="Update Employer"></td>
            </tr>
        </table>
    </form>
    <?php endif; ?>
</body>
</html>