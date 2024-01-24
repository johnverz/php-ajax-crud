<?php
// Database connection
$db = new SQLite3('database.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Perform the delete operation
    $query = "DELETE FROM records WHERE id = $id";
    $db->exec($query);
}
?>