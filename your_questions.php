<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Acme|Bree+Serif|Lobster|Open+Sans+Condensed:300" rel="stylesheet"> 
	<title>Your Questions</title>
	<style>
		body{
			font-family: Helvetica;
		}
		
		#yourquestions{
			margin-top: 100px;
		}
		#qglobal{
			text-decoration: none;
			padding: 30px;
			margin-left: 5%;
			margin-top: 10px;
			position: fixed;
			width: 200px;
			height: 425px;
			border-right: thick solid #38e07e;
		
		}
		#qbranch{
			text-decoration: none;
		}
		a {
			text-decoration: none;
			font-family: verdana;
		}
		
		#ans{
			color:  red;
			padding: 10px;
			font-family: 'Abril Fatface', cursive;
			font-size: 20px;
			
		}
		#ans:hover{
			color: #38e07e;
		}
		#title{
			margin-left: 5%;
		}
		#yq{
			font-family: 'Abril Fatface', cursive;
			font-size: 30px;
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
		#margin{
			width: 800px;
			margin-left: 30%;
		}
		
	</style>
</head>
<body>
	<div id="yourquestions" align="center">
		
		<div id="qglobal">
			<div id="title">Your Questions</div>
			<a href="your_questions.php?action=qpg"><div id="ans">Questions posted globally</div></a><a href="your_questions.php?action=qpb"><div id="ans">Questions posted in branch</div></a><br/>
		</div>
		
		<div id="margin"><center>	
			<?php  
				require('connect.php');
				$username=$_SESSION['username'];
				
				if(@$_GET['action']=='qpg')
				{
					$check=mysqli_query($connect,"SELECT * FROM questions where username='".$username."'");
					$row=mysqli_num_rows($check);
					?>
					<h3>Global Questions</h3>
					<?php
					if($row==0)
						{
							echo nl2br("No questions posted by you\n");
						}
					if($row!=0)
						{?>
					<div id="quesnans">
						<div id="username">
							<?php
							echo nl2br("Questions posted by"." $username\n\n");
							?>
						</div>
						<?php
							$question_no=0;
							while($row=mysqli_fetch_array($check))
							{
								$question_no++;
								$question_id=$row['questionid'];
								$question=$row['question'];
								$datetime=$row['date'];
								$time=$row['time'];
							
								echo nl2br("Question "."$question_no\n");
									?>
						<div id="question">
							<?php
								echo ("$question\n");
							?>
						</div>
						<div id="smalltime">
							<?php
								echo nl2br("Posted on $datetime"." at $time\n\n");
							?>
						</div>
					</div>
							<?php
								$check2=mysqli_query($connect,"SELECT * FROM answers where questionid='".$question_id."'");
								while($row2=mysqli_fetch_array($check2))
								{
									$db_username=$row2['username'];
									$db_answer=$row2['answer'];
									$db_date=$row2['date'];
									$db_time=$row2['time'];
									?>
									<div id="smalltime">
										<?php
										echo nl2br("Answer posted by "."$db_username\n"."$db_answer\n"."posted on $db_date"." at $db_time\n\n");
									?>
									</div>
									<?php
								}
							}
						}
				}
			?>
		
		<?php
			if(@$_GET['action']=='qpb')
			{
				$check=mysqli_query($connect,"SELECT * FROM branchquestions where busername='".$username."'");
				$row=mysqli_num_rows($check);
				?>
				<h3>Branch Questions</h3>
				<?php
				if($row==0)
					{
						echo "No questions posted by you";
					}
					if($row!=0)
					{
						?>
					<div id="quesnans">
						<div id="username">
							<?php
							echo nl2br("Questions posted by"." $username\n\n");
							?>
						</div>
						<?php
						$question_no=0;
							while($row=mysqli_fetch_array($check))
							{
								$question_no++;
								$question_id=$row['bquestionid'];
								$question=$row['bquestion'];
								$datetime=$row['bdate'];
								$time=$row['btime'];
								echo nl2br("Question "."$question_no\n");
									?>
						<div id="question">
							<?php
								echo ("$question\n");
							?>
						</div>
						<div id="smalltime">
							<?php
								echo nl2br("Posted on $datetime"." at $time\n\n");
							?>
						</div>
					</div>
							<?php
								$check2=mysqli_query($connect,"SELECT * FROM branchanswers where bquestionid='".$question_id."'");
								while($row2=mysqli_fetch_array($check2))
								{
									$db_username=$row2['busername'];
									$db_answer=$row2['banswer'];
									$db_date=$row2['bdate'];
									$db_time=$row2['btime'];
									?>
									<div id="smalltime">
										<?php
									echo nl2br("Answer posted by "."$db_username\n"."$db_answer\n"."posted on $db_date"." at $db_time\n\n");
									?>
									</div>
									<?php
								}
							}
					}
			}?>
			</center>
		</div>
		<?php
		include('nav_top.php');
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