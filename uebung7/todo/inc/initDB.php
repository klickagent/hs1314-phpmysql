<?php 

$stmt = $db->prepare('CREATE TABLE IF NOT EXISTS todos (
   id int(11) unsigned NOT NULL auto_increment,
   list_id varchar(255) NOT NULL default \'\',
   text varchar(500) NOT NULL default \'\',
   done int(10) NOT NULL default 0,
   PRIMARY KEY (id)
 )');
$stmt->execute();
$stmt->closeCursor();
 ?>