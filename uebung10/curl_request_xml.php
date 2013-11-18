<?php
$url ="http://localhost/klickagent/prebeta/php_programmieren_zhaw/uebung10/Kantone/showAll/json&methode=single&id=zh";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$body = curl_exec($ch);
curl_close($ch);

// Via XML
$xml = new SimpleXMLElement($body);
?>