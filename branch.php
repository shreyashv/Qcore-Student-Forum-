<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
	<title>
		Home Page
	</title>
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Bree+Serif|Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
	<style>
		html, body {
			height:100%;
		}
		#profile{
			padding: 50px;
			position: fixed;
			margin-top: 90px;
			margin-left: 70%;
			border-left: thick solid #38e07e;
			height: 400px;	
		}
		
	
		#welcome{
			font-family: 'Acme', sans-serif;
			font-size: 24px;
		
		
		}
		
		#content{
			margin-top: 70px;
			
		}
		#quesnans{
		margin-left: 10px;
		}
		#username{
			font-family: 'Abril Fatface', cursive;
		}
		#question{
			font-family: 'Bree Serif', serif;
			font-size: 20px;
			width: 700px;
		}
		#smalltime{
			font-size: 12px;
		}
	</style>
</head>
<body>
<?php
require('connect.php');

?>
<?php
date_default_timezone_set("Asia/Kolkata");
$startdate = date("Y-m-d");
$time=date("h:i:sa");
$username=@$_SESSION['username'];
$char="";
$posted="";
$notposted="";
$branch=@$_SESSION['branch'];
$question=@$_POST['question'];
if(isset($_POST['submitbq']))
{
	if($question)
	{
		if(strlen($question)>=5)
		{
			if($query = mysqli_query($connect, "INSERT INTO branchquestions (`bquestionid`, `bquestion`, `busername`, `bdate`,`btime`,`branch`) VALUES ('', '".$question."', '".$username."' ,'".$startdate."','".$time."','".$branch."')"))
				{
					$posted="You have posted as $username.";
				}
		}
		else
		{
			$char="Please enter a question more than 5 characters";
		}
	}
	if(!$question)
	{
		$notposted="Please write something first";
	}
}
?>
	<div id="profile" align="right">
			<form action="home_page.php" method="POST">
			<div id="welcome" style="font-size: 24px">
				Welcome  
				<?php echo $_SESSION['username']; ?><br/><br/>  
			</div>
		Write your question<br/><textarea name="question" rows="3" cols="30"></textarea>
			<br/><input type="submit" name="submitq" value="POST">
			
			<br/><?php echo $notposted; ?><?php echo $posted; ?><?php echo $char; ?>
		</form>
	</div>
<br/>
	<div id="content">
		<?php
		$check = mysqli_query($connect,"SELECT * FROM branchquestions where branch='".$branch."'");
		while($row = mysqli_fetch_array($check))
		{
			$db_username=$row['busername'];
			$db_question=$row['bquestion'];
			$datetime=$row['bdate'];
			$db_time=$row['btime'];
			$check4=mysqli_query($connect,"SELECT * from users where username='".$db_username."'");
			?>
			<br/>
			<?php
			while($row1=mysqli_fetch_array($check4))
			{?>
					<div id="quesnans">
					<?php
				$profile_pic=$row1['profilepic'];
				echo '<img src="data:image/jpeg;base64,'.base64_encode($profile_pic).'" width="25" height="25" align="left">'; 
				?>
					</div>
					<?php
			}?>
					<div id="quesnans">
						<div id="username">
							<?php
								echo nl2br("$db_username posted a Question\n");
								?>
						</div>
						<div id="question">
							<?php
							echo nl2br("\n$db_question\n");
							?>
						</div>
						<div id="smalltime">
							<?php
							echo nl2br("posted on "."$datetime"." at $db_time\n\n");
							?>
						</div>
					</div>
					<?php
			$question_id=$row['bquestionid'];
			$check2 = mysqli_query($connect,"SELECT * FROM branchanswers where bquestionid='".$question_id."'");
			while($row2 = mysqli_fetch_array($check2))
			{
				$db_ans_username=$row2['busername'];
				$db_answer=$row2['banswer'];
				$db_date=$row2['bdate'];
				$db_time=$row2['btime'];
				?>
					<div id="quesnans">
						<div id="username">
							<?php
								echo nl2br("\nAnswer posted by "."$db_ans_username\n");
								?>
						</div>
						<div id="question">
							<?php echo nl2br("$db_answer\n");?>
						</div>
						<div id="smalltime">
							<?php echo nl2br("posted on $db_date "."at $db_time\n\n");?>
						</div>
			
					</div>
					<?php
			}
			$noanswer="";
			$answer = @$_POST['answer'];
			$answer_post="";
			$upvote=0;

			if(isset($_POST['submita']) and $_POST['question']==$question_id)
			{
				if($answer)
				{?>
					<div id="quesnans">
						<?php
						$username_current=@$_SESSION["username"];
						date_default_timezone_set("Asia/Kolkata");
						$date_answer=date("Y-m-d");
						$time_answer=date("h:i:sa");
						$check3=mysqli_query($connect,"INSERT INTO branchanswers (`bid`,`bquestionid`, `busername`, `banswer`, `bdate`,`bupvote`,`btime`) VALUES ('','".$question_id."', '".$username_current."', '".$answer."','".$date_answer."','".$upvote."','".$time_answer."')");
						$answer_post="Your answer has been registered";
						
					?>
					</div>
					<?php
				}
				if(!$answer)
				{
					$noanswer="Please write something first";
				}
			}
			?>
			<div id="quesnans">
				<form action="branch.php" method="post">
				Your Answer<br/><textarea name="answer" rows="3" cols="50"></textarea>
				<br/><input type="submit" name="submita" value="Post Answer">
				<input type="hidden" value="<?php echo $question_id; ?>" name="question">
				<br/><?php echo $noanswer; ?><?php echo $answer_post; ?>
				</form>
			</div>
		<?php
		}
		include ('nav_top.php');
		include ('BottomNav.html');
		?>
	</div>
</body>
</html>
<?php
}
else
  {
    echo "you must be logged in";
  }
?>