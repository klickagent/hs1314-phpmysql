<?php 

class _frontController{
	
	private $settings;
	
	public function __construct( $request ){
		$this->settings = Settings::getInstance();
		
		/*echo $request->getController();
		echo $request->getView();
		echo $request->getAction();
		*/
		
		$controllerFile = $this->settings->getRoot() . '/app/controller/'.$request->getController().'Controller.php';
		
		if( !is_file( $controllerFile ) ){
			die('Controller not found');
		}
		include( $controllerFile );
		
		
		$controllerName = $request->getController().'Controller';
		$controller = new $controllerName( $request );
		
		
		
	}
	
}

 ?>