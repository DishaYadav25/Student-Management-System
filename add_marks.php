<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../login.php"); 
    exit();
}
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Marks</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(to right, #ffe0b2, #ffcc80); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .marks-form { background-color: #ffffffcc; padding: 30px 40px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); width: 350px; }
        .marks-form h2 { text-align: center; color: #ff6f00; margin-bottom: 25px; }
        .marks-form label { display: block; margin-bottom: 5px; font-weight: bold; color: #e65100; }
        .marks-form select, .marks-form input[type="number"] { width: 100%; padding: 8px 10px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #ffcc80; font-size: 14px; }
        .marks-form input[type="submit"] { width: 100%; padding: 10px; background-color: #ff6f00; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .marks-form input[type="submit"]:hover { background-color: #e65100; }
    </style>
</head>
<body>

<form class="marks-form" method="POST" action="insert_marks.php">
    <h2>Add Marks</h2>

    <label for="student_id">Student:</label>
    <select name="student_id" id="student_id" required>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM students ORDER BY name");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        ?>
    </select>

    <label for="course_id">Course:</label>
    <select name="course_id" id="course_id" required>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . "</option>";
        }
        ?>
    </select>

    <label for="marks_obtained">Marks Obtained:</label>
    <input type="number" name="marks_obtained" id="marks_obtained" min="0" required>

    <label for="max_marks">Max Marks:</label>
    <input type="number" name="max_marks" id="max_marks" min="1" required>

    <input type="submit" value="Submit">
</form>

</body>
</html>