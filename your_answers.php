<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Bree+Serif|Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
	<title>Your Answers</title>
	
	<style>
		#your_answers{
			margin-top: 90px;
			
		}
		#aglobal{
		text-decoration: none;
		padding: 30px;
		margin-left: 5%;
		margin-top: 10px;
		position: fixed;
		width: 200px;
		height: 425px;
		border-right: thick solid #38e07e;
		}
		a {
			text-decoration: none;
		}
		#ans{
			color:  red;
			font-family: 'Abril Fatface', cursive;
			font-size: 20px;
		}
		#ans:hover{
			color: #38e07e;
		}
		#ansgnb{
			font-family: 'Josefin Sans', sans-serif;
		}
		#answer{
			width: 800px;
			margin-left: 30%;
		}
		#title{
			font-size: 30px;
			font-family: 'Acme', sans-serif;
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

	<div id="your_answers">
		<div id="aglobal">
			<center><div id="title">Your Answers</div></center><br/>
			<center><a href="your_answers.php?action=apg"><div id="ans">Answers posted globally</div></a><br/><a href="your_answers.php?action=apb"><div id="ans">Answers posted in branch</div></a></center>
		</div>
		
		<div id="answer"><center>
			<?php 
			require('connect.php');
			$username=$_SESSION['username'];
				if(@$_GET['action']=='apg')
				{
					?>
					<h3>Global Answers</h3>
					<?php
					$check=mysqli_query($connect,"SELECT * FROM answers where username='".$username."'");
					$row3=mysqli_num_rows($check);
					if($row3==0)
					{
						echo nl2br("No questions answered by you globally\n");
					}
					while($row=mysqli_fetch_array($check))
					{
						?>
						<br/>
						<br/>
						<?php
						$question_id=$row['questionid'];
						$check2=mysqli_query($connect,"SELECT * FROM questions where questionid='".$question_id."'");
							while($row2=mysqli_fetch_array($check2))
							{
								$db_username=$row2['username'];
								$db_question=$row2['question'];
								$datetime=$row2['date'];
								$time=$row2['time'];
									echo nl2br("Question posted by"." $db_username\n");
									echo nl2br("$db_question\n");
									echo nl2br("Posted on $datetime"." at $time\n\n");		
							}	
						$db_answer=$row['answer'];
						$db_date=$row['date'];
						$db_time=$row['time'];
						?>
					<div id="quesnans">
						<div id="username">
							<?php
								echo nl2br("\nAnswer posted by "."$username\n"); 
							?>
						</div>
						<div id="question">
							<?php echo nl2br("$db_answer\n"); ?>
						</div>	
						<div id="smalltime">
							<?php echo ("Posted on $db_date"." at $db_time");?>
						</div>
					</div>
					<?php
					}
				}
			?>
			<?php
				if(@$_GET['action']=='apb')
				{
					$check=mysqli_query($connect,"SELECT * FROM branchanswers where busername='".$username."'");
					$row3=mysqli_num_rows($check);
					?>
					<h3>Branch Answers</h3>
					<?php
					if($row3==0)
						{
							echo "No questions answered by you in branch";
						}
					while($row=mysqli_fetch_array($check))
					{
						$question_id=$row['bquestionid'];
						$check2=mysqli_query($connect,"SELECT * FROM branchquestions where bquestionid='".$question_id."'");
						while($row2=mysqli_fetch_array($check2))
						{
							$db_username=$row2['busername'];
							$db_question=$row2['bquestion'];
							$datetime=$row2['bdate'];
							$time=$row2['btime'];
							echo nl2br("\nQuestion posted by"." $db_username\n");
							echo nl2br("$db_question\n"."posted on $datetime"." at $time\n\n");
						}
						$db_answer=$row['banswer'];
						$db_date=$row['bdate'];
						$db_time=$row['btime'];
							?>
					<div id="quesnans">
						<div id="username">
							<?php
								echo nl2br("\nAnswer posted by "."$username\n"); 
							?>
						</div>
						<div id="question">
							<?php echo nl2br("$db_answer\n"); ?>
						</div>	
						<div id="smalltime">
							<?php echo ("Posted on $db_date"." at $db_time");?>
						</div>
					</div>
					<?php
					}
				}
				?>
			</center>
		</div>		
			<?php
		include('nav_top.php');
		include ('BottomNav.html');
		?>
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