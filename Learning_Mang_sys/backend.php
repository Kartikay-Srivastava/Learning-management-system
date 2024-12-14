<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration and login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($action === 'register') {
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        if ($conn->query($sql) === TRUE) {
            header('Location: enrollment.html'); // Redirect to enrollment page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action === 'login') {
        $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header('Location: enrollment.html'); // Redirect to enrollment page
            exit();
        } else {
            echo "Invalid username or password!";
        }
    }
}

$conn->close();
?>
