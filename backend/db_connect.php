<?php
require_once __DIR__ . '/../vendor/autoload.php';
//$mongoUri = $_ENV['MONGO_URI'];
//$dbname = $_ENV['DB_NAME'];
$mongoUri = getenv('MONGO_URI');
$dbname = getenv('DB_NAME');


$client = new MongoDB\Client($mongoUri);
$collections = $client->$dbname->inventory;
?>
