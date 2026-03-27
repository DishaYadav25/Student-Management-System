<?php
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$result = mysqli_query($conn, "SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Courses</title>
<style>
body { font-family: Arial; background: #f0f8ff; padding: 50px; }
h2 { color: navy; text-align: center; }
table { width: 60%; margin: auto; border-collapse: collapse; background-color: #ffffffcc; box-shadow: 0 5px 10px rgba(0,0,0,0.2);}
th, td { padding: 12px; text-align: center; border-bottom: 1px solid #ddd; }
th { background-color: navy; color: white; }
tr:hover { background-color: #f1f1f1; }
a.button { background-color: navy; color: white; padding: 5px 12px; text-decoration: none; border-radius: 5px; font-weight: bold; }
a.button:hover { background-color: #000080cc; }
</style>
</head>
<body>
<h2>All Courses</h2>
<table>
<tr>
<th>ID</th>
<th>Course Name</th>
<th>Course Fee</th>
<th>Actions</th>
</tr>
<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['course_name']."</td>";
        echo "<td>".$row['course_fee']."</td>";
        echo "<td>
                <a class='button' href='edit_course.php?id=".$row['id']."'>Edit</a> 
                <a class='button' href='delete_course.php?id=".$row['id']."'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No courses found</td></tr>";
}
mysqli_close($conn);
?>
</table>
</body>
</html>