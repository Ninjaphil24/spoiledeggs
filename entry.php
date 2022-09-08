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

if (isset($_POST['insert'])) {

  $reviewtype= $con->real_escape_string($_POST['reviewtype']);
  $day_select = $con->real_escape_string($_POST['day_select']);
  $select_month = $con->real_escape_string($_POST['select_month']);
  $year = $con->real_escape_string($_POST['year']);
  $venue = $con->real_escape_string($_POST['venue']);
  $title = $con->real_escape_string($_POST['title']);
  $link = $con->real_escape_string($_POST['link']);
  $video = $con->real_escape_string($_POST['video']);


  $errors = array();

  // $v = "SELECT venue FROM duplication WHERE venue='$venue'";
  // $vv = mysqli_query($con,$v);
  //
  // $t = "SELECT title FROM duplication WHERE title='$title'";
  // $tt = mysqli_query($con,$t);



  if(empty($venue)) {
    $errors['v'] = "Venue Required";
  }

  // else if(mysqli_num_rows($vv) > 0) {
  //   $errors['v'] = "Venue exists"; }
  if(empty($title)) {
    $errors['t'] = "Title Required";
  }

  // else if(mysqli_num_rows($tt) > 0) {
  //   $errors['t'] = "Title exists";}

  if (count($errors)==0) {
    $query = "INSERT INTO entry(reviewtype,day_select,select_month,year,venue,title,link,video,createdOn)
 	 VALUES ('$reviewtype','$day_select','$select_month','$year', '$venue','$title','$link','$video',NOW())";
    $result = mysqli_query($con,$query);

  if ($result) {
    header("Location: articleentry.php");
die();

    // echo "<script>alert('done')</script>"
  }
  else {

    $query = "SELECT * FROM entry WHERE reviewtype = '$reviewtype' AND title = '$title' AND venue = '$venue' AND day_select = '$day_select' AND select_month = '$select_month' AND year = '$year'";


    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);

    header("Location: article.php?eid=".$row['eid']."&reviewtype=".$row['reviewtype']."&title=".$row['title']."&venue=".$row['venue']."&day_select=".$row['day_select']."&select_month=".$row['select_month']."&year=".$row['year']."");
   die();  }
  }

}


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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="entry.css">
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
          <li><a href="logout.php">Log Out</a></li>
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
                    <h4>You may review a performance of any type (fully staged, concert, etc).  You may also review a CD, DVD, youtube video.  Finally, you may review an article in a published magazine or website...and you may review the content of professional reviews. To write your review you must first enter all the information about the subject of your review.  If someone else has already reviewed it, you will be taken to that entry where you can write your review as well.</h4>
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
                    <h5 class="modal-title">Instructions</h5>
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


          <section class="formbox">
            <div class="box">
              <form method="post">
                <label style="margin:10px;">I wish to write a review about a:</label>
                <select class="form-control" name="reviewtype">
                  <option value="Fully Staged Opera Performance">Fully Staged Opera Performance<option>
                    <option value="Concert Performance of Full Opera">Concert Performance of Full Opera<option>
                    <option value="Opera Gala">Opera Gala<option>
                    <option value="Opera Singing Competition">Opera Singing Competition<option>
                    <option value="Solo Recital">Solo Recital<option>
                  <option value="CD">CD<option>
                  <option value="DVD">DVD<option>
                  <option value="Media(Youtube, Vimeo etc)">Media(Youtube, Vimeo etc)<option>
                  <option value="TV show">TV show<option>
                  <option value="Opera Review">Opera Review<option>
                    <option value="Books about opera">Books about opera<option>


                  </select> <br>
                  <label style="margin:10px;">Date of Performance/Publication</label>
                  <br>
                <label style="margin:10px;">Day</label>
                <select class="form-control" required="required" name="day_select">
                  <?php
                    for ($i = 0; $i <= 31; ++$i) {
                      $time = strtotime(sprintf('-%d days', $i));
                      $day_value = date('d', $time);
                      $days = date('d', $time);
                      printf('<option value="%s">%s</option>', $day_value, $days);
                    }
                    ?>
                </select>
                <label style="margin:10px;">Month</label>
                <select class="form-control" required="required" name="select_month">
                  <?php
                    for ($i = 0; $i <= 12; ++$i) {
                      $time = strtotime(sprintf('-%d months', $i));
                      $Monthdecimalvalue = date('m', $time);
                      $MonthName = date('F', $time);
                      printf('<option value="%s">%s</option>', $Monthdecimalvalue, $MonthName);
                    }
                    ?>
                </select>

                <label style="margin:10px;">Year</label>
                <select id="year" name="year" class="form-control">
            <option><?php  $y=(int)date('Y');  ?></option>
              <option value="<?php echo $y;?>" selected="true"><?php echo $y;?></option>
                <?php
                $y--;
              for(; $y>'1900'; $y--)
              {
            ?>
            <option value="<?php echo $y;?>"><?php echo $y;?></option>
            <?php }?>
            </select>

                <div class="form-group">
                  <label style="margin:10px;">Venue/Publisher/Platform/Channel</label>
                  <input type="text" name="venue" placeholder="Venue/Publisher/Platform/Channel" class="form-control">
                  <p class="text-danger"> <?php if(isset($errors['v'])) echo $errors['v']; ?> </p>
                  <label style="padding:2px;">&nbsp;&nbsp;Title of the subject of your review.</label>
                  <input type="text" name="title" placeholder="Title" class="form-control" style="text-transform:capitalize;">
                  <p class="text-danger"> <?php if(isset($errors['t'])) echo $errors['t']; ?> </p>
                  <label>Can you provide a website url with information about your subject of review?</label>
                  <input type="text" name="link" placeholder="Link" class="form-control"> 
                  <label>Can you provide a video url of the performance of your review?</label>
                  <input type="text" name="video" placeholder="Video" class="form-control"> <br> <br>

                  <button type="submit" name="insert" value="insert" style="padding:5px;">&nbsp;&nbsp;Insert&nbsp;&nbsp;</button>
                  <!-- <input type="submit" name="insert" value="Insert" class="btn btn-success" style="margin:10px;"> -->

                </div>
              </form>
              </div>
            </section>





</body>
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



});




</script>

</html>
