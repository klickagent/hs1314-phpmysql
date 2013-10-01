<?php
$multiCity = array(
    array('City', 'Country', 'Continent'),
    array('Tokyo', 'Japan', 'Asia'),
    array('Mexico City','Mexico', 'North America'),
    array('New York City', 'USA', 'North America'),
    array('Mumbai', 'India', 'Asia'),
    array('Seoul', 'Korea', 'Asia'),
    array('Shanghai', 'China', 'Asia'),
    array('Lagos', 'Nigeria', 'Africa'),
    array('Buenos Aires', 'Argentina', 'South America'),
    array('Cairo', 'Egypt', 'Africa'),
    array('London', 'UK','Europe')
);

$head = $multiCity[0];
 unset($multiCity[0]);
?>
<html>
<head>
<title>Multi-dimensional Array</title>
<style type="text/css">
td, th {width: 8em; border: 1px solid black; padding-left: 4px;}
th {text-align:center;}
table {border-collapse: collapse; border: 1px solid black;}
</style>
</head>
 <body>
<h2>Auflistung Array<br /></h2>



 <table>
 <tr>
<?php
// table head ausgeben
foreach( $head as $desc){
	echo '<th>'.$desc.'</th>';
}
?>
</tr>
 <?php

 foreach( $multiCity as $line){
 	echo '<tr>';
 	foreach( $line as $c ) {
		echo '<td>'.$c.'</td>';
	}
	echo '</tr>';
 }
// durchiterieren und key/values ausgeben
?>
 </table>
 
 
 
 
 
<h2>Auflistung der St&auml;dte in Asien<br /></h2>
  <table>
 <tr>
<?php
// table head ausgeben
foreach( $head as $desc){
	echo '<th>'.$desc.'</th>';
}
?>
</tr>
 <?php
 foreach( $multiCity as $line){
 	if( $line[2] !== 'Asia' ) continue;
 	echo '<tr>';
 	
 	foreach( $line as $c ) {
 		
		echo '<td>'.$c.'</td>';
	}
	echo '</tr>';
 }
// durchiterieren und key/values ausgeben
?>
 </table>
 
 
 
<h2>Auflistung der Kontinente, sowie die Zahl der L&auml;nder darin (im Array)<br /></h2>
 
<table>
 <tr>
<?php
// table head ausgeben

for( $i = 2 ; $i >= 1 ; $i-- ){
	echo '<th>'.$head[$i].'</th>';
}
?>
</tr>
 <?php
 $continents = array();
 
 foreach( $multiCity as $line){
 	if( !isset( $continents[$line[2]] )) $continents[$line[2]] = array();
 	$continents[$line[2]][] = $line;
 }
 foreach ( $continents as $line => $c ){
 	echo '<tr>';
 		echo '<td>'.$line.'</td>';
 		echo '<td>'.count($c).'</td>';
	echo '</tr>';
 }
// durchiterieren und key/values ausgeben
?>
 </table>
 
 
 
 
<h2>Auflistung nach L&auml;nder A-Z <br /></h2>
 <table>
 <tr>
<?php
// table head ausgeben

for( $i = 1 ; $i >= 0 ; $i-- ){
	echo '<th>'.$head[$i].'</th>';
}
?>
</tr>
 <?php
 $countries = array();
 
 foreach( $multiCity as $line){
 	if( !isset( $countries[$line[1]] )) $countries[$line[1]] = array();
 	$countries[$line[1]][] = $line;
 }
 ksort($countries,SORT_REGULAR);
  //die();
 foreach ( $countries as $line => $cA){
 	echo '<tr>';

 	foreach( $cA as $c ){
			echo '<td>'.$line.'</td>';
			echo '<td>'.$c[0].'</td>';
	}
	echo '</tr>';
 }
// durchiterieren und key/values ausgeben
?>
 
 
</body>
</html>