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

$eid= mysqli_real_escape_string($con, $_GET['eid']);
     $reviewtype= mysqli_real_escape_string($con, $_GET['reviewtype']);
     $title = mysqli_real_escape_string($con, $_GET['title']);
     $venue= mysqli_real_escape_string($con, $_GET['venue']);
     $day_select = mysqli_real_escape_string($con, $_GET['day_select']);
     $select_month = mysqli_real_escape_string($con, $_GET['select_month']);
     $year = mysqli_real_escape_string($con, $_GET['year']);

   if (isset($_POST['insert'])) {

     $comment= $con->real_escape_string($_POST['comment']);


     $errors = array();

     if(empty($comment)) {
       $errors['r'] = "Review Required";
     }

     if (count($errors)==0) {

        $query = "INSERT INTO comments (userID, entryID, comment, createdOn) VALUES ('".$_SESSION['userID']."','$eid','$comment',NOW())";


       $result = mysqli_query($con,$query);


     if ($result) {
       header("Location: article.php?eid=$eid&reviewtype=$reviewtype&title=$title&venue=$venue&day_select=$day_select&select_month=$select_month&year=$year#comment");
   die();

       // echo "<script>alert('done')</script>"
     }
     else{

       echo "<script>alert('failed')</script>";
     }
     }
   }
   



// $con = new mysqli('localhost', 'root', 'virtuoso', 'spoiledeggs');

// Connecting LogIn Modal with Database; don't forget Ajax script that goes with it.

