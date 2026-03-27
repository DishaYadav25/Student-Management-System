<?php
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$student_id     = $_POST['student_id'];
$course_id      = $_POST['course_id'];
$marks_obtained = $_POST['marks_obtained'];
$max_marks      = $_POST['max_marks'];

$sql = "INSERT INTO marks (student_id, course_id, marks_obtained, max_marks)
        VALUES ('$student_id', '$course_id', '$marks_obtained', '$max_marks')";

if (mysqli_query($conn, $sql)) {
    echo "Marks added successfully! <a href='display_marks.php'>View All Marks</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>