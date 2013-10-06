<?php
	session_start();
	$status = (isset($_SESSION['state'])) ? $_SESSION['state'] : array();
	unset($_SESSION['state']);
	$get = explode('/',@$_GET['vars']);
	$todoListID = $get[0];
	
	
	$db = new PDO('mysql:host=localhost;dbname=php_mysql_programmieren', 'php_prog_user',
	'php_mysql_programmieren_pw');
	
	if( isset( $_POST['createNewList'] ) ) {
		$todoListID = uniqid();
		$state[] = 'new list created';
		$_SESSION['state'] = $state;
	
		$q = 'CREATE TABLE IF NOT EXISTS todos (
		   id int(11) unsigned NOT NULL auto_increment,
		   list_id varchar(255) NOT NULL default \'\',
		   text varchar(500) NOT NULL default \'\',
		   done int(10) NOT NULL default 0,
		   PRIMARY KEY (id)
		 )';
		$db->exec($q);
		//print_r($db->errorInfo(), true)
		
		header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
		die();
	}
	if(!empty($todoListID)){
		if ( isset( $_POST['newTodo'] ) ) {
			
			$stmt = $db->prepare("INSERT INTO todos (list_id, text) VALUES (:list_id, :text)");
			$stmt->bindParam(':list_id', $todoListID);
			$stmt->bindParam(':text', $_POST['text']);
			$stmt->execute();
			$status[]='Todo created';
			
			header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
			die();
			
		} else if ( isset( $_POST['saveTodo'] ) ) {
		
			$stmt = $db->prepare('UPDATE todos
			        SET text=:text, done=:done
			        WHERE list_id=:list_id AND id=:todo_id');
			$stmt->bindParam(':list_id', $todoListID);
			$stmt->bindParam(':text', $_POST['text']);
			$stmt->bindParam(':done', $_POST['done']);
			$stmt->bindParam(':todo_id', $_POST['todo_id']);
			$stmt->execute();
			
			$status[]='Todo updated';
			
			header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
			die();
		} else if ( isset( $_POST['saveDone'] ) ) {
		
			$stmt = $db->prepare('UPDATE todos
			        SET done=:done
			        WHERE list_id=:list_id AND id=:todo_id');
			$stmt->bindParam(':list_id', $todoListID);
			$stmt->bindParam(':done', $_POST['done']);
			$stmt->bindParam(':todo_id', $_POST['todo_id']);
			$stmt->execute();
			
			$status[]='Todo updated';
			
			header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
			die();
		}
		
		$stmt = $db->prepare("SELECT * FROM todos WHERE list_id= :list_id AND done=0");
		$stmt->bindParam(':list_id', $todoListID);
		$stmt->execute();
		$todoData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$stmt = $db->prepare("SELECT * FROM todos WHERE list_id= :list_id AND done=1");
		$stmt->bindParam(':list_id', $todoListID);
		$stmt->execute();
		$doneData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		function s($a, $b) {
		    if ($a['id'] == $b['id']) {
		       return 0;
		    }
		    return ($a['id'] < $b['id']) ? -1 : 1;
		}
		
		// Sort and print the resulting array
		uasort($todoData, 's');
		uasort($doneData,'s');
		
	} else {
		
	}
	define('DEBUG',false);
	date_default_timezone_set('Europe/Zurich');

	if(DEBUG){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}
	
	function createDoneForm( $todoID , &$t){
		global $todoListID;
		$checked = ($t['done']==1) ? ' checked="checked"' : '';
		return '<span class="editTodoLink"><span>'.$t['text'].'</span>
		<form method="post" class="inlineForm" action="'.dirname($_SERVER['PHP_SELF']).'/'.$todoListID.'">
			<input type="checkbox" class="autosaveOnChange" value="1" name="done"'.$checked.'/>
			<input type="hidden" name="saveDone" value="1"/>
			<input type="hidden" name="todo_id" value="'.$todoID.'"/>
			<input type="submit" class="hideWhenJSavailable" value="save"/>
		</form>
		
		</span><span class="editTodo"><form method="post" action="'.dirname($_SERVER['PHP_SELF']).'/'.$todoListID.'">
			<input type="text" class="autosaveOnChange" name="text" value="'.$t['text'].'"/>
			<input type="checkbox" class="autosaveOnChange" value="1" name="done"'.$checked.'/>
			<input type="hidden" name="saveTodo" value="1"/>
			<input type="hidden" name="todo_id" value="'.$todoID.'"/>
			<input type="submit" class="hideWhenJSavailable" value="save"/>
		</form></span>';
	}	
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Easy Todo</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/normalize.css" rel="stylesheet" media="screen">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/css/style.css" type="text/css" media="all" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/javascripts.js"></script>
	<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/js/bootstrap.min.js"></script>
</head>
<body>
	<?php if( $status ) { ?>
	<div id="state">
		<?php foreach ( $status as $s ) {
			echo $s.'<br/>';
		}; ?>
	</div>
	<?php } ?>
	
	
	<div class="container">
		<div class="row">
			<div class="span12">
					
				<h2>Easy Todo</h2>
				
				
				<?php if ( empty( $todoListID ) ) { ?>
					<h3>Create your easy todo now:</h3>
					<form action="<?php echo dirname($_SERVER['PHP_SELF']); ?>/" method="post">
						<input type="hidden" value="1" name="createNewList"/>
						<input type="submit" value="Create your todo list"/>
					</form>
				<?php } else { ?>
					
							<h3>New Todo</h3>
							<form action="<?php echo dirname($_SERVER['PHP_SELF']).'/'.$todoListID; ?>/" method="post">
								<input type="hidden" value="1" name="newTodo"/>
								<input type="text" value="" placeholder="Your new todo" name="text"/>
								<input type="submit" value="Create New Todo"/>
							</form>
							
							
							<div class="row-fluid">
								<div class="span6">
									<h3>Your Todos (<?php echo count($todoData); ?>)</h3>
									<ul>
									<?php 
									foreach($todoData as $todoArray ) {
										echo '<li>'.createDoneForm($todoArray['id'],$todoArray).'</li>';
									} ?>
									</ul>
								</div>
								<div class="span6">
									<h3>Done (<?php echo count($doneData); ?>)</h3>
									<ul>
									<?php foreach($doneData as &$todoArray ) {
										echo '<li>'.createDoneForm($todoArray['id'],$todoArray).'</li>';
									} ?>
									</ul>
								</div>
							</div>
		<?php } ?>
					</div>
				</div>
		</div>
</body>
</html>