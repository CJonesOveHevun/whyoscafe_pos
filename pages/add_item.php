<?php
require_once '../backend/db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $collections = $client->$dbname->inventory;
        $insertResult = $collections->insertOne([
        'name'=>$_POST['name'],
        'category'=>$_POST['category'],
        'stock'=>(int)$_POST['stock'],
        'unit'=>$_POST['unit'],
        'expiry_date'=>strtotime($_POST['expiry_date'])
        ]);

        header("Location: inventory.php");
        exit();
    } catch(Exception $e){
        echo "error:" . $e->getMessage();
    }
    

    
    
}
?>