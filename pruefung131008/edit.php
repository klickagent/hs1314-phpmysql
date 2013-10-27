<?php
	include('lib/autoload.php');
	
	
	init();
	
	if( !check_login() ) {
		redirect_to('login.php?goto='.urlencode($_SERVER['PHP_SELF']));
	}

	$ID = $_GET['id'];
	
	$file = 'data/blogentries/'.$ID.'.txt';
	if( ! is_file( $file ) ){
		$status[]='entry not found';
	} else {
		$status = save_blogentry();
		$data = unserialize(file_get_contents($file));
		
	}

	


?>


<?php echo create_head('Edit Entry',$status); ?> 
	
	<h1>My Blog</h1>
	
	<?php echo create_nav('create'); ?>
	
	<h2>Edit your blog entry</h2>
	
	<?php echo blogentry($data,'?id='.$ID); ?>

</body>
</html>