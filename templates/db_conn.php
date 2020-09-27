<?php
require 'vendor/autoload.php';
$conn = new MongoDB\Driver\Manager("mongodb://3.7.242.18:27017");
$db = 'myrufarm_db';
//$db = (new MongoDB\Client)->myrufarm_db;
?>