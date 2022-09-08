<?php

include "mysqli_connect.php"; // Using database connection file here

$id = $_GET['userID']; // get appID through query string
$photo = $_GET['profileImage'];


$path = $photo;




$del = mysqli_query($con,"DELETE FROM user WHERE userID = '$id'"); // delete query


if($del)
{
    unlink($path); 
    session_destroy();
    mysqli_close($con); // Close connection
    header("location:logout.php"); // redirects to all records page
    session_destroy();
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>