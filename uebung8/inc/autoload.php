<?php 

	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB,DB_USER,DB_PW);
	//$db = new PDO('mysql:host=localhost;dbname=loc_orm','loc_orm','12341234');
	
	date_default_timezone_set('Europe/Zurich');
 ?>