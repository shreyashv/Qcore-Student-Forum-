<!DOCTYPE html>
<html>
<body>

<?php
$fetch="1";
// case-sensitive constant name
define("GREETING", "$fetch");
define("GREETING",2);
if(GREETING==1)
{
echo GREETING;
}
else
{
	echo "chutiya";
}
?> 

</body>
</html>
