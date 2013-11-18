<?php 
	
	require( $this->settings->getRoot() . '/app/model/KantoneModel.php' );

	class KantoneController{
		
		private $request;
		private $viewFile;
		private $settings;
		
		private $sort_mapping = array(
			'name' => array ( 
								'attr' => 'Kanton',
								'flag' => SORT_STRING
					),
			'hauptort' => array ( 
								'attr' => 'Hauptort',
								'flag' => SORT_STRING
					),
			'einwohner' => array ( 
								'attr' => 'Einwohner 1',
								'flag' => SORT_NUMERIC
					),
			'beitritt' => array ( 
								'attr' => 'Beitritt',
								'flag' => SORT_NUMERIC
					)
		);
		
		private $getBy_mapping = array(
			'Id' => 'Kürzel'
		
		);
		
		
		public function __construct( $request ) {
		
			$this->settings = Settings::getInstance();
		
			$this->request = $request;
			
			
			$view = $this->request->getView();
			$this->viewFile = $this->settings->getRoot() . '/app/view/'.$view.'.php';
			
			if( ! is_file ( $this->viewFile ) ){
				die('<bold>view not found! '.$this->request->getView().'</bold>');
			}
			
			
			
			$actionName = $this->request->getAction().'Action';
			
			
			$start_string = 'showBy';
			$actionName_showBy_requested = ( substr($actionName,0,strlen( $start_string ) ) === $start_string );
			if( $actionName_showBy_requested ) {
				$actionName = $start_string;	
			}
			
			
			
			if( ! method_exists( $this, $actionName )){
				$actionName = 'showAllAction';
				//die('<span style="color: red">Action not found!!</span>');
			}
			
			$this->{$actionName}( );
			
		}
		
		public function showBy(){
			$actionName = $this->request->getAction();
			$start_string = 'showBy';
			$attr = ( substr($actionName,strlen( $start_string ) ) );
			if( isset( $this->getBy_mapping[ $attr ] ) ) $attr = $this->getBy_mapping[ $attr ];
			
			$result = KantoneModelFactory::getKantonBy( $attr , $this->request->getParam() );
			
			$this->renderView($result);
		}
		
		
		public function showAllAction(  ){
		
			$result = KantoneModelFactory::getAllKantone();
			
			$sort =  $this->request->getGetParam('sort');
			
			
			if( !empty ( $sort ) ) {
				$sort_flag = SORT_REGULAR;
				if( isset( $this->sort_mapping[$sort] ) ){
					 $sort_orig = $sort;
					 $sort = $this->sort_mapping[$sort_orig]['attr'];
					 $sort_flag = $this->sort_mapping[$sort_orig]['flag'];
				}
				$this->aasort($result,$sort,$sort_flag );
			}
			if( $this->request->getGetParam('sortType') === 'desc' ) {
				$result = array_reverse($result);
			}
			
			$this->renderView($result);
			
		}
		
		
		
		private function aasort (&$array, $key, $type = SORT_REGULAR) {
		    $sorter=array();
		    $ret=array();
		    reset($array);
		    foreach ($array as $ii => $va) {
		        $sorter[$ii]=$va[$key];
		    }
		    asort($sorter,$type);
		    foreach ($sorter as $ii => $va) {
		        $ret[$ii]=$array[$ii];
		    }
		    $array=$ret;
		}
		
		public function renderView( $data ){
			
			$format = $this->request->getGetParam('type');
			if( $format === 'json' ) {
				 header("Content-type: text/javascript; charset=utf-8");
				echo json_encode($data);
			} else if( $format === 'xml' ) {
				
				header("Content-type: text/xml; charset=utf-8");
				// initializing or creating array
				
				// creating object of SimpleXMLElement
				$xml_kantone = new SimpleXMLElement("<?xml version=\"1.0\"?><kantone></kantone>");
				
				// function call to convert array to xml
				$this->array_to_xml($data,$xml_kantone,'kanton_record');
				
				print $xml_kantone->asXml();
				//saving generated xml file
				//$xml_student_info->asXML('file path and name');
				
				
				
				
				/*echo '<?xml version="1.0"?>';
				$xml = new SimpleXMLElement('<kantone/>');
				array_walk_recursive($data, array ($xml, 'addChild'));
				print $xml->asXML();*/
			
			} else {
				header("Content-type: text/html; charset=utf-8");
				include( $this->viewFile );
			}
			//ob_start();
			
			//ob_flush();
		}
		
		
		private function array_to_xml($student_info, &$xml_student_info,$nodeName) {
		 
		 
		   /* is this a composite design pattern ? */
		   
		    foreach($student_info as $key => $value) {
		    	$key = str_replace(array(' '),array(''),$key);
		        if(is_array($value)) {
		            if(!is_numeric($key)){
		                $subnode = $xml_student_info->addChild("$key");
		                $this->array_to_xml($value, $subnode,$nodeName);
		            }
		            else{
		                $subnode = $xml_student_info->addChild($nodeName);
		                $this->array_to_xml($value, $subnode,$nodeName);
		            }
		        }
		        else {
		            $xml_student_info->addChild("$key","$value");
		        }
		    }
		}
	
	}

 ?>