<?php 
	include( 'inc/config.php');
	include( 'inc/autoload.php');

	include( 'inc/initDB.php');
	
	include( 'class/PostModel_RowDataGateWay.class.php');
	include( 'class/PostModel_TableDataGateWay.class.php');
	
echo '<a href="index.php">back</a>';
	
echo '<h1>Row Data Gateway Pattern</h1>
	<p><a href="http://martinfowler.com/eaaCatalog/rowDataGateway.html">wiki</a></p>';	
	
	
	$post1 = new Post();
	$post1->create(array('title' => 'test1'));
	
	//shortcut create:
	$post2 = new Post(array('title' => 'test2', 'content' => 'inhalt2'));
	
	
	$post1->update(array('content' => 'content1, added afterwards'));
	$post1->delete();
	
	
	
	$table = new PostTable();
	$tablePost1 = $table->createPost(array('title' => 'tablepost1'));
	$tablePost1->update(array('content' => 'tablepost1 edited by row data gateway'));

	//create empty post
	$tablePost2 = $table->createPost();
	
	//update post2, through tabledata gateway
	$table->updatePost($post2->getID(),array('content' => $post2->getContent().' added info through tabledatagateway'));

 ?>
 
 <br/>
 <br/>
 
 