<style>
	#profiletop{
		position: fixed;
		width: 800px; 
		height: 100px;
		 overflow: hidden;
		position:fixed;
		top: 20;
		width: 100%;
	}
</style>
<?php
  
  require('connect.php');
  if(@$_SESSION["username"])
  {
	  $username=@$_SESSION['username'];
?>
	<div id="profiletop">
		<?php
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
			<form action="home_page.php" method="POST">
				<br/> <br/>
				Welcome <?php echo $_SESSION['username']; ?> <br/><br/>  
				Write your question<br/><input type="text" name="question">
				<br/><input type="submit" name="submitq" value="POST">
				<br/><?php echo $notposted; ?><?php echo $posted; ?><?php echo $char; ?>
			</form>
			<br/>



	</div>
<?php
}
else
  {
    echo "you must be logged in";
  }
?>