<?php
	define('DEBUG',true);

	if(DEBUG){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}
	
	

?><!DOCTYPE html>
<html>
<head>
	<title>Listing of Bugs</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="javascripts.js"></script>
</head>
<body>
	
	<h2>Submitted Bugs</h2>
	<ul>
		<?php
			$folder = 'bugreports/';
			$dir = new RecursiveDirectoryIterator($folder); 
  
  
  			// Iterate through files/folders in the cakephp root folder
  			foreach (new RecursiveIteratorIterator($dir) as $file) {
  				$info = pathinfo($file);
  	
  				$filename = $file -> getFilename();
  				if ($file -> IsFile() && substr($filename, 0, 1) != "." ) { 
  					$data = unserialize(file_get_contents($file));
  					echo '<li>'.$data['name'].'</li>';
  				}
  			}
		?>
		
	</ul>

</body>
</html>