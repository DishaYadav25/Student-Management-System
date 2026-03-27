<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #f4f7fb; /* light background */
}

/* Header */
.header {
    background: #0a1f44; /* navy blue */
    color: white;
    text-align: center;
    padding: 35px 20px;
    border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
}

.header h1 {
    font-size: 2.2em;
}

.header p {
    opacity: 0.9;
    margin-top: 5px;
}

/* Dashboard Grid */
.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 25px;
    padding: 40px;
    max-width: 1100px;
    margin: auto;
}

/* Card */
.card {
    background: white;
    border-radius: 15px;
    padding: 35px 20px;
    text-align: center;
    color: #333;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
    border-top: 5px solid #0a1f44;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Icons */
.icon {
    font-size: 40px;
    margin-bottom: 12px;
}

/* Text */
.card h2 {
    margin-bottom: 8px;
    color: #0a1f44;
}

.card p {
    font-size: 0.9em;
    color: #666;
}

/* Logout */
.logout-btn {
    display: block;
    margin: 30px auto;
    padding: 10px 25px;
    background: #0a1f44;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    width: max-content;
}

.logout-btn:hover {
    background: #123a7a;
}
</style>
</head>

<body>

<div class="header">
    <h1>Welcome, <?php echo $_SESSION['username']; ?> 👋</h1>
    <p>Student Management Dashboard</p>
</div>

<div class="dashboard">

<a href="add_student.php" class="card">
    <div class="icon">🎓</div>
    <h2>Students</h2>
    <p>Manage student info & profiles</p>
</a>

<a href="addcourses.php" class="card">
    <div class="icon">📚</div>
    <h2>Courses</h2>
    <p>View & manage courses</p>
</a>

<a href="attendance_record.php" class="card">
    <div class="icon">📅</div>
    <h2>Attendance</h2>
    <p>Track attendance</p>
</a>

<a href="add_fee.php" class="card">
    <div class="icon">💰</div>
    <h2>Fees</h2>
    <p>Manage payments</p>
</a>

<a href="add_marks.php" class="card">
    <div class="icon">📊</div>
    <h2>Marks</h2>
    <p>Manage results</p>
</a>

</div>

<a href="logout.php" class="logout-btn">Logout</a>

</body>
</html>