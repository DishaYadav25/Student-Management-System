<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #ffffffcc; /* Semi-transparent white */
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: navy; /* Heading color changed to navy blue */
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: navy; /* Submit button color navy blue */
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #000080cc; /* Darker navy on hover */
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: navy;
        }
    </style>
</head>
<body>
    <div class="form-container">
  <h2>Add Student</h2>
  <?php
    if(isset($_GET['msg']) && $_GET['msg']=="success"){
        echo "<p style='color:green; text-align:center;'>Student Added Successfully!</p>";
    }
    ?>
       <form method="POST" action="insert_student.php">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Class:</label>
    <input type="text" name="class" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <input type="submit" name="submit" value="Submit">
</form> 
        <a href="display_student.php">View All Students</a>
    </div>
</body>
</html>