<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "root";
$database = "student_db";
$port = 3307;

// Correct connection
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get login form data
$username = $_POST['username'];
$password_input = $_POST['password'];

// Check login credentials
$sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password_input')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    header("Location: dashboard.php");
    exit();
} else {
    echo "<script>alert('Invalid username or password'); window.location.href='login.php';</script>";
}

mysqli_close($conn);
?>
