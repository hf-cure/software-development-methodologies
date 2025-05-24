<?php
session_start();
include("../connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlmain = "select * from patient where pid='$id'";
    $result = $database->query($sqlmain);
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Patient not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>