if (isset($_POST['logIn'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $con->query("SELECT * FROM user WHERE email='$email'");
        if ($sql->num_rows == 0)
            exit('failed');
        else {
            $data = $sql->fetch_assoc();
            $passwordHash = $data['password'];

            if (password_verify($password, $passwordHash)) {
                $_SESSION['loggedIn'] = 1;
                $_SESSION['firstName'] = $data['firstName'];
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['userID'];
                  $_SESSION['profileImage'] = $files['profileImage'];

                exit('success');
            } else
                exit('failed');
        }
    } else
        exit('failed');
}


// Echoing the number of entries, in this case comments

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spoiled Eggs</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Modal Start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Modal End -->
   

    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="article.css">
  </head>
  <body>

<section>
      <div class="crop">
      <img src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : './img/beard.png'; ?>" alt="">
            </div>

    <div class="user">

      <?php
      if (!$loggedIn)
          echo '<h3>You are not logged in!</h3>';
      else
          echo '<h3>Hello '.$_SESSION['firstName'].' </h3>'
      ?>
</div>

</section>


    <header>
    <a href="index.php" class="logo"> <img src="img/egglogo.png" alt=""> </a>

      <div class="menu-toggle"></div>
      <nav>
        <ul>
        <li><a href="index.php">Home</a></li>
          <li><a href="entry.php"class="active">Review</a></li>
          <li><a href="#modal" data-toggle="modal" data-target="#InstructionsModal">Instructions</a></li>
          <li><a href="#modal" data-toggle="modal" data-target="#contactModal">Contact</a></li>
          <li>
          <li><a href="www.offenbachgp.com" target="_blank">Offenbach GP</a></li>          
            <?php
            if (!$loggedIn)
                echo '
                <li> <a href="#modal" data-id=".$row["id"]." data-toggle="modal" data-target="#logInModal">Login/Register</a></li>';
            else
                echo '<li><a href="user.php">My profile</a></li>
                <li> <a href="logout.php">Log Out</a></li>
                ';
            ?>
        </ul>
      </nav>
      <div class="clearfix"></div>
    </header>

    <div class="modal" id="InstructionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Instructions</h5>
                </div>
                <div class="modal-body">
                    <h3>  
                    Applaud as many times as you like or throw as many eggs as you like without logging in. <br> <br>
                    Please log in to write a review. <br> <br> 
                    If a website has been included in the original review, it will appear and the "Visit Website" button will be active. <br> <br>
                    If a video has been included, the "Click to see Video" button will be active. </h3>
                  </div>
                  <div class="modal-footer">
                    <button data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal" id="contactModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact</h5>
                </div>
                <div class="modal-body">
                    <h3>For any problems please contact the administrator of this site on spoiledeggs.eu5@gmail.com</h3>
                  </div>
                  <div class="modal-footer">
                    <button data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

    <div class="modal" id="logInModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log In Form</h5>
                </div>
                <div class="modal-body">
                    <input type="email" id="userLEmail" class="form-control" placeholder="Your Email">
                    <input type="password" id="userLPassword" class="form-control" placeholder="Password">
                </div>
                <div class="modal-footer">
              <ul><li><a href="register.php">Register</a></li></ul>
                    <button id="loginBtn">Log In</button>
                    <button data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


       <div class="search-user">
       <form action="search.php" method="POST">
           <input type="text" name="search" placeholder="Search">
           <button type="submit" name="submit-search"><i class="fa fa-search" aria-hidden="true"></i></button>
         </form>

     </div> <br>
     <?php
     // $id = mysqli_real_escape_string($con, $_GET['id']);
     $eid= mysqli_real_escape_string($con, $_GET['eid']);
     $reviewtype= mysqli_real_escape_string($con, $_GET['reviewtype']);
     $title = mysqli_real_escape_string($con, $_GET['title']);
     $venue= mysqli_real_escape_string($con, $_GET['venue']);
     $day_select = mysqli_real_escape_string($con, $_GET['day_select']);
     $select_month = mysqli_real_escape_string($con, $_GET['select_month']);
     $year = mysqli_real_escape_string($con, $_GET['year']);

     // $eid= $_GET['eid'];
     // $reviewtype= $_GET['reviewtype'];
     // $title = $_GET['title'];
     // $venue= $_GET['venue'];
     // $day_select = $_GET['day_select'];
     // $select_month = $_GET['select_month'];
     // $year = $_GET['year'];


       $sql = "SELECT * FROM entry WHERE title='$title' AND venue='$venue' AND day_select='$day_select' AND select_month='$select_month' AND year='$year'";

   //--  INNER JOIN comments ON entry.id = entryID ORDER BY comments.id DESC LIMIT $start, 20";--//
       $result = mysqli_query($con, $sql);
       $queryResults = mysqli_num_rows($result);

       if($queryResults > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
          if ($row['link'] != null){          
          echo "<div class='link'>
           <iframe src='".$row['link']."' width='100%' height='250'></iframe></div>
           <a href='".$row['link']."' class='myButton' target='_blank'>Visit Website<a>
           </div> <br> <br>";}
           else {
             echo "";
           }
           if ($row['video'] != null){          
            echo "<div class='video'>
        <a href='".$row['video']."' target='_blank'>
        <div class='text'>
        <span>Click to see Video</span>
        </div></a></div>";
           }
           else {
             echo "";
           }
           echo "<div class='box'>
           <h3>".$row['title']."</h3>
           <p>".$row['venue']."</p>
           <p></p>
           <p>Date of ".$row['reviewtype']." (D,M,Y): ".$row['day_select']."&nbsp;".$row['select_month']."&nbsp;".$row['year']."</p><br>
           </div>";?>
           <br> <br>
   </div>

   <div class="like"> 
      <div class="text">
       <a href="javascript:void(0)" class="">
         <span class="fa fa-hand-paper-o" onclick="like_update('<?php echo $row['eid']?>')"> &nbsp;&nbsp;Applause (<span id="like_loop_<?php echo $row['eid']?>"><?php echo $row['like_count']?></span>)</span>
       </a>
       </div> 
  </div> <br> <br>
  
  <div class="judgevote">
    <div class="text"> 
      <a href="javascript:void(0)" class="">
        <img src="img/eggfavicon.png" style="width:40px;"><span class="fa fa-eggs" onclick="dislike_update('<?php echo $row['eid']?>')">&nbsp;&nbsp;Eggs Thrown (<span id="dislike_loop_<?php echo $row['eid']?>"><?php echo $row['dislike_count']?></span>)</span></a>
   <?php }} ?>
  </div>
  </div> <br> <br>



<?php
if (!$loggedIn)
       echo '<div class="logout">
       <div class="text">
       <a href="#modal" data-toggle="modal" data-target="#logInModal"><span>Please log in to write a review!</span></a></div></div>';
   else echo "
   <div class='commentsin'>
    <form method='post'>
          <textarea placeholder='Write a comment.' type='text' name='comment' id='comment'></textarea><br> <br>
        <button type='submit' name='insert' value='insert' style='padding:5px;'><span>&nbsp;&nbsp;Insert&nbsp;&nbsp;</span></button></div>
    </form>"?>
<br>
       <p class="text-danger"> <?php if(isset($errors['r'])) echo $errors['r']; ?> </p>
       <br><br><br>
       </div>


<a name="comment"></a>
<div class="commentsout">
       <?php

       $eid= mysqli_real_escape_string($con, $_GET['eid']);
       // $userID = mysqli_real_escape_string($con, $_GET['userID']);
       // $firstName = mysqli_real_escape_string($con, $_GET['firstName']);
       // $lastName = mysqli_real_escape_string($con, $_GET['lastName']);

       $sql = "SELECT * FROM comments INNER JOIN user ON comments.userID = user.userID INNER JOIN entry ON comments.entryID = entry.eid WHERE entryID = '$eid' ORDER BY comments.id DESC";

       $result = mysqli_query($con, $sql);
       $queryResults = mysqli_num_rows($result);

         if($queryResults > 0) {
           while ($row = mysqli_fetch_assoc($result)) {
             echo "<div class='reviewinfo'>
             <img src='".$row['profileImage']."'>   
             <h5>".$row['firstName']."&nbsp;".$row['lastName']."&nbsp;on&nbsp;".$row['createdOn']."&nbsp;wrote</h5></div>
            <div class='comment'><h4>".$row['comment']."</h4>";
            
            if($loggedIn == true && $_SESSION['userID'] == $row['userID']){
              echo "<form class='delete' method='POST' action='edit.php'>
              <input type='hidden' name='id' value='".$row['id']."'>
              <input type='hidden' name='comment' value='".$row['comment']."'>
              <button type='submit' name='edit' value='edit' style='padding:5px;'><span>&nbsp;&nbsp;Edit&nbsp;&nbsp;</span></button>
              </form><br><br><br>";
              }
              else {
                echo "";
              }
            
            echo "<hr>
             </div><br><br>";}}?>
        </div>

        

 
  <!-- Modal Start -->
  <script src="js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
  <!-- Modal End -->

  <script type="text/javascript">

// Navbar Start
      $(document).ready(function(){
        $('.menu-toggle').click(function(){
          $('.menu-toggle').toggleClass('active')
          $('nav').toggleClass('active')
        });
// Navbar End
// Script section that ensures login inputs are not empty.
      $("#loginBtn").on('click', function () {
          var email = $("#userLEmail").val();
          var password = $("#userLPassword").val();

          if (email != "" && password != "") {
              $.ajax({
                  url: 'article.php',
                  method: 'POST',
                  dataType: 'text',
                  data: {
                      logIn: 1,
                      email: email,
                      password: password
                  }, success: function (response) {
                      if (response === 'failed')
                          alert('Please check your login details!');
                      else
                          window.location = window.location;
                  }
              });
          } else
              alert('Please Check Your Inputs');
      });
});
function myFunction() {
   alert("You must be logged in to write a review!");
}
        // Like-Dislike Start
        function like_update(id){
          jQuery.ajax({
            url:'update_count.php',
            type:'post',
            //this id corresponds to php name
            data:'type=like&eid='+id,
            success:function(result){
              var cur_count=jQuery('#like_loop_'+id).html();
              cur_count++;
              jQuery('#like_loop_'+id).html(cur_count);

            }
          });
        }

        function dislike_update(id){
          jQuery.ajax({
            url:'update_count.php',
            type:'post',
            //this id corresponds to php name
            data:'type=dislike&eid='+id,
            success:function(result){
              var cur_count=jQuery('#dislike_loop_'+id).html();
              cur_count++;
              jQuery('#dislike_loop_'+id).html(cur_count);

            }
          });
        }
        //Like-Dislike End
        </script>

      </body>
    </html>
