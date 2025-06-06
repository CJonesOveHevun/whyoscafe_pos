<?php
require_once "../backend/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $deleteItem = $collections->deleteOne(['_id'=> new MongoDB\BSON\ObjectId($id)]);
        header("Location: inventory.php?msg=deleted");
        exit();
    } catch (Exception $e) {
        echo "Error deleting item: " . $e->getMessage();
    }
} else {
    header("Location: inventory.php");
    exit();
}
?>