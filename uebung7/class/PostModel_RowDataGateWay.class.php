<?php 

	class Post {
	
		private $attrs = [];
		private $attrValues = [];
		
		private $id = false;
		
		private $model = 'tbl_person';
		
		
		public function __construct($attrs=false,$model=false,$fields=false){
			global $db;
			if( $model ) $this->model = $model;
			
			/* why is this not working?!?! */
			//$stmt = $db->prepare('DESCRIBE :table');
			//$stmt->execute(array( 'table' => $this->model ) );
			//$this->attrs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//alternativ: PDO::FETCH_COLUMN
			
			if($fields === false ){
				$this->attrs = array('created','title','content');
			} else {
				$this->attrs = $fields;
			}
			//init values:
			foreach( $this->attrs as $key ) {
				$this->attrValues[$key] = '';
			}
			if( $attrs !== false ) {
				if( $attrs === true ) $attrs = array();
				self::create($attrs);
			}
		}
		
		
		
		public function create($attrs){
			self::update($attrs,false);
		}
		
		public function update($attrs,$id=true){
			if( $id === true ) $id = $this->id;
			foreach( $attrs as $key => $attr ){
				$this->attrValues[$key] = $attr;
			}
			self::save($this->id);
		}
		
		private function save($id=false){
			global $db;
			$executeVals = $this->attrValues;
			
			if( $id === false ) {
				
				$keys = $this->attrs;
				$keys_t = implode(',',$keys);
				$vals = array_values($this->attrs);
				$vals_t = implode(',:',$vals);
		
				$t = 'INSERT INTO '.$this->model.' ('.$keys_t.')
				VALUES (:'.$vals_t.');';
				$stmt = $db->prepare($t);
			
				if(DEBUG_DB_QUERIES)echo $t.'<br/>';
				
			} else {
				$s = [];
				foreach ( $this->attrs as $key ) {
					$s[] = $key . ' = :'.$key;
				}
				$t = 'UPDATE '.$this->model.' SET '.implode(',',$s).' WHERE id=:id;';
				$stmt = $db->prepare($t);
				$executeVals['id'] = $this->id;
				
				
				if(DEBUG_DB_QUERIES)echo $t.'<br/>';
				
			}
			$stmt->execute( $executeVals );
			
			
			//print_r( $stmt->errorInfo() );
			if(DEBUG_DB_QUERIES){
				print_r($executeVals);
				echo '<br/>';
			}
			if( $id === false ){
				$this->id = $db->lastInsertId('id');
				if(DEBUG_DB_QUERIES) echo 'id: '. $this->id.'<br/>';
			}
		}
		
		
		public function delete(){
			global $db;
			$t = 'DELETE FROM '.$this->model.' WHERE id= :id';
			$stmt = $db->prepare($t);
			$executeVals = array( 'id' =>  $this->id );
			$stmt->execute( $executeVals );
			
			
			if(DEBUG_DB_QUERIES){
				echo $t.'<br/>';
				print_r($executeVals);
				echo '<br/>';
			}
			
			
			foreach( $this->attrs as $key => $attr ){
				unset($this->attrValues[$key]);
			}
			//how can i destory an object?!
		}
		
		
		
		public function findByID( $id ){
			global $db;
			$executeVals = array( 'id' =>  $id ) ;
			$t = 'SELECT * FROM '.$this->model.' WHERE id= :id';
			$stmt = $db->prepare($t);
			$stmt->execute( $executeVals );
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(DEBUG_DB_QUERIES){
				echo $t.'<br/>';
				print_r($executeVals);
				echo '<br/>';
			}
			
			//save attrs in class:
			foreach( $this->attrs as $attr ){
				$this->attrValues[$attr] = $data[0][$attr];
			}
			//save id:
			$this->id = $data[0]['id'];
			//var_dump($data);
		}
		
		
		public function getID(){
			return $this->id;
		}
		
		public function getCreated(){
			return self::getAttr('created');
		}
		
		public function getTitle(){
			return self::getAttr('title');
		}
		
		public function getContent(){
			return self::getAttr('content');
		}
		
		private function getAttr($attr){
			global $db;
			$attr_sql = SQLite3::escapeString($attr);
			$executeVals = array(  'id' =>  $this->id ) ;
			$t = 'SELECT '.$attr_sql.' FROM '.$this->model.' WHERE id= :id';
			$stmt = $db->prepare($t);
			$stmt->execute( $executeVals );
			//echo $stmt->debugDumpParams();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(DEBUG_DB_QUERIES){
				echo $t.'<br/>';
				print_r($executeVals);
				echo '<br/>';
			}
			
			
			return $data[0][$attr];
		}
		
	}


 ?>