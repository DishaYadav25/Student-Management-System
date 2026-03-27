<?php
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

// 1️⃣ Get record ID
if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

// 2️⃣ Fetch existing data
$res = mysqli_query($conn, "SELECT * FROM marks WHERE id = $id");
if (mysqli_num_rows($res) == 0) {
    die("Record not found");
}
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Marks</title>
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

<form class="marks-form" method="POST" action="update_marks.php">
    <h2>Edit Marks</h2>

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label for="student_id">Student:</label>
    <select name="student_id" id="student_id" required>
        <?php
        $res_students = mysqli_query($conn, "SELECT * FROM students ORDER BY name");
        while ($stu = mysqli_fetch_assoc($res_students)) {
            $selected = ($stu['id'] == $row['student_id']) ? "selected" : "";
            echo "<option value='" . $stu['id'] . "' $selected>" . $stu['name'] . "</option>";
        }
        ?>
    </select>

    <label for="course_id">Course:</label>
    <select name="course_id" id="course_id" required>
        <?php
        $res_courses = mysqli_query($conn, "SELECT * FROM courses ORDER BY course_name");
        while ($c = mysqli_fetch_assoc($res_courses)) {
            $selected = ($c['id'] == $row['course_id']) ? "selected" : "";
            echo "<option value='" . $c['id'] . "' $selected>" . $c['course_name'] . "</option>";
        }
        ?>
    </select>

    <label for="marks_obtained">Marks Obtained:</label>
    <input type="number" name="marks_obtained" id="marks_obtained" value="<?php echo $row['marks_obtained']; ?>" min="0" required>

    <label for="max_marks">Max Marks:</label>
    <input type="number" name="max_marks" id="max_marks" value="<?php echo $row['max_marks']; ?>" min="1" required>

    <input type="submit" value="Update">
</form>

</body>
</html>
<?php mysqli_close($conn); ?>