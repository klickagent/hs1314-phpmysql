<?php 

	define('DB_HOST', '127.0.0.1');
	define('DB', 'php_mysql_programmieren');
	define('DB_USER', 'php_prog_user');
	define('DB_PW', 'php_mysql_programmieren_pw');
	
	$tableFields = array('list_id','text','done');
	$tableName = 'todos_v';
	
	define('DEBUG_DB_QUERIES',false);
 ?>