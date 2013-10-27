<?php 

	class PostTable {
	
		private $posts = [];
		private $post_attrs = [];
		private $model = 'tbl_person';
		
		public function __construct(){
			
		}
		
		public function createPost($attrs=true){
			$newPost = new Post($attrs);
			return $newPost;
		}
		
		public function updatePost($id,$attr){
			$editPost = new Post();
			$editPost->findByID($id);
			$editPost->update($attr);
			return $editPost;
		}
		
		public function deletePost($id){
			$deletePost = new Post();
			$deletePost->findByID($id);
			$deletePost->delete();
		}
		
		public function findPostBy($attr,$val){
			global $db;
			if( $attr === 'id' ) {
				$post = new Post();
				$post->findByID($val);
				return array($post);
			} else {
				$attr_sql = SQLite3::escapeString($attr);
				$executeVals = array(  'val' =>  $val ) ;
				$t = 'SELECT id FROM '.$this->model.' WHERE '.$attr_sql.'= :val';
				$stmt = $db->prepare($t);
				$stmt->execute( $executeVals );
				//echo $stmt->debugDumpParams();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(DEBUG_DB_QUERIES){
					echo $t.'<br/>';
					print_r($executeVals);
					echo '<br/>';
				}
				$posts = [];
				foreach( $data as $obj ){
					$post = new Post();
					$post->findByID( $obj['id'] );
					$posts[] = $post;
				}
				return $posts;
			}
			
				
		}
		
		
		
	}


 ?>