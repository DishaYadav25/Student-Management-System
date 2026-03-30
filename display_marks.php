<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$result = mysqli_query($conn, "SELECT m.id, s.name AS student_name, c.course_name, m.marks_obtained, m.max_marks
                               FROM marks m
                               JOIN students s ON m.student_id = s.id
                               JOIN courses c ON m.course_id = c.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marks Records</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff3e0; padding: 50px; }
        h2 { color: #ff6f00; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; background-color: #ffffffcc; box-shadow: 0 5px 10px rgba(0,0,0,0.2); }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
        th { background-color: #ff6f00; color: white; }
        tr:hover { background-color: #ffe0b2; }
        a.button { background-color: #ff6f00; color: white; padding: 5px 12px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        a.button:hover { background-color: #e65100; }
    </style>
</head>
<body>

<h2>Marks Records</h2>
<table>
<tr>
<th>ID</th>
<th>Student</th>
<th>Course</th>
<th>Marks Obtained</th>
<th>Max Marks</th>
<th>Actions</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['student_name']."</td>";
        echo "<td>".$row['course_name']."</td>";
        echo "<td>".$row['marks_obtained']."</td>";
        echo "<td>".$row['max_marks']."</td>";
        echo "<td>
                <a class='button' href='edit_marks.php?id=".$row['id']."'>Edit</a>
                <a class='button' href='delete_marks.php?id=".$row['id']."'>Delete</a>
              </td>";
        echo "</tr>";
    }
}else{
    echo "<tr><td colspan='6'>No marks records found</td></tr>";
}
mysqli_close($conn);
?>
</table>
</body>
</html>
