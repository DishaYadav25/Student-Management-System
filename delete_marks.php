<?php
$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM marks WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: display_marks.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>