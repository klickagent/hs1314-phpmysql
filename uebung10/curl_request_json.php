<?php
$url ="http://localhost/klickagent/prebeta/php_programmieren_zhaw/uebung10/Kantone/showAll&methode=single&id=zh";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$body = curl_exec($ch);
curl_close($ch);
// Via json
$json = json_decode($body);

print_r($json);
// Via XML
//$xml = new SimpleXMLElement($body);
?>