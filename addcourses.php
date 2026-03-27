<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","root","student_db");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if(isset($_POST['submit'])){
    $course_name = mysqli_real_escape_string($conn,$_POST['course_name']);
    $course_fee  = mysqli_real_escape_string($conn,$_POST['course_fee']);

    $sql = "INSERT INTO courses (course_name, course_fee) 
            VALUES ('$course_name', '$course_fee')";

    if(mysqli_query($conn,$sql)){
        $message = "Course Added Successfully!";
    } else {
        $message = "Error: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

/* LIGHT BACKGROUND */
body{
    background:#f5f3ff;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* FORM BOX */
.container{
    background:white;
    padding:30px;
    width:360px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
    border-top:5px solid #4b3f72;
}

/* HEADING */
h2{
    text-align:center;
    color:#4b3f72;
    margin-bottom:20px;
}

/* INPUTS */
input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}

/* BUTTON */
input[type=submit]{
    background:#4b3f72;
    color:white;
    font-weight:bold;
    cursor:pointer;
    border:none;
}

input[type=submit]:hover{
    background:#372c5a;
}

/* MESSAGE */
.message{
    text-align:center;
    margin-bottom:10px;
    color:#4b3f72;
    font-weight:bold;
}

/* LINKS */
a{
    display:block;
    text-align:center;
    margin-top:10px;
    text-decoration:none;
    color:#4b3f72;
    font-weight:bold;
}

a:hover{
    text-decoration:underline;
}
</style>

</head>
<body>

<div class="container">

<h2>Add Course</h2>

<?php if($message != ""): ?>
    <p class="message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="course_name" placeholder="Enter Course Name" required>
    <input type="number" name="course_fee" placeholder="Enter Course Fee" required>
    <input type="submit" name="submit" value="Add Course">
</form>

<a href="display_course.php">View Courses</a>
<a href="../home.php">Back to Dashboard</a>

</div>

</body>
</html>