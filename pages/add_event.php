<?php

require_once '../backend/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        $eventsCollections = $client->$dbname->events;

        $insert = $eventsCollections->insertOne([
            'name'=>$_POST['event_name'],
            'date'=>$_POST['event_date'],
            'description'=>$_POST['event_description']
        ]);
        header("Location: local_events.php");
    } catch(Exception $e){
        echo "error: " . $e->getMessage();
    }
}
?>