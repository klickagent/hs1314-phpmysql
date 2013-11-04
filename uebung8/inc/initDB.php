<?php 

$stmt = $db->prepare('DROP TABLE IF EXISTS `tbl_person`;

CREATE TABLE `tbl_person` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `_version` float(30) NOT NULL DEFAULT 0,
  `created` timestamp NULL DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `content` char(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;');
$stmt->execute();
$stmt->closeCursor();
 ?>