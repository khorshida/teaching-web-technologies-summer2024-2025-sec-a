<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
    exit();
}

$message = isset($_GET['message']) ? $_GET['message'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Portal - Login</title>
</head>
<body>
    <h1>Job Portal Admin</h1>
    
    <?php if($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <?php if($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <h2>Login</h2>
    <form action="../Controller/login.php" method="POST">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
    
    <hr>
    
    <h2>Register New Employer</h2>
    <form action="../Controller/register.php" method="POST">
        <table>
            <tr>
                <td>Employer Name:</td>
                <td><input type="text" name="employer_name" required></td>
            </tr>
            <tr>
                <td>Company Name:</td>
                <td><input type="text" name="company_name" required></td>
            </tr>
            <tr>
                <td>Contact No:</td>
                <td><input type="text" name="contact_no" required></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="register" value="Register"></td>
            </tr>
        </table>
    </form>
</body>
</html>