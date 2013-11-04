<?php 

$stmt = $db->prepare('CREATE TABLE IF NOT EXISTS todos_v (
   id int(11) unsigned NOT NULL auto_increment,
   _version float(30) NOT NULL DEFAULT 0,
   list_id varchar(255) NOT NULL default \'\',
   text varchar(500) NOT NULL default \'\',
   done int(10) NOT NULL default 0,
   PRIMARY KEY (id)
 )');
$stmt->execute();
$stmt->closeCursor();
 ?>