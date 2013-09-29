<?php 


function mail_attachment($to, $subject, $message, $from, $file) {
  // $file should include path and filename
 
if( is_file($file) ){
	$filename = basename($file);
  	$file_size = filesize($file);
  	$content = chunk_split(base64_encode(file_get_contents($file))); 
} else {
	$filename = false;	
}
  $uid = md5(uniqid(time()));
  $from = str_replace(array("\r", "\n"), '', $from); // to prevent email injection

  
  $header = "From: ".$from."\r\n"
      ."MIME-Version: 1.0\r\n"
      ."Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n"
      ."This is a multi-part message in MIME format.\r\n" 
      ."--".$uid."\r\n"
      ."Content-type:text/plain; charset=iso-8859-1\r\n"
      ."Content-Transfer-Encoding: 7bit\r\n\r\n"
      .$message."\r\n\r\n"
      ."--".$uid."\r\n";
  if( $filename !== false )
  	$header.="Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"
      ."Content-Transfer-Encoding: base64\r\n"
      ."Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n"
      .$content."\r\n\r\n"
      ."--".$uid."--"; 
  return mail($to, $subject, "", $header);
 }
 
?>