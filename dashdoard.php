<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f7; margin: 0; padding: 0; }
        .header { background-color: #004080; color: white; padding: 20px; text-align: center; }
        .container { display: flex; flex-wrap: wrap; justify-content: center; margin: 30px; }
        .module { background-color: #0066cc; color: white; padding: 40px; margin: 15px;
                  text-align: center; border-radius: 10px; width: 200px; transition: 0.3s; text-decoration: none; }
        .module:hover { background-color: #0052a3; transform: scale(1.05); }
    </style>
</head>
<body>

<div class="header">
    <h1>Welcome to Student Management System</h1>
    <p>Hello, <?php echo $_SESSION['user']; ?>!</p>
</div>

<div class="container">
    <a href="students.php" class="module">Students</a>
    <a href="courses.php" class="module">Courses</a>
    <a href="attendance.php" class="module">Attendance</a>
    <a href="fees.php" class="module">Fees</a>
    <a href="marks.php" class="module">Marks</a>
</div>

</body>
</html>