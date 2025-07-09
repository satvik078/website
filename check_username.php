<?php
header('Content-Type: application/json');

// Database configuration
$host = 'lsql110.infinityfree.com'; 
$username = 'if0_37135185';
$password = 'x06Mbj2o4ozw'; 
$dbname = 'if0_37135185_signup'; 

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    echo json_encode(['exists' => false, 'error' => 'DB connection failed']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo json_encode(['exists' => false, 'error' => 'Invalid request']);
}

$conn->close();
?>