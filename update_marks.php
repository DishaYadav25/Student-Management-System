<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Apka root password
$dbname = "student_db";

// DB Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

// Handle Update Marks
if(isset($_POST['update_marks'])){
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $marks_obtained = isset($_POST['marks_obtained']) ? $_POST['marks_obtained'] : '';
    $maximum_marks  = isset($_POST['maximum_marks'])  ? $_POST['maximum_marks'] : '';

    if($id && $marks_obtained !== '' && $maximum_marks !== ''){
        $sql = "UPDATE marks 
                SET marks_obtained='$marks_obtained' 
                WHERE id='$id'";
        if(mysqli_query($conn, $sql)){
            $success = "Marks updated successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Please fill all fields!";
    }
}

// Fetch all marks
$marks_result = mysqli_query($conn, "SELECT m.id, s.name as student_name, c.course_name, m.marks_obtained, m.maximum_marks
                                     FROM marks m
                                     JOIN students s ON m.student_id = s.id
                                     JOIN courses c  ON m.course_id  = c.id
                                     ORDER BY s.name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Marks</title>
    <style>
        body { font-family: Arial; background: #e8f5e9; padding: 20px; text-align:center; }
        h2 { color: #2e7d32; }
        .form-container { display:inline-block; background:#a5d6a7; padding:20px; border-radius:15px; margin-bottom:30px; }
        input, select, button { padding:10px; margin:8px 0; border-radius:10px; border:1px solid #66bb6a; width:100%; }
        button { background:#2e7d32; color:white; border:none; cursor:pointer; font-weight:bold; transition:0.3s; }
        button:hover { background:#1b5e20; }
        .success { color: green; font-weight:bold; }
        .error { color: red; font-weight:bold; }

        table { width:90%; margin:auto; border-collapse: collapse; background:#c8e6c9; }
        th, td { border:1px solid #81c784; padding:10px; text-align:center; }
        th { background:#2e7d32; color:white; }
        tr:nth-child(even) { background:#a5d6a7; }
        form { margin:0; }
    </style>
</head>
<body>

<h2>Update Marks</h2>

<?php 
if(isset($success)) echo "<p class='success'>$success</p>";
if(isset($error))   echo "<p class='error'>$error</p>";
?>

<table>
    <tr>
        <th>Student</th>
        <th>Course</th>
        <th>Marks Obtained</th>
        <th>Maximum Marks</th>
        <th>Action</th>
    </tr>
    <?php if(mysqli_num_rows($marks_result) > 0){
        while($row = mysqli_fetch_assoc($marks_result)){ ?>
            <tr>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="number" name="marks_obtained" value="<?php echo $row['marks_obtained']; ?>" required>
                </td>
                <td>
                        <input type="number" name="maximum_marks" value="<?php echo $row['maximum_marks']; ?>" required>
                </td>
                <td>
                        <button type="submit" name="update_marks">Update</button>
                    </form>
                </td>
            </tr>
    <?php } } else { ?>
        <tr><td colspan="5">No marks found.</td></tr>
    <?php } ?>
</table>

</body>
</html>