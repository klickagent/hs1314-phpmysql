<?php 
	include( 'inc/config.php');
	include( 'inc/autoload.php');

	include( 'inc/initDB.php');
	
	include( 'class/PostModel_RowDataGateWay.class.php');
?><!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8" />
	<title>PHP MYSQL Übungen</title>
</head>
<body>
<?php
	
echo '

<a href="todo/">Todo app mit Gateway Patterns (Optimistic Locking)</a>

<h1>Aufgabe 4, Row Data Gateway Pattern mit optimistischem Locking</h1>
	<p><a href="http://martinfowler.com/eaaCatalog/rowDataGateway.html">wiki rowtablegateway</a>, <a href="http://martinfowler.com/eaaCatalog/optimisticOfflineLock.html">wiki optimistic lock</a></p>';	
	
	
	//POST 1 wird von User 1 erstellt
	$post1 = new Post();
	$post1->create(array('content' => 'post1 content'));
	
	echo '<hr>P1 content:<br/>';
	echo $post1->content;
	echo '<hr>';
	
	
	//POST 1 wird von User 2 bearbeitet
	//find by id post 1, change its content:
	$post1_conc = new Post();
	$post1_conc->findByID( 1 );
	$post1_conc->update(array('content' => 'this is the new content, added after post1 has been loaded by row data gateway'));
	
	echo '<hr>P1 content:<br/>';
	echo $post1_conc->content;
	echo '<hr>';
	
	
	//POST 1 wird von User 1 erneut bearbeitet, kann aber nicht gespeichert werden, da diese Post bereits von User 2 verändert wurde
	$post1->update(array('content' => 'this would be the final content of post1, but should not be written to db, because of the conflict'));
	
	echo '<hr>P1 content:<br/>';
	echo $post1->content;
	echo '<hr>';
	
	

 ?>
		 
		 <br/>
		 <br/>
		 
		 <h1>Aufgabe 5</h1>
		 
		 Beispiel (siehe vorherige Aufgabe (src))
		 Im Beispiel wird deutlich, dass der optimistic Lock die Data-Row nicht beim ersten Zugriff lockt , sondern lediglich den Status der Ressource speichert (zB. Timestamp/Version etc).
		  
		  Der generelle Ablauf:
		 <ul>
		 	<li>POST 1 wird von User 1 erstellt</li>
		 	<li>POST 1 wird von User 2 bearbeitet</li>
		 	<li>POST 1 wird von User 1 erneut bearbeitet, kann aber nicht gespeichert werden, da diese Post bereits von User 2 verändert wurde</li>
		 	<li>Der User 1 bekommt eine Fehlermeldung, dass seine Änderung nicht gespeichert werden konnte*</li>
		 </ul>
		 
		 *Conflicting Update: Möchte ein User eine bereits geänderte Ressource überschreiben gibt die Software eine OptimisticLockException zurück, da die Änderungen nicht gespeichert werden konnte. Danach versucht diese erneut die Daten in die Datenbank zu schreiben, und bricht bei zuvielen Exceptions ab und zeigt dem User eine Fehlermeldung.
		 
		 
		  <h1>Aufgabe 6</h1>
		 Situation wo zwei oder mehrere konkurrierende Aktionen (Befehlsausführungen) aufeinander warten bis jeweils ein anderer beendet wird, dadurch blockieren sich die Aktionen gegenseitig und das gesamte System wird blockiert. Bei MySQL (InnoDB) kann ein Deadlock zum Beispiel bei Share Lock/Exlusive Lock entstehen:
		 
		 <ul>
		 	<li>User 1 holt Data-Row von Tabelle (Share Lock)</li>
		 	<li>User 2 möchte dieselbe Data-Row von der Tabelle löschen (Exclusiv Lock), muss aber warten bis User 1 die Row freigibt</li>
		 	<li>User 1 möchte nun ebenfalls diese Data-Row löschen (Exclusiv Lock), wartet bis User 2 den Exlusiv Lock verlassen hat</li>
		 	<li>&nbsp;</li>
		 	<li>somit warten beide User auf jeweils den anderen um die Row freizugeben, um seine Aktion auszuführen => Deadlock</li>
		 </ul>
		 
		 
		 <h1>Aufgabe 7</h1>
		 <ul>
		 	<li>Lost update</li>
		 	<li>Non repeatable read</li>
		 </ul>
	 
	 </body>
 </html>