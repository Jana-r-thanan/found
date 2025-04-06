<?php
// Database connection
$host = "localhost";
$dbname = "janarthanan";
$username = "root";
$password = ""; // Default for XAMPP

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $terms = isset($_POST["terms"]);

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } elseif ($password !== $confirmpassword) {
        $error = "Passwords do not match!";
    } elseif (!$terms) {
        $error = "You must agree to the Terms!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);

        if ($stmt->execute()) {
            $success = "Successfully Registered!";
            header("Location: index.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .checkbox-group input {
            margin-right: 5px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button#registerBtn {
            background-color: green;
            color: white;
        }

        button#resetBtn {
            background-color: red;
            color: white;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .links {
            margin-top: 15px;
        }

        .links a {
            display: block;
            color: green;
            text-decoration: none;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register Form</h2>

    <?php if ($error): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-message"><?= $success ?></div>
    <?php endif; ?>

    <form id="registerForm" method="POST" action="">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>
            <small class="error-message" id="emailError"></small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <small class="error-message" id="passwordError"></small>
        </div>

        <div class="form-group">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required>
            <small class="error-message" id="confirmPasswordError"></small>
        </div>

        <div class="form-group checkbox-group">
            <input type="checkbox" id="terms" name="terms">
            I agree to the <a href="terms.php" target="_blank">Terms and Conditions</a>
            <small class="error-message" id="termsError"></small>
        </div>

        <div class="button-group">
            <button type="submit" id="registerBtn">Register</button>
            <button type="reset" id="resetBtn">Reset</button>
        </div>
    </form>

    <div class="links">
        <a href="home.php" class="home-link">GO TO HOME PAGE</a>
        <a href="contact.php">Contact Us</a>
    </div>
</div>

<script>
    // JavaScript validation
    document.getElementById("registerForm").addEventListener("submit", function (event) {
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmpassword").value;
        const termsChecked = document.getElementById("terms").checked;

        const emailError = document.getElementById("emailError");
        const passwordError = document.getElementById("passwordError");
        const confirmPasswordError = document.getElementById("confirmPasswordError");
        const termsError = document.getElementById("termsError");

        emailError.textContent = "";
        passwordError.textContent = "";
        confirmPasswordError.textContent = "";
        termsError.textContent = "";

        let isValid = true;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            emailError.textContent = "Invalid email format!";
            isValid = false;
        }

        if (password.length < 6) {
            passwordError.textContent = "Password must be at least 6 characters!";
            isValid = false;
        }

        if (password !== confirmPassword) {
            confirmPasswordError.textContent = "Passwords do not match!";
            isValid = false;
        }

        if (!termsChecked) {
            termsError.textContent = "You must agree to the Terms!";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
