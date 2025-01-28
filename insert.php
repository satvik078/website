<?php
// Database configuration
$host = 'lsql110.infinityfree.com'; 
$username = 'if0_37135185';
$password = 'x06Mbj2o4ozw'; 
$dbname = 'if0_37135185_signup'; 

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $conn->real_escape_string($_POST['Email']);
    $password = $conn->real_escape_string($_POST['password']);
    $course = $conn->real_escape_string($_POST['course']);

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    
    $sql = "INSERT INTO users (email, password, course) VALUES ('$email', '$hashedPassword', '$course')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Your details have been saved successfully!');
            window.location.href = 'login.html';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
