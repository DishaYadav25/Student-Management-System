<?php
$conn = mysqli_connect("localhost","root","root","student_db");
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM attendance WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        // Record delete ho gaya, wapas display page pe redirect
        header("Location: display_attendance.php");
        exit();
    } else {
        echo "Error: ".mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>