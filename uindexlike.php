<?php
$con=mysqli_connect('localhost','root','virtuoso','spoiledeggs');
// $sql="SELECT * FROM entry";
// $result=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Ajax Like Dislike Script</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
		.container{width:60%;}
		.container h1{text-align:center;}
		.title h3{margin-top:15px;}
		.main_box{margin-top:30px; border:1px solid #98A1A4;padding:2%;}
		.mr25{margin-right:25px;}
		</style>
	</head>
	<body>
		<div class="container">
			<h1>PHP Ajax Like Dislike Script</h1>
			<?php
			$sql = "SELECT * FROM entry WHERE id = ( SELECT MAX(id) FROM entry)";
			$result = mysqli_query($con, $sql);
			$queryResults = mysqli_num_rows($result);
			$row=mysqli_fetch_assoc($result);

			if($queryResults > 0) {?>
			<div class="row main_box">
				<div class="col-sm-7 title">
					<h3><?php echo $row['title']?></h3>
				</div>
				<div class="col-sm-2 mr25">
					<a href="javascript:void(0)" class="btn btn-info btn-lg">
						<span class="glyphicon glyphicon-thumbs-up" onclick="like_update('<?php echo $row['id']?>')"> Like (<span id="like_loop_<?php echo $row['id']?>"><?php echo $row['like_count']?></span>)</span>
					</a>
				</div>
				<div class="col-sm-2">
					<a href="javascript:void(0)" class="btn btn-info btn-lg">
					<span class="glyphicon glyphicon-thumbs-down" onclick="dislike_update('<?php echo $row['id']?>')"> Dislike
							 (<span id="dislike_loop_<?php echo $row['id']?>"><?php echo $row['dislike_count']?></span>)</span>
					</a>
				</div>
			</div>
		<?php } ?>
		</div>
		<script>
		function like_update(id){
			jQuery.ajax({
				url:'update_count.php',
				type:'post',
				//this id corresponds to php name
				data:'type=like&id='+id,
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
				data:'type=dislike&id='+id,
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
