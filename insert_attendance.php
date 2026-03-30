<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "root", "student_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$student_id = $_POST['student_id'];
$course_id = $_POST['course_id'];
$attendance_date = $_POST['attendance_date'];
$status = $_POST['status'];

$sql_check = "SELECT * FROM attendance 
              WHERE student_id='$student_id' 
              AND course_id='$course_id' 
              AND attendance_date='$attendance_date'";
$result = mysqli_query($conn, $sql_check);

if(mysqli_num_rows($result) == 0){
    // Insert only if no record exists
    $sql_attendance = "INSERT INTO attendance (student_id, course_id, attendance_date, status)
                       VALUES ('$student_id','$course_id','$attendance_date','$status')";
    mysqli_query($conn, $sql_attendance);
} else {
    $error = "Attendance already recorded for this student and date!";
}

mysqli_close($conn);
?>
