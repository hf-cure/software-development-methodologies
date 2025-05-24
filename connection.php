<?php
$servername = "localhost";
$username = "root";  
$password = ""; 
$dbname = "docappoint"; 


error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$database = mysqli_connect($servername, $username, $password, $dbname);

if ($database->connect_error) {
    die("Connection failed : " . $database->connect_error);
}


?>

