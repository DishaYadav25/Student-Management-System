<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","root","student_db");
if(!$conn){ die("Connection failed: ".mysqli_connect_error()); }

// 1️⃣ Get attendance ID from URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM attendance WHERE id = $id");
    $attendance = mysqli_fetch_assoc($res);
} else {
    echo "Invalid ID";
    exit();
}

// 2️⃣ Fetch all students & courses for dropdown
$students = mysqli_query($conn, "SELECT * FROM students");
$courses = mysqli_query($conn, "SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance</title>
    <style>
        body { font-family: Arial; background: #f0f8ff; padding: 50px; }
        h2 { color: navy; text-align: center; }
        form { width: 400px; margin: auto; background: #ffffffcc; padding: 20px; border-radius: 10px; }
        select, input[type=date] { width: 100%; padding: 8px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; }
        input[type=submit] { background-color: navy; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        input[type=submit]:hover { background-color: #000080cc; }
        a { text-decoration: none; color: navy; font-weight: bold; display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>

<h2>Edit Attendance</h2>

<form method="POST" action="update_attendance.php">
    <input type="hidden" name="id" value="<?php echo $attendance['id']; ?>">

    Student:
    <select name="student_id" required>
        <?php while($s = mysqli_fetch_assoc($students)){ 
            $selected = ($s['id'] == $attendance['student_id']) ? "selected" : "";
            echo "<option value='".$s['id']."' $selected>".$s['name']."</option>";
        } ?>
    </select>

    Course:
    <select name="course_id" required>
        <?php while($c = mysqli_fetch_assoc($courses)){ 
            $selected = ($c['id'] == $attendance['course_id']) ? "selected" : "";
            echo "<option value='".$c['id']."' $selected>".$c['course_name']."</option>";
        } ?>
    </select>

    Date: <input type="date" name="attendance_date" value="<?php echo $attendance['attendance_date']; ?>" required>

    Status:
    <select name="status" required>
        <option value="Present" <?php if($attendance['status']=="Present") echo "selected"; ?>>Present</option>
        <option value="Absent" <?php if($attendance['status']=="Absent") echo "selected"; ?>>Absent</option>
    </select>

    <input type="submit" value="Update">
</form>

<a href="display_attendance.php">Back to Attendance</a>

</body>
</html>
