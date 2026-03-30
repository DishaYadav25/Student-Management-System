<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","root","student_db");
if(!$conn){ die("Connection failed: " . mysqli_connect_error()); }

// Fetch students & courses
$students_result = mysqli_query($conn, "SELECT id, name FROM students");
$courses_result  = mysqli_query($conn, "SELECT id, course_name FROM courses");

// Handle form submission
if(isset($_POST['submit_attendance'])){
    $student_id = $_POST['student_id'];
    $course_id  = $_POST['course_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    if($student_id && $course_id && $attendance_date && $status){
        // Prevent duplicate attendance
        $check = mysqli_query($conn, "SELECT * FROM attendance 
                                      WHERE student_id='$student_id' 
                                        AND course_id='$course_id' 
                                        AND attendance_date='$attendance_date'");
        if(mysqli_num_rows($check) == 0){
            $sql = "INSERT INTO attendance (student_id, course_id, attendance_date, status)
                    VALUES ('$student_id','$course_id','$attendance_date','$status')";
            mysqli_query($conn, $sql);
            // Redirect to display page for this student
            header("Location: display_attendance.php?student_id=$student_id");
            exit();
        } else {
            $error = "Attendance for this student on this date already exists!";
        }
    } else {
        $error = "Please fill all fields!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Record Attendance</title>
    <style>
        body { font-family: Arial; background: #e8f5e9; display:flex; justify-content:center; padding-top:50px;}
        form { width: 400px; background: #a5d6a7; padding: 25px; border-radius:15px; text-align:center; }
        input, select, button { width: 100%; padding:10px; margin:10px 0; border-radius:10px; border:1px solid #66bb6a; }
        button { background: #2e7d32; color:white; font-weight:bold; cursor:pointer; transition:0.3s; }
        button:hover { background:#1b5e20; }
        .error { color:red; font-weight:bold; }
    </style>
</head>
<body>
<form method="POST" action="">
    <h2>Record Attendance</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <select name="student_id">
        <option value="">Select Student</option>
        <?php while($s = mysqli_fetch_assoc($students_result)){ ?>
            <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?></option>
        <?php } ?>
    </select>

    <select name="course_id">
        <option value="">Select Course</option>
        <?php while($c = mysqli_fetch_assoc($courses_result)){ ?>
            <option value="<?php echo $c['id']; ?>"><?php echo $c['course_name']; ?></option>
        <?php } ?>
    </select>

    <input type="date" name="attendance_date" />
    <select name="status">
        <option value="">Select Status</option>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select>

    <button type="submit" name="submit_attendance">Submit Attendance</button>
</form>
</body>
</html>
