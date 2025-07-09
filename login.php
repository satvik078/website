<?php
session_start();

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
    
    // Check if this is a face login request
    if (isset($_POST['face_login']) && $_POST['face_login'] == '1') {
        $username = $conn->real_escape_string($_POST['username']);
        
        // Fetching user data based on the username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $course = $row['course'];
            
            // Set session for face login user
            $_SESSION['user'] = $username;
            $_SESSION['email'] = $row['email'];
            $_SESSION['course'] = $course;
            
            // Redirect based on course
            if ($course == "cse") {
                echo "<script>
                    alert('Face login successful! Redirecting to CSE dashboard.');
                    window.location.href = 'cse.html';
                </script>";
            } elseif ($course == "ece") {
                echo "<script>
                    alert('Face login successful! Redirecting to ECE dashboard.');
                    window.location.href = 'ece.html';
                </script>";
            } else {
                echo "<script>
                    alert('Face login successful! No Course selected! Redirecting to sign up');
                    window.location.href = 'signup.html';
                </script>";
            }
        } else {
            echo "<script>
                alert('Username not found. Please check your username or sign up.');
                window.location.href = 'login.html'; 
            </script>";
        }
    } else {
        // Regular password login
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        // Fetching user data based on the username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $course = $row['course']; 
                // Set session for password login user
                $_SESSION['user'] = $username;
                $_SESSION['email'] = $row['email'];
                $_SESSION['course'] = $course;
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
                alert('No account found with this username. Please sign up.');
                window.location.href = 'signup.html'; 
            </script>";
        }
    }
}

$conn->close();
?>
