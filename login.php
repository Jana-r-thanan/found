<?php
session_start();
$host = "localhost";
$dbname = "janarthanan";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $pass = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, firstname, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $firstname, $hashed_password);
        $stmt->fetch();

        if (password_verify($pass, $hashed_password)) {
            $_SESSION["userid"] = $id;
            $_SESSION["firstname"] = $firstname;
            header("Location: index.php");
            exit();
        } else {
            $loginMessage = "Incorrect password.";
        }
    } else {
        $loginMessage = "Email not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .container {
            gap: 10px;
            padding: 50px;
            margin-top: 100px;
            background: linear-gradient(to right, red, violet, blue);
            border-radius: 10px;
            text-align: center;
            width: 400px;
            margin: auto;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            color: white;
        }

        body {
            background-color: slateblue;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid gray;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            width: 100%;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgreen;
        }

        #message {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Login</h1>

    <?php if (!empty($loginMessage)): ?>
        <p style="color: yellow;" id="message"><?= $loginMessage ?></p>
    <?php endif; ?>

    <form id="loginForm" method="POST" action="">
        <input type="email" id="email" name="email" placeholder="Enter your email" required><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
        <button type="submit">Login</button>
    </form>

    <a href="forget.php" style="color:yellow;">Forgot password?</a>
    <br><br>
    <a href="register.php" style="color:white;">Don't have an account? Register here</a>
    <br><br>
    <a href="home.php" style="color:blue;">HOME_PAGE</a>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const message = document.getElementById('message');

        message.innerHTML = "";
        message.style.color = "black";

        if (email === "") {
            event.preventDefault();
            message.innerHTML = "Email cannot be empty.";
            return;
        }

        if (!email.match(/^[a-zA-Z0-9._%+-]+@gmail\.com$/)) {
            event.preventDefault();
            message.innerHTML = "Please enter a valid Gmail address.";
            return;
        }

        if (password === "") {
            event.preventDefault();
            message.innerHTML = "Password cannot be empty.";
            return;
        }

        if (password.length < 6) {
            event.preventDefault();
            message.innerHTML = "Password must be at least 6 characters.";
            return;
        }
    });
</script>

</body>
</html>
