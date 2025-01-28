<?php
// Database connection configuration
$host = "lsql110.infinityfree.com";
$username = "if0_37135185"; 
$password = "x06Mbj2o4ozw";
$dbname = "if0_37135185_signup"; 

//  database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['Email']);
    $password = $_POST['password'];

    // Fetching user data based on the email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();

       
        if (password_verify($password, $row['password'])) {
            $course = $row['course']; 
            if ($course == "cse") {
                echo "<script>
                    alert('Login successful! Redirecting to CSE dashboard.');
                    window.location.href = 'cse.html';
                </script>";
            } elseif ($course == "ece") {
                echo "<script>
                    alert('Login successful! Redirecting to ECE dashboard.');
                    window.location.href = 'ece.html';
                </script>";
            } else {
                echo "<script>
                    alert('Login successful! No Course selected! Redirecting to sign up');
                    window.location.href = 'signup.html';
                </script>";
            }
        } else {
            echo "<script>
                alert('Incorrect password. Please try again.');
                window.location.href = 'login.html'; 
            </script>";
        }
    } else {
       
        echo "<script>
            alert('No account found with this email. Please sign up.');
            window.location.href = 'signup.html'; 
        </script>";
        }
    } else {
        
        echo "<script>
            alert('No account found with this email. Please sign up.');
            window.location.href = 'signup.html'; 
        </script>";
    }


$conn->close();
?>
