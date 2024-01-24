<?php
// Database connection
$db = new SQLite3('database.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['edit_record_id'];
    $last_name = $_POST['edit_last_name'];
    $first_name = $_POST['edit_first_name'];
    $middle_name = $_POST['edit_middle_name'];
    $gender = $_POST['edit_gender'];
    $bdate = $_POST['edit_bdate'];

    // Perform the edit operation
    $query = "UPDATE records 
              SET last_name = '$last_name', 
                  first_name = '$first_name', 
                  middle_name = '$middle_name', 
                  gender = '$gender', 
                  bdate = '$bdate' 
              WHERE id = $id";
    $db->exec($query);
}
?>
