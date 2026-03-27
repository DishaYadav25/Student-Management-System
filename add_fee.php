<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "student_db";

// Database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

// Fetch students & courses for dropdown
$students_result = mysqli_query($conn, "SELECT id, name FROM students");
$courses_result  = mysqli_query($conn, "SELECT id, course_name FROM courses");

// Handle form submission
if(isset($_POST['submit_fee'])){
    $student_id = $_POST['student_id'];
    $course_id  = $_POST['course_id'];
    $amount     = $_POST['amount'];
    $paid_date  = $_POST['paid_date'];

    if($student_id && $course_id && $amount && $paid_date){
        // Check duplicate
        $check = mysqli_query($conn, "SELECT * FROM fee 
                                      WHERE student_id='$student_id' 
                                        AND course_id='$course_id' 
                                        AND paid_date='$paid_date'");
        if(mysqli_num_rows($check) == 0){
            $sql_fee = "INSERT INTO fee (student_id, course_id, amount, paid_date)
                        VALUES ('$student_id','$course_id','$amount','$paid_date')";
            if(mysqli_query($conn, $sql_fee)){
                // Redirect to display page for this student
                header("Location: display_fee.php?student_id=$student_id");
                exit();
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        } else {
            $error = "Fee for this student on this date already exists!";
        }
    } else {
        $error = "Please fill all fields!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Fee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e8f5e9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #a5d6a7;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }
        h2 { color: #2e7d32; margin-bottom: 20px; }
        select, input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #66bb6a;
            font-size: 16px;
        }
        button {
            background: #2e7d32;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        button:hover { background: #1b5e20; }
        .error { color: red; font-weight: bold; margin: 10px 0; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Fee</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" action="">
        <select name="student_id">
            <option value="">Select Student</option>
            <?php while($student = mysqli_fetch_assoc($students_result)) { ?>
                <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
            <?php } ?>
        </select>

        <select name="course_id">
            <option value="">Select Course</option>
            <?php while($course = mysqli_fetch_assoc($courses_result)) { ?>
                <option value="<?php echo $course['id']; ?>"><?php echo $course['course_name']; ?></option>
            <?php } ?>
        </select>

        <input type="number" name="amount" placeholder="Amount" />
        <input type="date" name="paid_date" />
        <button type="submit" name="submit_fee">Submit Fee</button>
    </form>
</div>

</body>
</html>