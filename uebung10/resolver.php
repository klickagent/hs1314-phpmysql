<?php 
	$type = (isset( $_GET['type'])) ? $_GET['type'] : 'html';
	
	if( $type === 'json' ){
		header("Content-type: text/javascript; charset=utf-8");
	} else if ( $type === 'xml') {
		
			header("Content-type: text/xml; charset=utf-8");
	} else {
		header("Content-type: text/html; charset=utf-8");
	}
	
	$gets = http_build_query($_GET);
	
	$showBy = ( isset( $_GET['id'] ) ) ? 'showById'.'/'.$_GET['id'] : '';
	
	$url = 'http://'.$_SERVER['SERVER_NAME'].dirname( $_SERVER['REQUEST_URI'] ) .'/'.ucfirst($_GET['service']).'/list/'.$showBy.'?'.$gets;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$body = curl_exec($ch);


 ?>