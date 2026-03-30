<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "root", "student_db");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

// Get student ID from URL
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($result);

// If form submitted
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET name='$name', class='$class', email='$email', phone='$phone' WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        header("Location: display_student.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
<style>
body { font-family: Arial; background: #f0f8ff; padding: 50px; }
h2 { color: navy; text-align: center; }
form { width: 400px; margin: auto; background: #ffffffcc; padding: 20px; border-radius: 10px; }
input[type=text], input[type=email] { width: 100%; padding: 8px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; }
input[type=submit] { background-color: navy; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
input[type=submit]:hover { background-color: #000080cc; }
a { text-decoration: none; color: navy; font-weight: bold; display: block; text-align: center; margin-top: 10px; }
</style>
</head>
<body>

<h2>Edit Student</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
    Class: <input type="text" name="class" value="<?php echo $student['class']; ?>" required>
    Email: <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
    Phone: <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required>
    <input type="submit" name="update" value="Update">
</form>
<a href="display_student.php">Back to Students</a>

</body>
</html>
