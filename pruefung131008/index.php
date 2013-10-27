<?php
	include('lib/autoload.php');
	
	init();
	
	$status = array();
	
	
	
?>
	
	
<?php 

echo create_head('My Blog'); ?> 
	
	<h1>My Blog</h1>
	
	<?php echo create_nav('index'); ?>
	
	
	<br/>
	
		<?php
			$entries = array();
		
			$folder = 'data/blogentries';
			$dir = new RecursiveDirectoryIterator($folder); 
  
  
  			// Iterate through files/folders in the cakephp root folder
  			foreach (new RecursiveIteratorIterator($dir) as $file) {
  				$info = pathinfo($file);
  	
  				$filename = $file -> getFilename();
  				if ($file -> IsFile() && substr($filename, 0, 1) != "." ) { 
  					
  					$entries[] = $file;
  				}
  			}
  			
  			rsort($entries);
  			
  			foreach( $entries as $file){
  				$data = unserialize(file_get_contents($file));
  				echo '<article>
  				
  					<h3>"'.$data['title'].'" Author: '.$data['name'].'</h3>';
  					
  				if(!empty($data['submitdate'])) echo ' submit-date: '.$data['submitdate'].' time: '.$data['submittime'];
  				
  				
  				if(!empty($data['username'])) echo ' user: '.$data['username'].'';
  				
  				if(!empty($data['date'])) echo ' blog date: '. $data['date']. '';
  				if(!empty($data['text'])) echo '<p>'. $data['text']. '</p>';
  				
  				if(!empty($data['filepath'])) echo ' <h4>File:</h4><a href="'.$data['filepath'].'" target="_blank">'.basename($data['filepath']).'</a>';
  				
  				if( check_login() ){
  					 echo '<a href="edit.php?id='.basename($file,'.txt').'">edit</a>&nbsp;';
  					echo '<a href="remove.php?id='.basename($file,'.txt').'">remove</a>';
  				}
  				echo '</article>
  				<hr/>
  				';
  			}
  			
		?>
	
 <?php echo create_html_end(); ?>	
