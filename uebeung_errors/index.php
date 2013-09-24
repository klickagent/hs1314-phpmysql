<!doctype html>
<html>
	<head>
		<title>errors</title>
	</head>
	<body>
	<?php
		ini_set('display_errors', 1);
		error_reporting (E_ALL);
		echo "<br/>Der WErt der Variable i ist: $i <br/>";
		echo 4 / 0 ;
		
		error_repoting(E_ALL);
	?>
	</body>
	
</html>