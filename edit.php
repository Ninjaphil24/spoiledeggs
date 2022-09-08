<?php

// The session start works in conjuction with the logged in issue.
session_start();
$loggedIn = false;
include ('helper.php');


if (isset($_SESSION['loggedIn']) && isset($_SESSION['firstName'])) {
    $loggedIn = true;
}

if(isset($_SESSION['loggedIn']) && isset($_SESSION['userID'])){
    require ('mysqli_connect.php');
    $loggedIn = true;
    $user = get_user_info($con, $_SESSION['userID']);
}

include 'mysqli_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <title>Edit</title>
    <link rel="stylesheet" href="vote.css">
</head>
<body>
<div class='box'>
           <h3>Edit your comment</h3>
</div>
    <?php

    $id = $_POST['id'];
    $comment = $_POST['comment'];
    echo  "<div class='commentsin'>
     <form method='post' action='".editComments($con)."'>
     <input type='hidden' name='id' value='".$id."'>
           <textarea placeholder='Write a comment.' type='text' name='comment' id='comment'>".$comment."</textarea><br> <br>
         <button type='submit' name='editcomment' value='editcomment' style='padding:5px;'><span>&nbsp;&nbsp;Insert&nbsp;&nbsp;</span></button></div>
     </form>";
     function editComments($con){
        if (isset($_POST['editcomment'])) {
        $id = $con->real_escape_string($_POST['id']);
        $comment= $con->real_escape_string($_POST['comment']);
    
        $sql = "UPDATE comments SET comment='$comment' WHERE id='$id'";
        $result = $con->query($sql);
        header("Location: user.php");
        }}


    ?>



</body>
</html>
