<?php 

include('config/config.php');
include('lib/functions.php');


function init(){	
	
	define('DEBUG',true);
	
	if(DEBUG){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}

	date_default_timezone_set('UTC');
	session_start();

}

 ?>