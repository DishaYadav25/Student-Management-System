<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","root","student_db");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Delete related data first
    mysqli_query($conn, "DELETE FROM fee WHERE student_id='$id'");
    mysqli_query($conn, "DELETE FROM attendance WHERE student_id='$id'");
    mysqli_query($conn, "DELETE FROM marks WHERE student_id='$id'");

    // Then delete student
    mysqli_query($conn, "DELETE FROM students WHERE id='$id'");

    header("Location: display_student.php?msg=deleted");
    exit();
}
?>