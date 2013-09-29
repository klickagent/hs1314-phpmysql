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
  					echo '<li><h3>Error Report</h3>'.$data['name'];
  					if(!empty($data['submitdate'])) echo ' date: '.$data['submitdate'].' time: '.$data['submittime'];
  					if(!empty($data['username'])) echo ' user: '.$data['username'].'';
  					if(!empty($data['text'])) echo ' <h4>Description:</h4><p>'. $data['text']. '</p>';
  					if(!empty($data['filepath'])) echo ' <h4>File:</h4><a href="'.$data['filepath'].'" target="_blank">'.basename($data['filepath']).'</a>';
  					echo '</li>';
  				}
  			}
		?>
		
	</ul>

</body>
</html>