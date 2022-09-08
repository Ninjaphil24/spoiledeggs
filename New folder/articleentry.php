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

  // $entryID = $con->real_escape_string($_POST['$entryID']);
  $comment= $con->real_escape_string($_POST['comment']);


  $errors = array();

  if(empty($comment)) {
    $errors['r'] = "Review Required";
  }

  if (count($errors)==0) {

     $query = "INSERT INTO comments (userID, entryID, comment, createdOn) VALUES ('".$_SESSION['userID']."',( SELECT MAX(eid) FROM entry),'$comment',NOW())";


    $result = mysqli_query($con,$query);


  if ($result) {
    header("Location: index.php");
die();

    // echo "<script>alert('done')</script>"
  }
  else{

    echo "<script>alert('failed')</script>";
  }
  }
}


 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spoiled Eggs</title>
    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Modal Script Start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Modal Script End -->

    <link rel="stylesheet" href="articleentry.css">
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
                    <h4>You may now write your review.  You are the first to review this performance/publication.  If you've included a website it will appear.  If you've included a video, by clicking the button it will appear.</h4>
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


    <div class="formbox">
  <?php

    $sql = "SELECT * FROM entry WHERE eid = ( SELECT MAX(eid) FROM entry)";
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
        <p>Date of ".$row['reviewtype']." (D,M,Y): ".$row['day_select']."&nbsp;".$row['select_month']."&nbsp;".$row['year']."</p>
        </div>";
      }
    }

   ?>
</div> <br> <br>


  <?php
  $sql = "SELECT * FROM entry WHERE eid = ( SELECT MAX(eid) FROM entry)";
  $result = mysqli_query($con, $sql);
  $queryResults = mysqli_num_rows($result);
  $row=mysqli_fetch_assoc($result);

  if($queryResults > 0) {?>

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
   <?php } ?>
  </div>
  </div> 


<form method="post">
<br>
<div class='commentsin'>
   <form method='post'>
   <textarea placeholder='Write a comment.' type='text' name='comment' id='comment'></textarea><br> <br>
   <p class="text-danger"> <?php if(isset($errors['r'])) echo $errors['r']; ?> </p>
          
  <div class="text"> 
   <button type='submit' name='insert' value='insert' style='padding:5px;'><span>&nbsp;&nbsp;Insert&nbsp;&nbsp;</span></button>
   </div>
   </form>
   </div>

<!-- Modal Start -->
<script src="js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Modal End -->

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.menu-toggle').click(function(){
        $('.menu-toggle').toggleClass('active')
        $('nav').toggleClass('active')
      });



});




</script>


<script>
function like_update(id){
  jQuery.ajax({
    url:'update_count.php',
    type:'post',
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
    data:'type=dislike&eid='+id,
    success:function(result){
      var cur_count=jQuery('#dislike_loop_'+id).html();
      cur_count++;
      jQuery('#dislike_loop_'+id).html(cur_count);

    }
  });
}
</script>

</body>
</html>
