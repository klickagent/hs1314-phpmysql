<?php
	include('lib/autoload.php');
	
	
	init();
	
	if( !check_login() ) {
		redirect_to('login.php?goto='.urlencode($_SERVER['PHP_SELF']));
	}
	$status = array();

	$ID = $_GET['id'];
	
	$file = 'data/blogentries/'.$ID.'.txt';
	if( isset( $_POST['submit'] ) && $_POST['submit']  === '1' ){
		unlink($file);
		$status[] = 'entry removed';
	}
	


?>


<?php echo create_head('Edit Entry',$status); ?> 
	
	<h1>My Blog</h1>
	
	<?php echo create_nav('create'); ?>
	
	<?php if( is_file($file) ) { ?>
	
	<h2>Remove Blog entry <?php echo $ID; ?> permanenlty?</h2>
	
	
	<form class="form" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$ID; ?>" method="post">
		<input type="hidden" name="submit" value="1"/>
		
		<input type="submit" value="remove blog post"/>
	</form>

	<?php } else { ?>
		
		Blog entry "<?php echo $ID; ?>" has already been removed

	<?php } ?>
</body>
</html>