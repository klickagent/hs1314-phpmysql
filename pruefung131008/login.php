<?php 
	
	include('lib/autoload.php');
	
	init();
	
	if( isset( $_POST['submit'] ) && $_POST['submit']  === '1' ){
		
		if( array_key_exists($_POST['username'], $users ) && $_POST['password'] == $users[$_POST['username']] ){ 
			$_SESSION['username'] = $_POST['username'];
		} else {
			$status[] = 'Login failed';
			
			unset($_SESSION['username']);
		}
	}
	
	
	//redirect to list when logged in succesfully
	if( check_login() ) {
		
		if(!empty($_POST['goto'])){
			$url = urldecode($_POST['goto']);
			$absolute = true;
		} else {
			$url = 'index.php';
			$absolute = false;
		}
		
		redirect_to($url,$absolute);
		die();
	}
	
 ?>



<?php echo create_head('Login required'); ?> 


<h2>My Blog</h2>

<?php echo create_nav('login'); ?>
 
 <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateValues();">
 
 
 	<input type="hidden" name="submit" value="1"/>
 	<h3>Login</h3>
 	
 	<input type="hidden" name="goto" value="<?php echo @$_GET['goto']; ?>"/>
 	
 	<input type="text" name="username" placeholder="Username" value="<?php echo @$_POST['username']; ?>" required="required"/>
 	<input type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>" required="required"/>
 	
 	<br/>
 	
 	
 	<p class="submit">
 		<input type="submit" value="Login" />
 	</p>
 	
 </form>
 <?php echo create_html_end(); ?>