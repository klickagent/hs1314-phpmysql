<?php
	
	include( '../class/PostModel_RowDataGateWay.class.php');
	include( '../class/PostModel_TableDataGateWay.class.php');

	include( 'inc/config.php');
	include( '../inc/autoload.php');
	
	include( 'inc/initDB.php');
	

	session_start();
	$status = (isset($_SESSION['state'])) ? $_SESSION['state'] : array();
	unset($_SESSION['state']);
	$get = explode('/',@$_GET['vars']);
	$todoListID = $get[0];
	

	
	if( isset( $_POST['createNewList'] ) ) {
		$todoListID = uniqid();
		$state[] = 'new list created';
		$_SESSION['state'] = $state;

		//print_r($db->errorInfo(), true)
		
		header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
		die();
	}
	if(!empty($todoListID)){
		if ( isset( $_POST['newTodo'] ) ) {
			
			if( empty( $_POST['text'] ) ) {
				$status[]='Todo cannot be empty';
			} else {
				$post1 = new Post(false,$tableName,$tableFields);
				$post1->create(array('list_id' => $todoListID, 'text' => $_POST['text']));
				
				$status[]='Todo created';
				$_SESSION['state'] = $status;
				header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
				die();
			}
			
		} else if ( isset( $_POST['saveTodo'] ) ) {
		
			$post1 = new Post(false,$tableName,$tableFields);
			$post1->findByID($_POST['todo_id']);
			$post1->update( array('list_id' => $todoListID, 'text' => $_POST['text'], 'done' => $_POST['done']) );
		
			
			$status[]='Todo updated';
			$_SESSION['state'] = $status;
			header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
			die();
		} else if ( isset( $_POST['saveDone'] ) ) {
		
			$post1 = new Post(false,$tableName,$tableFields);
			$post1->findByID($_POST['todo_id']);
			$post1->update( array('list_id' => $todoListID, 'done' => $_POST['done']) );
			
			
			$status[]='Todo updated';
			$_SESSION['state'] = $status;
			header('Location: '.dirname($_SERVER['PHP_SELF']).'/'.$todoListID .'/');
			die();
		}
		
		$postTable = new PostTable($tableName);
		$postTable->findPostBy(array('list_id' => $todoListID, 'done' => 0));
		$todoData = $postTable->fetchAll();
		
		$postTableDone = new PostTable($tableName);
		$postTableDone->findPostBy(array('list_id' => $todoListID, 'done' => 1));
		$doneData = $postTableDone->fetchAll();
		
		/*$stmt = $db->prepare("SELECT * FROM todos WHERE list_id= :list_id AND done=0");
		$stmt->bindParam(':list_id', $todoListID);
		$stmt->execute();
		$todoData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$stmt = $db->prepare("SELECT * FROM todos WHERE list_id= :list_id AND done=1");
		$stmt->bindParam(':list_id', $todoListID);
		$stmt->execute();
		$doneData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		*/
		
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
		<div class="bottomborder"></div>
	</div>
	<?php } ?>
	
	
	<div class="container">
		<div class="row">
			<div class="span12">
					
				<h2><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>">Easy Todo</a></h2>
				
				
				<?php if ( empty( $todoListID ) ) { ?>
					<h3>Create your list now</h3>
					<br/>
					<br/>
					<form action="<?php echo dirname($_SERVER['PHP_SELF']); ?>/" method="post">
						<input type="hidden" value="1" name="createNewList"/>
						<input type="submit" value="Create your todo list"/>
					</form>
				<?php } else { ?>
					
							<h3>New Todo</h3>
							<form action="<?php echo dirname($_SERVER['PHP_SELF']).'/'.$todoListID; ?>/" method="post">
								<input type="hidden" value="1" name="newTodo"/>
								<input type="text" value="" placeholder="Your new todo" name="text"/>
								<input type="submit" value="&nbsp;&nbsp;OK&nbsp;&nbsp;"/>
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