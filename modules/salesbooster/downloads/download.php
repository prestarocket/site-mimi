<?php
$file = $_GET['file'].'.txt';
$handle = fopen($file,"r");
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$file);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: '.filesize($file));
ob_clean();
flush();
readfile($file);
fclose($handle);
exit;

?>