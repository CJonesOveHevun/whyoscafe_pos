<?php
require_once '../backend/db_connect.php';
use MongoDB\BSON\ObjectId;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        $collections = $client->$dbname->inventory;
        $update = $collections->updateOne(
            ['_id'=> new ObjectId($_POST['id'])],
            ['$set' =>[
                'name'=>$_POST['name'],
                'category'=>$_POST['category'],
                'stock'=>$_POST['stock'],
                'expiry_date'=>$_POST['expiry_date']
            ]]
        );
        header('Location: inventory.php');
        exit;
    } catch(Exception $e){
        echo "error: ". $e->getMessage();
    }

    
}

?>