<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
<title>
Feedback
</title>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--Adding mobile responsiveness -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
		#div1{
			margin-top: 100px;
			text-decoration: none;
		}
	</style>
</head>
<body>
<?php
require('connect.php');

$posted="";
$username=@$_SESSION['username'];
$branch=@$_SESSION['branch'];
$feedback=@$_POST['feedback'];
$notposted="";
date_default_timezone_set("Asia/Kolkata");
$startdate = date("Y-m-d");
$time=date("h:i:sa");
$thanks="";
if(isset($_POST['submitf']))
{
    if($feedback)
    {
        if($query = mysqli_query($connect, "INSERT INTO feedback (`feedbackid`, `username`, `feedback`,`branch`,`date`,`time`) VALUES ('', '".$username."', '".$feedback."' ,'".$branch."','".$startdate."','".$time."')"))
                {
                    $posted="Your feedback has been registered.";
                    $thanks="Thank you for your feedback";
                }
    }
    else
    {
        $notposted="Please write something first";
    }
}
?>
	<center>
	<div id="div1">
		<h3><?php echo $username; ?></h3><h4>Please give your feedback below</h4>
			<br>
			<form action="feedback.php" method="POST">
			<textarea type="text" name="feedback" rows = "10" cols = "50"></textarea>
			<br>
			<button type="submit" class="btn btn-primary" name="submitf" style="margin-top: 10px">Submit Feedback</button>
			</form>
			<?php echo $posted; ?><?php echo $notposted; ?><?php echo $thanks; ?>
	</div>
	</center>
	<?php
		include ('nav_top.php');
		include ('BottomNav.html');
	?>
<?php
}
else
  {
    echo "you must be logged in";
  }
?>
</body>
</html>