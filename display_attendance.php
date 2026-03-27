<?php
session_start();
$conn = mysqli_connect("localhost","root","root","student_db");
if(!$conn){ die("Connection failed: " . mysqli_connect_error()); }

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];

    $sql = "SELECT s.id as student_id, s.name as student_name, 
                   c.course_name, a.attendance_date, a.status
            FROM attendance a
            JOIN students s ON a.student_id = s.id
            JOIN courses c  ON a.course_id  = c.id
            WHERE a.student_id='$student_id'
            ORDER BY a.attendance_date ASC";

    $records = mysqli_query($conn, $sql);
} else {
    die("No student selected.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Records</title>
    <style>
        body { font-family: Arial; background:#e8f5e9; padding:50px; display:flex; justify-content:center;}
        table { border-collapse: collapse; width: 80%; text-align:center; background:#c8e6c9;}
        th, td { border: 1px solid #81c784; padding:10px;}
        th { background:#2e7d32; color:white; }
        tr:nth-child(even) { background:#a5d6a7; }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Course</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php if(mysqli_num_rows($records) > 0){
        while($r = mysqli_fetch_assoc($records)){ ?>
        <tr>
            <td><?php echo $r['student_id']; ?></td>
            <td><?php echo $r['student_name']; ?></td>
            <td><?php echo $r['course_name']; ?></td>
            <td><?php echo $r['attendance_date']; ?></td>
            <td><?php echo $r['status']; ?></td>
        </tr>
    <?php } } else { ?>
        <tr><td colspan="5">No records found for this student.</td></tr>
    <?php } ?>
</table>
</body>
</html>