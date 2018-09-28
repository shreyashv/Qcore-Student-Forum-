<?php
require('connect.php');
$username=@$_POST['username'];
$password=@$_POST['password'];
$repass=@$_POST['repassword'];
$email=@$_POST['email'];
$date= date("Y-m-d");
$branch=@$_POST['branch'];
$pass_en= sha1($password);
$registered = "";
$donotmtach ="";
$unsuccessfull="";
$usernamebetw="";
$passwordlen="";
$pleasefill="";
$alreadyregis="";
$wrong_file="";
if(isset($_POST['submit']))
{
	$filename=addslashes($_FILES["img"]["name"]);
		$tmpname=addslashes(@file_get_contents($_FILES["img"]["tmp_name"]));
		$filetype=addslashes($_FILES["img"]["type"]);
		$array= array('jpg','jpeg');
		$ext=pathinfo($filename,PATHINFO_EXTENSION);
	if($username && $password && $repass && $email && $branch && $filename)
	{
		if(in_array($ext,$array))
		{
		$check=mysqli_query($connect,"SELECT * from users where username='".$username."'");
		$rows =  mysqli_num_rows($check);
		if($rows!=0)
		{
			$alreadyregis="This username is already registered";
		}
		else{
		if(strlen($username) >= 5 && strlen($username) < 25 && strlen($password) >= 8)
			{
				if($repass != $password)
				{
					$donotmtach= "Password do not match";
				}
				else
				{
					if($query = mysqli_query($connect, "INSERT INTO users (`id`, `username`, `password`, `email`, `date`,`branch`,`profilepic`,`filename`) VALUES ('', '".$username."', '".$pass_en."', '".$email."', '".$date."','".$branch."','".$tmpname."','".$filename."')")){
					$registered="You have registerd as $username";
					}
					else{
					$unsuccessfull="Unsuccessfull";
					}
				}
			}
		else{
			if(strlen($username) < 5 || strlen($username) > 25 ){
				$usernamebetw= "Username must be between 5 and 25 characters";
			} 
			if(strlen($password) < 8){
				$passwordlen= "Password should be longer than 7 characters";
			}
		}
		}
		}
		else
		{
			$wrong_file="Please enter a file with jpg or jpeg format";
		}
	}
	else{
		$pleasefill="Please fill in all the details";
	}

}	
?>

<html>
<head>
<title>Register</title>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"><!--Adding mobile responsiveness -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	body  {
		background-image: url("bg-img3.jpg");
		backgroung-attachment: fixed;
		background-repeat: no-repeat;
	}
	#header{
		color: white;
		text-align: center;
		font: italic bold Georgia, serif;
	}
	#outPopUp {
	  position: absolute;
	  width: 300px;
	  height: 700px;
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
		<div class="col-sm-12" style="background-color: #38e07e"><img src="student-icon.png" class="centerimg"><h1 id="header">Student Forums</h1></div>
	</div>
	<div class="wrapper" id="outPopUp">
		<form action="register.php" method="POST" class="center" enctype="multipart/form-data">
		<div class="form-group" id="center">
			<br/><label>Enter Your Username</label>
			<br/><input type="text" name="username">
		</div>
		<div class="form-group">
			<br/> <label>Enter Your Password</label>
			<br/><input type="password" name="password">
		</div>
		<div class="form-group">
			<br/><label> Confirm Your Password</label>
			<br/><input type="password" name="repassword">
		</div>
		<div class="form-group">
			<br/> <label>Enter Your Email</label>
			<br/><input type="text" name="email">
		</div>
		<div>
			<label>Select Branch</label>
			<select name="branch">
				<option value="" selected disabled hidden>Choose Option</option>
				<option value="CS-IT">Branch: CS-IT</option>
				<option value="Civil">Branch: Civil</option>
				<option value="Mechanical">Branch: Mechanical</option>
				<option value="ENTC">Branch: ENTC</option>
			</select>
		</div>
		<div style="margin-top: 20">
			<label>Choose your Profile Picture</label>
			<input type="file" name="img">
		</div>
			<br/><center><input type="submit" class="btn btn-primary"name="submit" value="Register"></center>
		</form>
		<center><a href="login.php"><input type="submit" class="btn btn-primary" value="Login Into Your Account" name="login"></a></center>
		<br /><center><?php echo $donotmtach; ?></center><center><?php echo $registered; ?></center><center><?php echo $pleasefill; ?></center><center><?php echo $unsuccessfull; ?></center><center><?php echo $usernamebetw; ?></center><center><?php echo $passwordlen; ?></center><center><?php 
			echo $alreadyregis; ?> </center><center><?php 
			echo $wrong_file; ?> </center>

	</div>
	</body>
</html>

