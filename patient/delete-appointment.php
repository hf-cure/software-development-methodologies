<?php
session_start();

// Check if user is logged in as patient
if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        header("location: ../login.php");
        exit();
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
    exit();
}

// Import database connection
include("../connection.php");

// Get user ID
$sqlmain = "SELECT pid FROM patient WHERE pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];

if(isset($_GET["id"])){
    $appoid = $_GET["id"];
    
    // First verify that this appointment belongs to the logged-in user
    $verify_sql = "SELECT appoid FROM appointment WHERE appoid = ? AND pid = ?";
    $verify_stmt = $database->prepare($verify_sql);
    $verify_stmt->bind_param("ii", $appoid, $userid);
    $verify_stmt->execute();
    $verify_result = $verify_stmt->get_result();
    
    if($verify_result->num_rows > 0){
        // User owns this appointment, proceed with deletion
        $delete_sql = "DELETE FROM appointment WHERE appoid = ? AND pid = ?";
        $delete_stmt = $database->prepare($delete_sql);
        $delete_stmt->bind_param("ii", $appoid, $userid);
        
        if($delete_stmt->execute() && $delete_stmt->affected_rows > 0){
            // Successfully deleted
            header("location: appointment.php?action=booking-removed&id=" . $appoid);
        } else {
            // Error deleting
            header("location: appointment.php?action=booking-error");
        }
    } else {
        // User doesn't own this appointment or it doesn't exist
        header("location: appointment.php?action=unauthorized");
    }
} else {
    // No ID provided
    header("location: appointment.php");
}
exit();
?>