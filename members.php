<?php
	session_start();
	require('connect.php');
	if(@$_SESSION["username"]){
	
	
?>
<html>
	<head>
		<title>Members</title>
		
	</head>
	
	<?php 
		include["header.php"];
		
	?>
	
	<body>
		
	</body>
</html>	

<?php
	
	}
	else{
		echo "You must be logged in.";
	}
?>