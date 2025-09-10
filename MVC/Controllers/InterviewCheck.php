<?php
session_start();

require_once('../Model/connection.php');
require_once('../Model/interviewModel.php');

// Check if user is logged in 
if(!isset($_SESSION['status']) || !isset($_COOKIE['status'])){
    header('location: ../Views/UserAuthetication.php?error=badrequest');
    exit();
}

$user_id = $_SESSION['user_id'];
$scheduled_time = $_POST['timeSlot'];
$scheduled_date = $_POST['interviewDate'];

// Server-side validation
if($scheduled_time == "" || $scheduled_time == "-- Select a time --"){
    header('location: ../Views/InterviewScheduling.php?error=notimeselected');
    exit();
}

if($scheduled_date == "") {
    header('location: ../Views/InterviewScheduling.php?error=nodateselected');
    exit();
}

$interview = [
    'user_id' => $user_id,
    'scheduled_time' => $selectedTime,
    'scheduled_date' => $selectedDate
];

if(addInterview($interview)) {
    $_SESSION['scheduled_time'] = $selectedTime;
    header('location: ../Views/InterviewScheduling.php?success=scheduled');
} else {
    header('location: ../Views/InterviewScheduling.php?error=dberror');
}
exit();
?>
