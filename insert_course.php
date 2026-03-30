<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$course_name = $_POST['course_name'];
$course_fee = $_POST['course_fee'];

$sql = "INSERT INTO courses (course_name, course_fee) VALUES ('$course_name', '$course_fee')";

if (mysqli_query($conn, $sql)) {
    echo "Course added successfully! <a href='display_course.php'>View Courses</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
