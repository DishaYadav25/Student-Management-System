<?php
session_start();

// Login check
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

// DB connection
$conn = mysqli_connect("localhost","root","root","student_db");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// Form submit check (BEST METHOD)
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students (name, class, email, phone)
            VALUES ('$name','$class','$email','$phone')";

    if(mysqli_query($conn, $sql)){
        // Success → wapas add page
        header("Location: add_student.php?msg=success");
        exit();
    } else {
        // Error → show error
        echo "Error: " . mysqli_error($conn);
    }
}
else{
    // Direct access block
    header("Location: add_student.php");
    exit();
}
?>