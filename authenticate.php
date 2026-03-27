<?php
session_start();

$conn = mysqli_connect("localhost","root","root","student_db");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $_SESSION['username'] = $username;
    header("Location: home.php");
} else {
    echo "<script>alert('Wrong Username or Password'); window.location='login.php';</script>";
}
?>