<?php
// Database connection
$db = new SQLite3('database.db');

// Check if the table exists, if not, create it
$query = 'CREATE TABLE IF NOT EXISTS records (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            last_name TEXT,
            first_name TEXT,
            middle_name TEXT,
            gender TEXT,
            bdate TEXT
        )';
$db->exec($query);

// CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch records
    // Get the search keyword
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $query = '';

    if(empty($keyword)){
        $query = "SELECT * FROM records";
    }else{
        // Fetch records with search if keyword is not empty
        $query = "SELECT * FROM records 
              WHERE last_name LIKE '%$keyword%' OR 
                    first_name LIKE '%$keyword%' OR 
                    middle_name LIKE '%$keyword%' OR 
                    gender LIKE '%$keyword%' OR 
                    bdate LIKE '%$keyword%'";
    }
    
    
    $result = $db->query($query);

    $counter = 1; //counter
    while ($row = $result->fetchArray()) {
        // Format the birthdate in PHP
        $formattedDate = date('F j, Y', strtotime($row['bdate']));
        echo '<tr>
                <td>' . $counter++ . '</td>
                <td>' . $row['last_name'] . '</td>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['middle_name'] . '</td>
                <td>' . $row['gender'] . '</td>
                <td>' . $formattedDate . '</td>
                <td>
                    <button class="btn btn-warning btn-sm float-right ml-2" data-record-id="' . $row['id'] . '">Edit</button>
                    <button class="btn btn-danger btn-sm float-right" data-record-id="' . $row['id'] . '">Delete</button>
                </td>
              </tr>';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add record
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $bdate = $_POST['bdate'];

    $query = "INSERT INTO records (last_name, first_name, middle_name, gender, bdate) 
              VALUES ('$last_name', '$first_name', '$middle_name', '$gender', '$bdate')";
    $db->exec($query);
}
?>
