<?php
	define('DEBUG',true);
	date_default_timezone_set('Europe/Zurich');

	if(DEBUG){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}
	
	$status = array();
	//data submitted:
	if( isset( $_POST['submit'] ) && $_POST['submit']  === '1' ){
		
		if( $_POST['username'] !== 'test' && $_POST['password'] !== 'pw' ){ 
			$status[] = 'Login failed';
		} else {
			if( ! DEBUG ) {
				require_once('lib/recaptchalib.php');
				$privatekey = "6LeS7ecSAAAAACL0XbZPH9sz5c4vipCXoShzvJyX";
				$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);
			}
			if (!DEBUG && !$resp->is_valid) {
				// What happens when the CAPTCHA was entered incorrectly
				$status[] = "The reCAPTCHA wasn't entered correctly. Go back and try it again." .
					 "(reCAPTCHA said: " . $resp->error . ")";
			} else {
				
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
				  /*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				  echo "Type: " . $_FILES["file"]["type"] . "<br>";
				  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				  echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
					
				}
				
				if(empty($_POST['name']) ){
					$status[] = 'name empty';
				}
				
				//validate email:
				if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
					$status[] = 'mail not valid';
				}
				
				if(empty($_POST['web']) ){
					$status[] = 'web empty';
				} else if ( filter_var($_POST['web'], FILTER_VALIDATE_URL) === false ){
					$status[] = 'url invalid';
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
					$data['submittime'] = @time('H:i:s');
					$data['submitdate'] = @date('Y.m.d');
					$data['filepath'] = $filepath;
					$data['email'] = $_POST['email'];
					$data['username'] = $_POST['username'];
					file_put_contents('bugreports/'.$data['submitdate'].' '.$data['submittime'].'.txt',serialize($data));
					
					
					
					include ( 'lib/sendmail.php' );
					
					if(!mail_attachment($data['email'],'Bugreport '.$data['submitdate'].' '.$data['submittime'],$data['text'],'lickerom@students.zhaw.ch',$data['filepath']) )
						$status[] = 'confirmation mail could not be sent';
					
					require "lib/dropbox-php-sdk-1.1.1/Dropbox/autoload.php";
					
					$accessToken = '1OOHAlFwjSMAAAAAAAAAAX_4bq57F9B3WgGr2aLSxNxZzJyoySw30ebDGjCJ7Mgc';
					$dbxClient = new Dropbox\Client($accessToken, "PHP-Example/1.0");
					
					if( is_file( $data['filepath'] ) ) {
						$f = fopen( $data['filepath'], "rb");
						$result = $dbxClient->uploadFile( '/lickerom/bugreports/'.$data['submitdate'].'/'.$data['submittime'].'_'. basename($data['filepath']), Dropbox\WriteMode::add(), $f);
						fclose($f);
					}
					
					$status[] = 'Bug submitted successfully';
					$_POST = array();
				}
			}
		}
		
		
		
	}


?><!DOCTYPE html>
<html>
<head>
	<title>Submit us your Bug!</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="javascripts.js"></script>
</head>
<body>
	<?php if( $status ) { ?>
	<div id="state">
		<?php foreach ( $status as $s ) {
			echo $s.'<br/>';
		}; ?>
	</div>
	<?php } ?>
	
	<?php 
				/*
				require "lib/dropbox-php-sdk-1.1.1/Dropbox/autoload.php";
				use \Dropbox as dbx;
				
				$appInfo = dbx\AppInfo::loadFromJsonFile("config/dropbox.json");
				$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
				
				$authorizeUrl = $webAuth->start();
				
				echo '1. Go to: <a href="' . $authorizeUrl . '">authorize</a>\n';
				echo '2. Click \"Allow\" (you might have to log in first).\n';
				echo '3. Copy the authorization code.\n';
			
				
				//$authCode = trim("pfM6IJpuoGEAAAAAAAAAAUufZK8wg3raAi61rZnB6O0");


				list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
				print "Access Token: " . $accessToken . "\n";
				*/
				
?>
	
	<h2>Bitte melde deinen Bug mit diesem Formular</h2>
	
	<a href="list.php">Show list of current reported bugs</a>
	
	<form class="form" action="index.php" method="post" enctype="multipart/form-data" onsubmit="return validateValues();">
		<input type="hidden" name="submit" value="1"/>
		<h3>Login</h3>
		
		<input type="text" name="username" placeholder="Username" value="<?php echo @$_POST['username']; ?>" required="required"/>
		<input type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>" required="required"/>
		
		<br/>
		
		
		<h3>Bugreport</h3>
		
		<p class="name">
			<input type="text" name="name" id="name" placeholder="John Doe" value="<?php echo @$_POST['name']; ?>" required="required"/>
			<label for="name">Name</label>
		</p>
		
		<p class="email">
			<input type="email" autocomplete="off" name="email" id="email" placeholder="mail@example.com" value="<?php echo @$_POST['email']; ?>" required="required" />
			<label for="email">Email</label>
		</p>
		
		<p class="web">
			<input type="url" pattern="https?://.+" name="web" id="web" placeholder="www.example.com" required="required" value="<?php echo @$_POST['web']; ?>"/>
			<label for="web">Betreffende Website</label>
		</p>		
	
		<p class="text">
			<textarea name="text" placeholder="Fehlerreport" required="required"/><?php echo @$_POST['text']; ?></textarea>
		</p>
		
		<p>
			<label for="priority">
				Priority
			</label>
			<input type="range" name="priority" min="1" max="10" required="required" value="<?php echo @$_POST['priority']; ?>"/>
		</p>
		
		<p>
			<label for="bugtype">
				Bugtype
			</label>
			<select name="bugtype" placeholder="Bugtype" required="required">
				<option value="serious_error" <?php echo (@$_POST['bugtype'] === 'serious_error') ? 'selected="selected"' : ''; ?>">serious error</option>
				<option value="regular_error" <?php echo (@$_POST['bugtype'] === 'regular_error') ? 'selected="selected"' : ''; ?>>non serious error</option>
			</select>
		</p>
	
		
		<p>
			<label for="callback">
				Call me back
			</label>
			<input type="checkbox" name="callback" value="1" <?php echo (@$_POST['callback'] === '1') ? 'checked="checked"' : ''; ?>/>
		</p>
		
		<p>
			<label for="reproducable">
				Reproduceable
			</label>
			Yes
			<input type="radio" name="reproducable" value="yes" checked="checked" required="required" <?php echo (@$_POST['reproducable'] === 'yes') ? 'checked="checked"' : ''; ?>/>
			No
			<input type="radio" name="reproducable" value="no" required="required" <?php echo (@$_POST['reproducable'] === 'no') ? 'checked="checked"' : ''; ?>/>
		</p>
		
		
		<p>
			<label for="date">
				Date
			</label>
			<input type="date" name="date" required="required" value="<?php echo @$_POST['date']; ?>"/>
		</p>
		
		
		<p>
			<label for="file">Add File:</label>
			<input type="file" name="file" id="file"><br>
		</p>
			
			
		<?php
		if(! DEBUG ) {
          require_once('lib/recaptchalib.php');
          $publickey = "6LeS7ecSAAAAANBPQAXKplnW4dnn3VEv1VL2b-1J"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        }
        ?>	
			
		<p class="submit">
			<input type="submit" value="Senden" />
		</p>
		
	</form>

</body>
</html>