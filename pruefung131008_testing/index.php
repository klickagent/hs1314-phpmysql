<?php
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Prüfung</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/normalize.css" rel="stylesheet" media="screen">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/style.css" type="text/css" media="all" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/javascripts.js"></script>
	<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/bootstrap.min.js"></script>
	
	
	<style>
		
		/*1 class + 1 element = 11*/
		#sidebar p[lang="en"]{
			background:  red;
		}
		
		/*1 ID + 1 attribute + 1 element = 111*/
		body #main .post p {
			background: green;
		}
		body #main p.note{
			background:  blue;
		}
		/*1 ID + 1 class + 1 pseudo­class + 3 elements = 123*/
	</style>
</head>
<body>
<?php 


function z($p,$q){
	return ($q==0) ? $p : z($q,$p%$q);
}

echo z(24,8);
	
/*
for( $i = 0 ; $i<=20;  $i++ ){
	for( $j = 0 ; $j<=20 ; $j++ ){
		echo z($i,$j).'<br/>';
	}
}
*/

/*
function x10(&$number)
	$number *= 10;
	$count = 5;
	x10($count);
	echo $count);

*/
/*
define('BAR',10);
$a = array( 10 => BAR, "BAR" => 20 );
print $a[$a[BAR]] * $a['BAR'];
*/
 ?>
 
</body>
</html>