<?php

// The session start works in conjuction with the logged in issue.
session_start();
$loggedIn = false;
include ('helper.php');
include 'mysqli_connect.php';


if (isset($_SESSION['loggedIn']) && isset($_SESSION['firstName'])) {
    $loggedIn = true;
}

if(isset($_SESSION['loggedIn']) && isset($_SESSION['userID'])){
    require ('mysqli_connect.php');
    $loggedIn = true;
    $user = get_user_info($con, $_SESSION['userID']);
}

// include 'mysqli_connect.php';


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="watch.css">



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
          <li><a href="#" class="active">Search Results</a></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li>
            <?php
            if (!$loggedIn)
                echo '<a href="#" onclick="myFunction(); return false;">Review</a>';
            else
                echo '
                      <a href="entry.php">Review</a>
                ';
            ?>
          </li>          
          <li><a href="www.offenbachgp.com" target="_blank">Offenbach GP</a></li>
          
          <li><a href="#modal" data-toggle="modal" data-target="#contactModal">Contact</a></li>
          
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

  </div>

<div class="container">
<div id='img_div'>
<h3>Search Results</h3>
<ul>

  <?php
      if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($con, $_POST['search']);
        $sql = "SELECT * FROM entry WHERE title LIKE '%$search%' OR venue LIKE '%$search%' OR day_select LIKE '%$search%' AND select_month LIKE '%$search%' AND year LIKE '%$search%'";
        $result = mysqli_query($con, $sql);
        $queryResult = mysqli_num_rows($result);

        echo "There are ".$queryResult." results!";

        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)){
              echo "<a href='article.php?eid=".$row['eid']."&reviewtype=".$row['reviewtype']."&title=".$row['title']."&venue=".$row['venue']."&day_select=".$row['day_select']."&select_month=".$row['select_month']."&year=".$row['year']."'>

              <li><p><span>Title: ".$row['title']."<br>Venue/Publisher: ".$row['venue']." </span><br>Date of Event/Publication: ".$row['day_select']."/".$row['select_month']."/".$row['year']."<br>Type of Review: ".$row['reviewtype']."<br>Date of Review:&nbsp;".$row['createdOn']."<br>Score:&nbsp;".$row['like_count']."&nbsp;Claps!&nbsp;/&nbsp;".$row['dislike_count']." Eggs Thrown!<p>";
      
              if ($row['link'] != null){
               echo  "<iframe src='".$row['link']."' style='width: 100%; height: 300px;'></iframe></li></a>
               <br>";
              }
              else {
              echo "</li></a>
               <br>";
              }


          }
        } else {
          echo "There are no results matching your search!";
        }
      }
   ?>

  <br>
  <li><a href="#top"> <span> Back to top </span> </a></li>
  <br>

</ul>
</div>
    </div>


  </body>
  <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $('.menu-toggle').click(function(){
          $('.menu-toggle').toggleClass('active')
          $('nav').toggleClass('active')
        });

// Script section that ensures login inputs are not empty.
      $("#loginBtn").on('click', function () {
          var email = $("#userLEmail").val();
          var password = $("#userLPassword").val();

          if (email != "" && password != "") {
              $.ajax({
                  url: 'index.php',
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



  </script>

</html>
