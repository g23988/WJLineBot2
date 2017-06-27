<?php
require '../vendor/autoload.php';

$config = new Config();

//$json = file_get_contents('php://input');
//store message
//$file = fopen("/tmp/string.txt","a+");
//fwrite($file,$json."\n");
//fclose($file);

$download = new Download($config);
//$download->figureOutType($json);
$download->downloadVideo();

