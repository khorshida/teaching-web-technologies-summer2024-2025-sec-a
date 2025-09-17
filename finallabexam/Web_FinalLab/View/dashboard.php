<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: Register.php");
    exit();
}

if(isset($_GET['logout'])){
    session_destroy();
    header("Location: Register.php");
    exit();
}

require_once('../Model/employersModel.php');
$employers = getAllEmployers();

$message = isset($_GET['message']) ? $_GET['message'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
$search_results = [];
$search_performed = false;

if(isset($_GET['search'])){
    $search_term = $_GET['search'];
    $search_results = searchEmployers($search_term);
    $search_performed = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>! | <a href="Register.php?logout=1">Logout</a></p>
    
    <?php if($message): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <?php if($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <h2>Search Employers</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by name, company, username...">
        <input type="submit" value="Search">
    </form>
    
    <h2>Employers List</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Employer Name</th>
            <th>Company Name</th>
            <th>Contact No</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <?php 
        $display_data = $search_performed ? $search_results : $employers;
        foreach($display_data as $employer): 
        ?>
        <tr>
            <td><?php echo $employer['id']; ?></td>
            <td><?php echo $employer['employer_name']; ?></td>
            <td><?php echo $employer['company_name']; ?></td>
            <td><?php echo $employer['contact_no']; ?></td>
            <td><?php echo $employer['username']; ?></td>
            <td>
                <a href="update_employer.php?id=<?php echo $employer['id']; ?>">Edit</a> |
                <a href="../Controller/delete_employer.php?id=<?php echo $employer['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Add New Employer</h2>
    <form action="../Controller/add_employer.php" method="POST">
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
                <td><input type="submit" name="add_employer" value="Add Employer"></td>
            </tr>
        </table>
    </form>
</body>
</html>