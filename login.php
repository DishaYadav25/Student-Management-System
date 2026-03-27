<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0f7fa, #80deea);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background-color: #ffffffcc;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 350px;
        }

        .login-form h2 {
            text-align: center;
            color: #00796b;
            margin-bottom: 25px;
        }

        .login-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #004d40;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #b2dfdb;
            font-size: 14px;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-form input[type="submit"]:hover {
            background-color: #004d40;
        }
    </style>
</head>
<body>

<form class="login-form" method="POST" action="authenticate.php">
    <h2>Login</h2>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" value="Login">
</form>

</body>
</html>