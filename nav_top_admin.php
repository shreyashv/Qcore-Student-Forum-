<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1"><!--Adding mobile responsiveness -->
<style>
	body {margin:0;
	height: auto;
	}
	
	*{
		margin: 0;
		padding: 0;
		font-family: verdana;
	}
	.topnav {
	margin-bottom: 100px;
    background-color: #000;
    overflow: hidden;
	position: fixed;
	top: 0;
    width: 100%;
}
	
	nav{
		overflow: hidden;
		width: 100%;
		height: 80px;
		background-color: #000;
		line-height: 80px;
		postion: fixed;
		top: 0;
		
	}
	
	#fl_right{
		float: right;
	}
	
	#fl_left{
		float: left;
	}
	
	nav ul li{
		list-style-type: none;
		display: inline-block;
		
	}
	
	nav ul li:hover{
		background-color: #38e07e;
		transition: 0.8s all;
	}
	
	nav ul li a{
		text-decoration: none;
		color: #fff;
		padding: 30px;
	}
</style>
<body>
<div class="topnav">
	<nav>
		<ul>
			<div id="fl_left">
				<li><a href="home_page_admin.php"><img src="Home-icon.png" width="40" height="40" style="display: inline-block;">Home</a></li>
				<li><a href="feedback_admin.php"><img src="adminfeedback.png" width="40" height="40">Feedbacks</a></li>
			</div>
			<div id="fl_right">
				<li><a align="right" href="logout.php"><img src="logout.png" width="40" height="40">Log Out</a></li>
			</div>
		</ul>
	</nav>
</div>
<br/>
</body>
</html>