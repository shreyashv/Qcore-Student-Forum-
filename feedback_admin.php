<?php
	session_start();
  require('connect.php');
  if(@$_SESSION["ad_username"])
  {
?>
<html>
<head>
<title>
Feedback
</title>
	<style>
		#content{
			margin-top: 70px;
		}
	</style>
</head>
<body>
	<br/>
	<br/>
<center>
<div id="content">
	<?php
	require('connect.php');
	$ad_username=@$_SESSION['ad_username'];
	$nof="";
	$check = mysqli_query($connect,"SELECT * FROM feedback order by feedbackid desc");
	while($row = mysqli_fetch_array($check))
	{
		$db_username=$row['username'];
		$db_feedback=$row['feedback'];
		$db_branch=$row['branch'];
		$db_date=$row['date'];
		$db_time=$row['time'];
		echo nl2br("\nFeedback posted by"." $db_username\n");
		echo nl2br("$db_feedback\n"."posted on "."$db_date"." at $db_time\n\n");
	}
	?>
	<?php $nof; ?>
</div>

<?php
 include ('nav_top_admin.php');
}
else
  {
    echo "you must be logged in";
  }
?>
</body>
</html>