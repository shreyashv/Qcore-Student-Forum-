<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Bree+Serif|Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
<title>
Search Profile
</title>

		
  
<style>
	.content{
			margin-top: 80px;
		}
	#username{
		font-family:'Abril Fatface', cursive;
		font-size: 20px;
	}
	a{
		text-decoration: none;
	}
	a: hover{
		color: #38e07e;
	}
</style>
</head>
<body>
</br>
<div id="scroll" class="content">
<center><h2>Profile</h2>
<?php
require('connect.php');
$username=@$_SESSION['username'];
$branch=@$_SESSION['branch'];
$profile_pic=@$_SESSION['profilepic'];
echo nl2br("\n\n");
echo '<img src="data:image/jpeg;base64,'.base64_encode($profile_pic).'" width="50" height="50">'; 
?>
<div id="username">
	<?php
	echo nl2br("\nUsername: $username\n"); 



echo nl2br("\nBranch:$branch");
$check3=mysqli_query($connect,"SELECT * FROM users where username='".$username."'");
while($row3=mysqli_fetch_array($check3))
	{
		$date=$row3['date'];
		$email=$row3['email'];
	}
	echo nl2br("\n\nEmail:$email");
$question_no=0;
$check=mysqli_query($connect,"SELECT * FROM questions where username='".$username."'");
while($row=mysqli_fetch_array($check))
	{
		$question_no++;
	}
echo nl2br("\n\nQuestions posted globally:"."$question_no");
$answer_no=0;
$check2=mysqli_query($connect,"SELECT * FROM answers where username='".$username."'");
while($row2=mysqli_fetch_array($check2))
	{
		$answer_no++;
	}
echo nl2br("\n\nAnswers posted globally:"."$answer_no");
$branch_question_no=0;
$check=mysqli_query($connect,"SELECT * FROM branchquestions where busername='".$username."'");
while($row=mysqli_fetch_array($check))
	{
		$branch_question_no++;
	}
echo nl2br("\n\nQuestions posted in branch:"."$branch_question_no");
$branch_answer_no=0;
$check2=mysqli_query($connect,"SELECT * FROM branchanswers where busername='".$username."'");
while($row2=mysqli_fetch_array($check2))
	{
		$branch_answer_no++;
	}
echo nl2br("\n\nAnswers posted in branch:"."$branch_answer_no");
?>
</div>
<br/>
<br/>
<a href="user_profile.php?action=cp">Change Password</a>
<a href="user_profile.php?action=pp">Change Profile pic</a>
<?php
if(@$_GET['action']=='cp')
 {
 	?>
 	<form action="user_profile.php?action=cp" method='POST'>
 	<br/><br/>Confirm Password   <input type="Password" name="confirm_pass"><br/>
 	New Password    <input type="Password" name="new_pass"><br/>
 	Retype new Password   <input type="Password" name="re_new_pass"><br/>
	<br/><input type="submit" name="submitnew" value="Change Password">
</form>
<?php
	if(isset($_POST['submitnew']))
	{
		$confirm_pass=@$_POST['confirm_pass'];
		$new_pass=@$_POST['new_pass'];
		$re_new_pass=@$_POST['re_new_pass'];
		$username=@$_SESSION['username'];
		if($confirm_pass and $new_pass and $re_new_pass)
		{
			if(strlen($confirm_pass)>=8 && strlen($new_pass)>=8 && strlen($re_new_pass)>=8)
				{	
					$pass_en= sha1($confirm_pass);
					$check4=mysqli_query($connect,"SELECT * FROM users where username='".$username."'");
					while($row4=mysqli_fetch_array($check4))
					{
						$db_pass_en=$row4['password'];
					}
					if($db_pass_en==$pass_en)
					{
						if($re_new_pass==$new_pass)
						{
							$new_db_pass=sha1($new_pass);
							if($check5=mysqli_query($connect,"UPDATE users SET password='".$new_db_pass."' WHERE username = '".$username."'"))
							{
								echo "Password changed sucessfully";
							}

						}
						else
						{
							echo "New Password and retyped Password does not match";
						}
					}
					else
					{
						echo "Wrong Password";
					}
				}
			else
			{	
				echo "Password should be longer than 7 characters";
			}
		}
		else
		{
			echo "Please fill the entries first";
		}
	}
 }
if(@$_GET['action']=='pp')
 {
 	?>
 	<form action="user_profile.php?action=pp" method='POST' enctype="multipart/form-data">
 	<input type="file" name="img">
	<br/><input type="submit" name="submitpp" value="Change Profile pic">
</form>
<?php
	if(isset($_POST['submitpp']))
	{
		$username=@$_SESSION['username'];
			$filename=addslashes($_FILES["img"]["name"]);
			$tmpname=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
			$filetype=addslashes($_FILES["img"]["type"]);
			$array= array('jpg','jpeg');
			$ext=pathinfo($filename,PATHINFO_EXTENSION);
		if($filename)
		{
			if(in_array($ext,$array))
			{
				if($check5=mysqli_query($connect,"UPDATE users SET profilepic='".$tmpname."' WHERE username = '".$username."'") and $check6=mysqli_query($connect,"UPDATE users SET filename='".$filename."' WHERE username = '".$username."'"))
					{
						$check7=mysqli_query($connect,"SELECT * from users where username='".$username."'");
						while($row4=mysqli_fetch_array($check7))
						{
							$profile_pic=$row4['profilepic'];
						}
					@$_SESSION['profilepic']=$profile_pic;
					echo "Profile pic changed sucessfully";
					}
			}
			else
			{
				echo "Please enter a file with jpg or jpeg format";
			}
		}
		else
		{
			echo "Please select an image first";
		}
	}

 }
		include ('nav_top.php');
		include ('BottomNav.html');
?>
</center>
</div>
<?php
}
else
  {
    echo "you must be logged in";
  }

?>
</body>
</html>