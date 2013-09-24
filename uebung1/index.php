<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Description">
        <meta name="viewport" content="width=device-width">
        
		<title>DEMO</title>
		<link href="style/style.css" rel="stylesheet" media="screen" type="text/css">
		<script type="text/javascript" src="javascript/html5shiv.js"></script>
	</head>
	
	<body>
		
		<header>
			<h1>Testsite</h1>
			<nav>
				<?php include( 'inc/nav.php' ); ?>
			</nav>
		</header>
	
	
		<div id="contents">
			<?php 
		
			$dir = 'content/articles/';
			if ($handle = opendir($dir)) {

				/* This is the correct way to loop over the directory. */
				while (false !== ($entry = readdir($handle))) {
					if( $entry === '.DS' || $entry === '.' || $entry === '..' ) continue;
					echo '<article>';
					include($dir.$entry);
					echo '</article>';
				}
			}
			?>
		</div>
		<footer>
			footer
		</footer>
		
		
		<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="javascript/jquery.2.0.3.min.js"><\/script>')</script>
	</body>

</html>