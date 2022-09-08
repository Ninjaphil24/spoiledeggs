<?php
$con=mysqli_connect('localhost','root','','spoiledeggs');
$type=$_POST['type'];
$eid=$_POST['eid'];
if($type=='like'){
	$sql="UPDATE entry SET like_count=like_count+1 WHERE eid=$eid";
}else{
	$sql="UPDATE entry SET dislike_count=dislike_count+1 WHERE eid=$eid";
}
$res=mysqli_query($con,$sql);
?>
