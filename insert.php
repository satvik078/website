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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $course = $conn->real_escape_string($_POST['course']);
    $face_image = $_POST['face_image'];

    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result && $check_result->num_rows > 0) {
        echo "<script>
            alert('Username already exists! Please choose a different username.');
            window.history.back();
        </script>";
        exit();
    }

    // Check if email already exists
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_sql);
    
    if ($check_email_result && $check_email_result->num_rows > 0) {
        echo "<script>
            alert('Email already exists! Please use a different email.');
            window.history.back();
        </script>";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user data into database
    $sql = "INSERT INTO users (email, username, password, course) VALUES ('$email', '$username', '$hashedPassword', '$course')";

    if ($conn->query($sql) === TRUE) {
        // Save face image
        if ($face_image) {
            // Remove the data:image/jpeg;base64, part
            $image_data = str_replace('data:image/jpeg;base64,', '', $face_image);
            $image_data = str_replace(' ', '+', $image_data);
            $image_data = base64_decode($image_data);
            
            // Create images directory if it doesn't exist
            $images_dir = 'face recognition/images/';
            if (!file_exists($images_dir)) {
                mkdir($images_dir, 0777, true);
            }
            
            // Save image with username as filename
            $image_path = $images_dir . $username . '.jpg';
            if (file_put_contents($image_path, $image_data)) {
                echo "<script>
                    alert('Your details have been saved successfully! Face image captured.');
                    window.location.href = 'login.html';
                </script>";
            } else {
                echo "<script>
                    alert('User saved but face image could not be saved. Please contact support.');
                    window.location.href = 'login.html';
                </script>";
            }
        } else {
            echo "<script>
                alert('User saved but no face image was captured.');
                window.location.href = 'login.html';
            </script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
