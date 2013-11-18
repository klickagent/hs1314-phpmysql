<?php 
header("Content-type: text/html; charset=utf-8");
	$dir = dirname( $_SERVER['PHP_SELF'] );
 ?>
 
 <?php 
 	$types = array( 'json', 'html' ,'xml' ) ;
 ?>
 
 
 <div>
 	Lösung von Benjamin Bütikofer, Jerome Koller und Roman Lickel
 </div>
 
 <h1>API Examples</h1>
 
 <ul>
 	<li>Resolver: 
 		<ul>
 		<?php  foreach ( $types as $type ) { ?>
 			<li><?php echo $type; ?>
	 		<ul>
	 			<li><a href="<?php echo $dir; ?>/resolver.php?service=kantone&methode=list&type=<?php echo $type; ?>">Liste von Kantone</a></li>
	 			<li><a href="<?php echo $dir; ?>/resolver.php?service=kantone&methode=list&sort=name&sortType=asc&type=<?php echo $type; ?>">sortierte Liste von Kantone</a></li>
	 			<li><a href="<?php echo $dir; ?>/resolver.php?service=kantone&methode=list&sort=name&sortType=desc&type=<?php echo $type; ?>">sortierte Liste von Kantone absteigend</a></li>
	 			
	 			<li>-----</li>
	 			<li><a href="<?php echo $dir; ?>/resolver.php?service=kantone&methode=single&id=zh&type=<?php echo $type; ?>">by id, wert zh</a></li>
	 			
	 		</ul>
	 		</li>
	 	 <?php } ?>
	 	</ul>
	 </li>
	 <li>
	 	
	 Nicer Url:
	 		<ul>
 		<?php  foreach ( $types as $type ) { ?>
	 		<li><?php echo $type; ?>
	 		<ul>
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/?type=<?php echo $type; ?>">Liste von Kantone</a></li>
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/?sort=name&sortType=asc&type=<?php echo $type; ?>">sortierte Liste von Kantone</a></li>
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/?sort=name&sortType=desc&type=<?php echo $type; ?>">sortierte Liste von Kantone absteigend</a></li>
	 			
	 			<li>-----</li>
	 			
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/showById/zh?type=<?php echo $type; ?>">by id, wert zh</a></li>
	 			
	 			<li>-----</li>
	 			
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/showByHauptort/Altdorf?type=<?php echo $type; ?>">by Hauptort, wert Altdorf</a></li>
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/?sort=Einwohner 1&sortType=asc&type=<?php echo $type; ?>">Liste von Kantone, sortiert nach Einwohner</a></li>
	 			<li><a href="<?php echo $dir; ?>/Kantone/list/?sort=Einwohner 1&sortType=desc&type=<?php echo $type; ?>">Liste von Kantone, sortiert nach Einwohner absteigend(<?php echo $type; ?>)</a></li>
	 			
	 			
	 		</ul>
	 			</li>
	 		<?php } ?>
	 	</ul>
 </ul>
 
