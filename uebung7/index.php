<?php 
	include( 'inc/config.php');
	include( 'inc/autoload.php');

	include( 'inc/initDB.php');
	
	include( 'class/PostModel_RowDataGateWay.class.php');
	include( 'class/PostModel_TableDataGateWay.class.php');
	
echo '<h1>Row Data Gateway Pattern</h1>
	<p><a href="http://martinfowler.com/eaaCatalog/rowDataGateway.html">wiki</a></p>';	
	
	
	$post1 = new Post();
	$post1->create(array('title' => 'test'));
	
	echo 'title: '.$post1->getTitle().'<br/>';
	
	
	echo '<hr>';
	$post2 = new Post();
	$post2->create(array('title' => 'test2', 'content' => 'sali'));
	
	echo '<hr>';
	$post3 = new Post();
	$post3->create(array('title' => 'test3', 'content' => 'sali3'));
	
	
	echo '<hr>';
	//edit post 2:
	$post2->update(array('content' => 'uuuhh'));
	
	echo '<hr>';
	//delete post 1:
	$post1->delete();
	
	echo '<hr>';
	//find by id post 3:
	$post3_ref = new Post();
	$post3_ref->findByID( 3 );
	$post3_ref->update(array('content' => 'post3_changed after find by id'));
	
	
echo '<h1>Table Data Gateway Pattern</h1>
	<p><a href="http://martinfowler.com/eaaCatalog/tableDataGateway.html">wiki</a></p>';		
	
	
	$table = new PostTable();
	
	echo '<hr>';
	$post4_id = $table->createPost(array( 'title' => 'new post 4, tdg'));
	echo 'post4 id: '.$post4_id->getID().'<br/>';
	$table->updatePost(4,array('content' => 'editing post 4 content through table data gateway'));
	
	echo '<hr>';
	$post5_id = $table->createPost(array( 'title' => 'test2', 'content' => 'actually post 5, tdg, but test2 as title for testing findPostBy(\'title\',...)'));
	
	echo '<hr>';
	$post6_id = $table->createPost(array( 'title' => 'post 6, tdg'));
	echo 'post6 id: '.$post6_id->getID().'<br/>';
	$table->deletePost(6);
	
	echo '<hr>';
	$posts_by_id = $table->findPostBy('id',4);
	echo 'found posts by id 4: <br/>';
	foreach($posts_by_id as $post){
		echo $post->getTitle().'<br/>';
	}

	echo '<hr>';
	$posts_by_title = $table->findPostBy('title','test2');
	echo 'found posts by title test2: <br/>';
	foreach($posts_by_title as $post){
		echo $post->getContent().'<br/>';
	}


 ?>
 
 <br/>
 <br/>
 
 