<?php
require 'vendor/autoload.php';

$config = new Config();
$sqs = new Sqs($config);


$message = $sqs->getFIFOMessage();
$controller = new Controller($config);
$controller->think($message);
