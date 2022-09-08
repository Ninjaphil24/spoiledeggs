<?php

include "mysqli_connect.php"; // Using database connection file here

$id = $_GET['id']; // get appID through query string






$del = mysqli_query($con,"DELETE FROM comments WHERE id = '$id'"); // delete query


if($del)
{
    mysqli_close($con); // Close connection
    header("location:user.php#comment"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>