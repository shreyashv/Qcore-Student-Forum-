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
<style>
	#profile{
		position: relative;
		margin-top: 70px;
	}
	
	html, body {
    height:100%;
	}
	
	#content{
		overflow: scroll;
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
	<div id="profile">
		<form action="home_page.php" method="POST">
			Welcome  
			<?php echo $_SESSION['username']; ?><br/><?php echo $_SESSION['branch']; ?> <br/><br/>  
			Write your question<br/><input type="text" name="question">
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
		while($row = mysqli_fetch_array($check))
		{
			$db_username=$row['username'];
			$db_question=$row['question'];
			$datetime=$row['date'];
			$db_time=$row['time'];
			$check4=mysqli_query($connect,"SELECT * from users where username='".$db_username."'");
			while($row1=mysqli_fetch_array($check4))
			{
				$profile_pic=$row1['profilepic'];
				echo '<img src="data:image/jpeg;base64,'.base64_encode($profile_pic).'" width="25" height="25" align="left">'; 
			}
			echo nl2br("Question posted by"." $db_username\n");
			echo nl2br("\n$db_question\n"."posted on "."$datetime"." at $db_time\n\n");
			$question_id=$row['questionid'];
			$check2 = mysqli_query($connect,"SELECT * FROM answers where questionid='".$question_id."'");
			while($row2 = mysqli_fetch_array($check2))
			{
				$db_ans_username=$row2['username'];
				$db_answer=$row2['answer'];
				$db_date=$row2['date'];
				$db_time=$row2['time'];
				echo nl2br("\nAnswer posted by "."$db_ans_username\n"."$db_answer\n"."posted on $db_date "."at $db_time\n\n");
			}
			$noanswer="";
			$answer = @$_POST['answer'];
			$answer_post="";
			$upvote=0;

			if(isset($_POST['submita']) and $_POST['question']==$question_id)
			{
				if($answer)
				{
					$username_current=@$_SESSION["username"];
					date_default_timezone_set("Asia/Kolkata");
					$date_answer=date("Y-m-d");
					$time_answer=date("h:i:sa");
					$check3=mysqli_query($connect,"INSERT INTO answers (`id`,`questionid`, `username`, `answer`, `date`,`upvote`,`time`) VALUES ('','".$question_id."', '".$username_current."', '".$answer."','".$date_answer."','".$upvote."','".$time_answer."')");
					$answer_post="Your answer has been registered";
				}
				if(!$answer)
				{
					$noanswer="Please write something first";
				}
			}
			?>
			<form action="home_page.php" method="post">
			Your Answer<br/><input type="text" name="answer" placeholder="">
			<br/><input type="submit" name="submita" value="Post Answer">
			<input type="hidden" value="<?php echo $question_id; ?>" name="question">
			<br/><?php echo $noanswer; ?><?php echo $answer_post; ?>
			</form>
			<br/>
			<br/>
			<?php
		}include('nav_top.php'); 
		include('BottomNav.php');
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