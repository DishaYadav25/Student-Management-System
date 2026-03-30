<?php
session_start();

// Session check
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "student_db";

// Connect
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
    $fee_records = mysqli_query($conn, "SELECT f.id, s.name as student_name, c.course_name, f.amount, f.paid_date
                                        FROM fee f
                                        JOIN students s ON f.student_id = s.id
                                        JOIN courses c  ON f.course_id  = c.id
                                        WHERE f.student_id='$student_id'
                                        ORDER BY f.paid_date DESC");
} else {
    die("No student selected.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fee Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e8f5e9;
            display: flex;
            justify-content: center;
            padding: 40px;
        }
        .table-container {
            width: 700px;
        }
        h2 { color: #2e7d32; text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: #c8e6c9; }
        th, td { border: 1px solid #81c784; padding: 12px; text-align: center; }
        th { background: #2e7d32; color: white; }
        tr:nth-child(even) { background: #a5d6a7; }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Fee Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Course</th>
            <th>Amount</th>
            <th>Paid Date</th>
        </tr>
        <?php if(mysqli_num_rows($fee_records) > 0){
            while($row = mysqli_fetch_assoc($fee_records)){ ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['paid_date']; ?></td>
                </tr>
        <?php } } else { ?>
            <tr><td colspan="5">No fee records found.</td></tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
