<?php 
	include( 'inc/config.php');
	include( 'inc/autoload.php');

	include( 'inc/initDB.php');
	
	include( 'class/PostModel_RowDataGateWay.class.php');
	
	
	
	
	
	$post1 = new Post();
	$post1->create(array('title' => 'test'));
	
	
	$post2 = new Post();
	$post2->create(array('title' => 'test2', 'content' => 'sali'));
	
	$post3 = new Post();
	$post3->create(array('title' => 'test3', 'content' => 'sali3'));
	
	
	//edit post 2:
	$post2->update(array('content' => 'uuuhh'));
	
	
	//delete post 1:
	$post1->delete();
	
	
	//find by id post 3:
	$post3_ref = new Post();
	$post3_ref->findByID( 3 );
	$post3_ref->update(array('content' => 'post3_changed after find by id'));
	
	
	//$post1->findByID(1);
	

 ?>
 
 <br/>
 <br/>
 
 Row Data Gateway Pattern