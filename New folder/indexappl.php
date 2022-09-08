<?php

// The session start works in conjuction with the logged in issue.
session_start();
$loggedIn = false;
include ('helper.php');

if (isset($_GET['accept-cookies'])){
  setcookie('accept-cookies','true', time() + 31556925);
  header('location: ./');
}

if (isset($_SESSION['loggedIn']) && isset($_SESSION['firstName'])) {
    $loggedIn = true;
}

if(isset($_SESSION['loggedIn']) && isset($_SESSION['userID'])){
    require ('mysqli_connect.php');
    $loggedIn = true;
    $user = get_user_info($con, $_SESSION['userID']);
}

include 'mysqli_connect.php';


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="watch.css">



  </head>
  <body>
<?php
  if(!isset($_COOKIE['accept-cookies'])){
    ?>
    <div class="cookie-banner">
        <div class="cookiescontainer">
            <p>We use cookies on this website.  By using this website, you agree to our cookie policy.  For more information please click  <a href="data.html">here.</a></p>
            <a href="?accept-cookies" class="button">Accept</a>
        </div>
    </div>
<?php }?>

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
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="#modal" data-toggle="modal" data-target="#aboutModal">About</a></li>
          <li> <a href="data.html" target="_blank">Privacy</a></li>

          
          <li>
            <?php
            if (!$loggedIn)
                echo '<a href="#" onclick="myFunction(); return false;">Review</a>';
            else
                echo '
                      <a href="entry.php">Review</a>
                ';
            ?></li>

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
    <div class="modal" id="aboutModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Instructions</h5>
                </div>
                <div class="modal-body">
                    <h2 style="text-align:center;">Welcome to Spoiled Eggs!</h2> <br> <br>
                    <h4>A site in which you may nag about or adore all things opera!  Spoiled Eggs is the first site of its kind, where the audience can review and exchange views about all that is going on in the world of opera.  Did you absolutely love your favourite soprano in her latest performance?  Did you feel shocked to your soul about a director's new take on a classical masterpiece?  Did you read a review that you absolutely disagree with?  Did you hear your favourite tenor's latest recording and felt butterflies in your stomache?  Here's the place to write about it.  And to read about it. <br> <br>
                    But, that's not all you can do... You can applaud everything you love by clicking on the applause button as many times as you like... And you can throw eggs at everything that you hate and rage click on egg throwing as many times as you like.  Let the opera world know what you love and what you hate!  It's certainly ripe to get the message! <br> <br>
                    Thank you for visiting this site.  Either click on one of the articles below or create an account and click "Review" to start a thread of your own. </h4>
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
                    <h4>For any problems please contact the administrator of this site on spoiledeggs.eu5@gmail.com</h4>
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

  </div>

  <div class="container">
  <div class="myButton">
  <a href="index.php" >Latest</a>
  <a href="indexabc.php">By Opera Alphabetically</a>
  <a href="indexappl.php" class="active">Rank by Applause</a>
  <a href="indexeggs.php" >Negative Rank (Eggs)</a>
  </div>

  <div id='img_div'>
<h3>Reviews</h3>
<ul>

  <?php
    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
      $page_no = $_GET['page_no'];
      } else {
        $page_no = 1;
            }
    
      $total_records_per_page = 10;
        $offset = ($page_no-1) * $total_records_per_page;
      $previous_page = $page_no - 1;
      $next_page = $page_no + 1;
      $adjacents = "2"; 
    
      $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `entry`");
      $total_records = mysqli_fetch_array($result_count);
      $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
      $second_last = $total_no_of_pages - 1; // total page minus 1
      
    $sql = "SELECT * FROM entry ORDER BY like_count DESC LIMIT $offset, $total_records_per_page";
    $result = mysqli_query($con, $sql);
    $queryResult = mysqli_num_rows($result);

  if ($queryResult > 0) {
      while ($row = mysqli_fetch_assoc($result)){
        echo "<a href='article.php?eid=".$row['eid']."&reviewtype=".$row['reviewtype']."&title=".$row['title']."&venue=".$row['venue']."&day_select=".$row['day_select']."&select_month=".$row['select_month']."&year=".$row['year']."'>

      <li><p><span>Title: ".$row['title']."<br>Venue/Publisher: ".$row['venue']." </span><br>Date of Event/Publication: ".$row['day_select']."/".$row['select_month']."/".$row['year']."<br>Type of Review: ".$row['reviewtype']."<br>Date of Review:&nbsp;".$row['createdOn']."<br>Score:&nbsp;".$row['like_count']."&nbsp;Claps!&nbsp;/&nbsp;".$row['dislike_count']." Eggs Thrown!</p>";
      
      if ($row['link'] != null){
       echo  "<iframe src='".$row['link']."' style='width: 100%; height: 300px;'></iframe></li></a>
       <br>";
      }
      else {
      echo "</li></a>
       <br>";
      }
    }
    }
    mysqli_close($con);
    ?>
</ul>
  <br>
  <div class="myButton">
  <a href="#top">Back to top</a>
  </div>
  <br>
</div>
</div>
<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC; width: 200px; background:white;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>



  </body>
<!-- Cookies Start -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="js/global.js"></script>
<!-- Cookies End -->
<!-- Modal Start -->
  <script src="js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Modal End -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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
