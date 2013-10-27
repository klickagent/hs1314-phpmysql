<?php 

	
	function create_head($title,$status=false){
		$out = '
			<!DOCTYPE html>
			<html>
			<head>
				<title>'.$title.'</title>
				<meta charset="utf-8" />
				<link rel="stylesheet" href="style.css" type="text/css" media="all" />
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
				<script src="javascripts.js"></script>
			</head>
			<body>
		';
		
		if( $status ) {
			$out.= '<div id="state">';
			 foreach ( $status as $s ) {
				$out.=  $s.'<br/>';
			};
		$out.= '</div>';
		}
		
		return $out;
	}
	
	
	function create_nav($current=false){
		global $sites;
		
		$out='
		<nav>
			<ul>';
		foreach( $sites as $site => $c ){
				$current = ($site === $current) ? ' class="current"' : '';	
				$out .= '<li'.$current.'><a href="'.$c['link'].'">'.$c['title'].'</a></li>';
		}
		$out.='	</ul>
		</nav>';
		
		return $out;
	}
	
	
	function create_html_end(){
		return '
			
			</body>
			</html>
		';
	}
	
	
	function check_login(){
		return (isset($_SESSION['username']));
	}

	function redirect_to($url,$absolute=false){
		if(!$absolute)$url = dirname( $_SERVER['PHP_SELF'] ).'/'.$url;

		header('Location: '. $url);
		die();
	}
	
	
	function blogentry($data,$actionExtension=''){
		$ID = @$_GET['id'];
		
		$out = '<form class="form" action="'.$_SERVER['PHP_SELF'].$actionExtension.'" method="post" onsubmit="return validateValues();">
			<input type="hidden" name="submit" value="1"/>
			
			<p class="name">
				<input type="text" name="name" id="name" placeholder="Author" value="'.@$data['name'].'" required="required"/>
				<label for="name">Author</label>
			</p>
			
			<p class="web">
				<input type="text" name="title" id="title" placeholder="Title" required="required" value="'.@$data['title'].'"/>
				<label for="web">Title</label>
			</p>		
		
			<p class="text">
				<textarea name="text" placeholder="Your blog content" required="required"/>'.@$data['text'].'</textarea>
			</p>
			
			<p>
				<label for="date">
					Date
				</label>
				<input type="date" name="date" required="required" value="'.@$data['date'].'"/>
			</p>
			
				
			<p class="submit">
				<input type="submit" value="';
			$out .= ( !empty( $ID ) ) ? 'Save' : 'Create';	
		$out .=		'" />
			</p>
		<input type="hidden" name="id" value="'.$ID.'"/>
			
		</form>
		';
		return $out;
	}
	
	
	function save_blogentry(){
		$status = array();
		
		
		//data submitted:
			if( isset( $_POST['submit'] ) && $_POST['submit']  === '1' ){
				
				$filepath= '';
				if( isset( $_FILES["file"] ) && $_FILES['file']['size'] > 0 ){
					if ($_FILES["file"]["error"] > 0){
						$status[] = " fileupload error: " . $_FILES["file"]["error"] . "";
					} else {
						if( is_file( 'uploaded_files/'.basename($_FILES["file"]["name"]) ) ) {
							$status[] = 'Fileupload failed';
						} else {
							$filepath = 'uploaded_files/'.basename($_FILES["file"]["name"]);
							move_uploaded_file($_FILES['file']['tmp_name'],$filepath );
						}
					}
					
				}
				
				if(empty($_POST['name']) ){
					$status[] = 'name empty';
				}
				
				
				if(empty($_POST['title']) ){
					$status[] = 'title empty';
				}		
				if(empty($_POST['text']) ){
					$status[] = 'text empty';
				}
				
				
				if(empty($_POST['date']) ){
					$status[] = 'date empty';
				} else {
					$format = 'Y-m-d';
					$d = DateTime::createFromFormat($format, $_POST['date']);
					
					if( !$d || $d->format($format) != $_POST['date'] )
						$status[] = 'date format error';
				}
				
				if( count($status) === 0 ){
					$data = array();
					$data['name'] = $_POST['name'];
					$data['text'] = $_POST['text'];
					$data['title'] = $_POST['title'];
					
					$data['date'] = $_POST['date'];
					
					
					$data['submittime'] = @time('H:i:s');
					$data['submitdate'] = @date('Y.m.d');
					$data['filepath'] = $filepath;
		
					$data['username'] = $_SESSION['username'];
					
					$date = new DateTime();
					$timestamp = $date->getTimestamp();
					
					if( !empty( $_POST['id'] )){
						 $filename = $_POST['id'];
						 $msg = 'Blog entry saved';
						 
					} else {
						$filename = $timestamp;
						 $msg = 'Blog entry created';
					}
					file_put_contents('data/blogentries/'.$filename.'.txt',serialize($data));
					
					$status[] = $msg;
					
					//empty post array
					$_POST = array();
				}
				
				
			}
			
			return $status;
		
	}

 ?>