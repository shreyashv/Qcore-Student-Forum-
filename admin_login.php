<?php
session_start();
require('connect.php');
$ad_username = @$_POST['ad_username'];
$wrongpass="";
$usernot="";
$pleasefill="";
$ad_password = @$_POST['ad_password'];
if(isset($_POST['submit_ad']))
{
	if($ad_username && $ad_password)
	{
		$check = mysqli_query($connect,"SELECT * FROM admins WHERE ad_username='".$ad_username."'");
		$rows =  mysqli_num_rows($check);
		
		if($rows != 0)
		{
			while($row = mysqli_fetch_array($check)){
				$db_username = $row['ad_username'];
				$db_password = $row['ad_password'];
			}
			if($ad_username == $db_username && $ad_password ==$db_password){
				
				@$_SESSION['ad_username']=$ad_username;
				header("Location:home_page_admin.php");
			}
			else {
				$wrongpass="Wrong Password";
			}
		}
		else{
			$usernot="Admin Username not found";
		}
	}
	else{
		$pleasefill="Please fill in all the details";
	}
}
?>
<html>
<head><title>Login account</title>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--Adding mobile responsiveness -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		body{
			background-image: url("bg-img3.jpg");
		}
	#header{
		color: white;
		text-align: center;
		font: italic bold Georgia, serif;
	}
	#outPopUp {
	  position: absolute;
	  width: 300px;
	  height: 300px;
	  z-index: 15;
	  top: 50%;
	  left: 50%;
	  margin: -100px 0 0 -150px;
	  background-color: #e8edea;
	}
	.centerimg{
	    display: block;
		margin-left: auto;
		margin-right: auto;
		width: 10%;
	}
	.center {
		margin: auto;
		width: 60%;
		padding: 10px;
	} <!--Style to centrally align inner elements -->
	  
	</style>
</head>
<body>
	<div class="row">
		<div class="col-sm-12" style="background-color: #38e07e"><img src="admin.png" class="centerimg"/><h1 id="header">Student Forums</h1></div>
	</div>
	<div class="wrapper" id="outPopUp">
		<form action="admin_login.php" method="POST"class="center">
			<div class="form-group" id="center">
				<label>Username</label> 
				<br /><input type="text" name="ad_username">
			</div>
			<div class="form-group">
				<br /> <label>Password</label> 
				<br /><input type="password" name="ad_password">
			</div>
			<br /><center><input type="submit" class="btn btn-primary" value="Login" name="submit_ad">
			</center>
		</form>
	<div>
	<br /><center><?php echo $usernot; ?></center><center><?php echo $wrongpass; ?></center><center><?php echo $pleasefill; ?></center> 
</body>
</html>

