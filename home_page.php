<?php
  session_start();
  ob_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Bree+Serif|Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
<title>
Home Page
</title>
<style>
	
	
	html, body {
    height:100%;
	}
	#welcome{
		font-family: 'Acme', sans-serif;
		font-size: 24px;
		
		
	}
	
	#content{
		margin-top: 70px;
		
	}
	#profile{
			padding: 50px;
			position: fixed;
			margin-top: 70px;
			margin-left: 70%;
			border-left: thick solid #38e07e;
			height: 400px;	
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

$question=@$_POST['question'];
?>
<br/>
<?php 
date_default_timezone_set("Asia/Kolkata");
$startdate = date("Y-m-d");
$time=date("h:i:sa");
$username=@$_SESSION['username'];
$char="";
$posted="";
$notposted="";
if(isset($_POST['submitq']))
{
	if($question)
	{
		if(strlen($question)>=5)
		{
			if($query = mysqli_query($connect, "INSERT INTO questions (`questionid`, `question`, `username`, `date`,`time`) VALUES ('', '".$question."', '".$username."' ,'".$startdate."','".$time."')"))
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
		require('connect.php');
		$check = mysqli_query($connect,"SELECT * FROM questions order by questionid desc");
		$rows =  mysqli_num_rows($check);
		?>
		
			<?php
			while($row = mysqli_fetch_array($check))
			{
				$db_username=$row['username'];
				$db_question=$row['question'];
				$datetime=$row['date'];
				$db_time=$row['time'];
				$check4=mysqli_query($connect,"SELECT * from users where username='".$db_username."'");
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
				$question_id=$row['questionid'];
				$check2 = mysqli_query($connect,"SELECT * FROM answers where questionid='".$question_id."'");
				while($row2 = mysqli_fetch_array($check2))
				{
					$db_ans_username=$row2['username'];
					$db_answer=$row2['answer'];
					$db_date=$row2['date'];
					$db_time=$row2['time'];
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
					{
						?>
					<div id="quesnans">
					<?php
						$username_current=@$_SESSION["username"];
						date_default_timezone_set("Asia/Kolkata");
						$date_answer=date("Y-m-d");
						$time_answer=date("h:i:sa");
						$check3=mysqli_query($connect,"INSERT INTO answers (`id`,`questionid`, `username`, `answer`, `date`,`upvote`,`time`) VALUES ('','".$question_id."', '".$username_current."', '".$answer."','".$date_answer."','".$upvote."','".$time_answer."')");
						$answer_post="Your answer has been registered";
						header ('Location: home_page.php');
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
					
				<form action="home_page.php" method="post">
				Your Answer<br/><textarea name="answer" rows="3" cols="50"></textarea>
				<br/><input type="submit" name="submita" value="Post Answer">
				<input type="hidden" value="<?php echo $question_id; ?>" name="question">
				<br/><?php echo $noanswer; ?><?php echo $answer_post; ?>
				</form>
				<br/>
				<br/>
				
					</div>
					
		
	</div>
			
		<?php
		}include('nav_top.php'); 
		include('BottomNav.html');
		?>
	
</body>
</html>
<?php
ob_end_flush();
}
else
  {
    echo "you must be logged in";
  }
?>