<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mongoUri = $_ENV['MONGO_URI'];
$dbname = $_ENV['DB_NAME'];

$client = new MongoDB\Client($mongoUri);
$collections = $client->$dbname->inventory;
?>