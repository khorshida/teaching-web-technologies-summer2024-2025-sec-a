<?php
session_start();
require_once('../Model/connection.php');
require_once('../Model/interviewModel.php');

if(!isset($_SESSION['user_id'])) {
    header('location: UserAuthetication.php?error=badrequest');
    exit();
}

$user_id = $_SESSION['user_id'];
$interviews = getInterviewsByUserId($user_id);

// Handle messages like faculty does
if(isset($_REQUEST['error'])){
    $error = $_REQUEST['error'];
    if($error == 'notimeselected'){
        echo "<p style='color:red;'>Please select a time slot.</p>";
    } elseif($error == 'dberror') {
        echo "<p style='color:red;'>Database error occurred.</p>";
    }
}

if(isset($_REQUEST['success'])){
    $success = $_REQUEST['success'];
    if($success == 'scheduled'){
        echo "<p style='color:green;'>Interview scheduled successfully!</p>";
    } elseif($success == 'updated') {
        echo "<p style='color:green;'>Interview updated successfully!</p>";
    } elseif($success == 'deleted') {
        echo "<p style='color:green;'>Interview deleted successfully!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduling</title>
    <link rel="stylesheet" href="../Asset/Khorshida.css">
</head>
<body>
<div class="container">
    <h1>Schedule Your Interview</h1>
    
    <!-- CREATE FORM -->
    <form action="../Controllers/interviewController.php" method="post">
        <input type="hidden" name="action" value="create">
        
        <div class="form-group">
            <select name="timeSlot" class="form-control" required>
                <option value="">-- Select Time --</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="4:00 PM">4:00 PM</option>
            </select>
        </div>

        <div class="form-group">
            <input type="date" name="interviewDate" class="form-control" required 
                   min="<?php echo date('Y-m-d'); ?>">
        </div>

        <button type="submit" class="btn btn-success">Schedule Interview</button>
    </form>

    <h2>Your Scheduled Interviews</h2>
    <?php if(empty($interviews)): ?>
        <p>No interviews scheduled yet.</p>
    <?php else: ?>
        <?php foreach($interviews as $interview): ?>
        <div class="application-card">
            <h3>Interview #<?php echo $interview['id']; ?></h3>
            <p>Time: <?php echo $interview['scheduled_time']; ?></p>
            <p>Date: <?php echo $interview['scheduled_date']; ?></p>
            <p>Status: <?php echo $interview['status']; ?></p>
            
            <!-- UPDATE FORM -->
            <form action="../Controllers/interviewController.php" method="post" style="display: inline;">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $interview['id']; ?>">
                
                <input type="time" name="scheduled_time" value="<?php echo $interview['scheduled_time']; ?>" required>
                <input type="date" name="scheduled_date" value="<?php echo $interview['scheduled_date']; ?>" required>
                <button type="submit" class="btn">Update</button>
            </form>
            
            <!-- DELETE BUTTON -->
            <a href="../Controllers/interviewController.php?action=delete&id=<?php echo $interview['id']; ?>" 
               onclick="return confirm('Are you sure?')">
                <button class="btn btn-danger">Delete</button>
            </a>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <a href="dashboard.php"><button class="btn">Back to Dashboard</button></a>
</div>
</body>
</html>