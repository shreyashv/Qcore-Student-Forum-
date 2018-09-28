<?php
  session_start();
  require('connect.php');
  if(@$_SESSION["username"])
  {
?>
<html>
	<head>
		<title>
			About Us
		</title>
		<style>
			body{
				color: #000;
				font-family: verdana;
				background-image: url("bg-img2.jpg");
			}
			#div1{
				color: #fff;
				background-color: #0009;
				width: 800px;
				height: 400px;
			}
			#aboutus{
				margin-top: 100px;
				font-family: verdana;
				
			}
			li{
				padding: 10px;
			}
		</style>
	</head>
	<body>
		<?php
			include ('nav_top.php');
			include ('BottomNav.html');
		?>
		<center>
		<div id="div1">
			<center>
			<div id="aboutus">
				<h2 style="padding:20px">This Projected Has Been Created By</h2>
				<div  align="left">
						<center><h4>Manas Ojha: Second Year CS Student, Android Enthusiast, Undergoing Full Stack Development Training, Loves to play Guitar and Table Tennis</h4><br/></center>
						<center><h4>Shreyash Vishwakarma: Second Year CS Student, PHP Enthusiast and future Android Developer, Effective Juggler between College, Watching Series, PC games and Football (Basically What you call a SCHOLAR)</h4></center>
						<br/><center><h4>Vineeth Venu Nair: Second Year CS Student, Another Scholar on our hands, he loves to play football and Primal, Easily finds Bugs in Codes</h4></center>
						<br/><center><h4>Poojan Patel: Second Year CS Student, When it comes to exam prep, keep an eye on him as usually what comes in paper are the only topics he prepares. Python developer and can hack your wifi router (So beware...)</h4></center>
					</ul>
				</div>
			</div>
			</center>
		</div>	
		</center>
	</body>
</html>
<?php
}
else
  {
    echo "you must be logged in";
  }
?>