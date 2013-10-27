<?php
	include('lib/autoload.php');
	
	
	init();
	
	if( !check_login() ) {
		redirect_to('login.php?goto='.urlencode($_SERVER['PHP_SELF']));
	}

	$status = save_blogentry();


?>


<?php echo create_head('Create Blog entry',$status); ?> 
	
	<h1>My Blog</h1>
	
	<?php echo create_nav('create'); ?>
	
	<h2>Create a new blog entry</h2>
	
	<?php echo blogentry($_POST); ?>

</body>
</html>