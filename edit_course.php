<?php
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM courses WHERE id = $id");
$course = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $course_name = $_POST['course_name'];
    $course_fee = $_POST['course_fee'];

    $sql = "UPDATE courses SET course_name='$course_name', course_fee='$course_fee' WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        header("Location: display_course.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Course</title>
<style>
body { font-family: Arial; background: #f0f8ff; padding: 50px; }
h2 { color: navy; text-align: center; }
form { width: 400px; margin: auto; background: #ffffffcc; padding: 20px; border-radius: 10px; }
input[type=text], input[type=number] { width: 100%; padding: 8px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; }
input[type=submit] { background-color: navy; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
input[type=submit]:hover { background-color: #000080cc; }
a { text-decoration: none; color: navy; font-weight: bold; display: block; text-align: center; margin-top: 10px; }
</style>
</head>
<body>

<h2>Edit Course</h2>
<form method="POST">
    Course Name: <input type="text" name="course_name" value="<?php echo $course['course_name']; ?>" required>
    Course Fee: <input type="number" name="course_fee" value="<?php echo $course['course_fee']; ?>" required>
    <input type="submit" name="update" value="Update">
</form>
<a href="display_course.php">Back to Courses</a>

</body>
</html>