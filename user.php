<?php
session_start();
$loggedIn = false;
include ('helper.php');
include ('mysqli_connect.php');

if (isset($_SESSION['loggedIn']) && isset($_SESSION['userID'])) {
  // require ('mysqli_connect.php');
    $loggedIn = true;
    $user = get_user_info($con, $_SESSION['userID']);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="shortcut icon" type="image/png" href="img/eggfavicon.png">
    <link rel="stylesheet" href="vote.css">
</head>
<body>
<section>
      <div class="crop">
      <img src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : 'img/beard.png'; ?>" alt="">
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

<div class="back"> <a href="index.php">Home</a> </div>
<div class='delete'><a style=''href='deleteuser.php?userID=<?php echo $_SESSION['userID']?>' class="confirmation">Delete Account</a></div>


<?php
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM user WHERE userID = $userID";

$result = mysqli_query($con, $sql);
$queryResults = mysqli_num_rows($result);

if($queryResults > 0) {
  while ($row = mysqli_fetch_assoc($result))

  { ?>


    <div class="banner">
        <div class="content">
          <img src="<?php echo isset($user['profileImage']) ? $user['profileImage'] : 'img/beard.png';?>" alt="Profile Image">
          <?php echo "
          <h2>".$row['firstName']."&nbsp;".$row['lastName']."&nbsp;|&nbsp;".$row['email']."</h2>";?>
          </div> <br> <br>
      </div>
      <?php }} ?>
      <a name="comment"></a>
      <div class="commentsout">

<?php
$userID = $_SESSION['userID'];

$sql = "SELECT * FROM comments INNER JOIN entry ON comments.entryID = entry.eid WHERE userID = '$userID' ORDER BY comments.id DESC";

// SELECT * FROM comments INNER JOIN user ON comments.userID = user.userID INNER JOIN applicants ON comments.applicID = applicants.appID WHERE applicID = '$appID' ORDER BY comments.id DESC

$result = mysqli_query($con, $sql);
$queryResults = mysqli_num_rows($result);

  
if($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
     
      echo "<a style='text-decoration: none;' href='article.php?eid=".$row['eid']."&reviewtype=".$row['reviewtype']."&title=".$row['title']."&venue=".$row['venue']."&day_select=".$row['day_select']."&select_month=".$row['select_month']."&year=".$row['year']."'>
      
      <div class='reviewinfo'>
      <h5> Click on comment to go to entry of this review.<br>On&nbsp;".$row['createdOn']."&nbsp;you&nbsp;wrote for&nbsp;".$row['title']."&nbsp;in&nbsp;".$row['venue']."<br>
     </h5></div>
     <div class='comment'><h4>".$row['comment']."</h4> 
      </div> </a> 
      <div class='delete'>
      <a style=''href='deletecomment.php?id=".$row['id']."' class='confirmation'>Delete Comment</a>
      </div><br><br><br>
      <hr>";

}}       
 ?>        
 </div>

</body>
<!-- Confirmation class in a tag:  This script is to get an "Are you sure" alert Start -->
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
<!-- "Are you sure" alert End -->
</html>