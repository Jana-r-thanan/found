<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        .container {
            gap: 10px; 
            padding: 30px;
            margin-top: 100px;
            border: 5px solid violet;
            border-radius: 10px;
            text-align: center;
            background-color: white;
            width: 400px;
            margin: auto;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            /* Removed color: red; to allow .error and .success to control text color */
        }
        body {
            background-color: bisque;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        input {
            width: 100%;
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
        .error {
            color: red;
            font-size: 14px;
        }
        .success {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Forgot Password</h1>
    <form id="forgotPasswordForm">
        <input type="text" id="username" placeholder="Enter your username" ><br>
        <input type="email" id="email" placeholder="Enter your Gmail (e.g., example@gmail.com)" ><br>
        <input type="password" id="password" placeholder="Enter your new password" ><br>
        <input type="password" id="confirmPassword" placeholder="Repeat your password" ><br>
        <button type="submit">Submit</button>
    </form>
    <p id="message"></p>
    <br>
    <a href="Home.php" style="color:green;">Go To Home Page</a>
</div>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const message = document.getElementById('message');

        if (username === "") {
            message.className = "error";
            message.innerText = "Username cannot be empty.";
            return;
        }

        if (!email.match(/^[a-zA-Z0-9._%+-]+@gmail\.com$/)) {
            message.className = "error";
            message.innerText = "Please enter a valid Gmail address.";
            return;
        }

        if (password.length < 6) {
            message.className = "error";
            message.innerText = "Password must be at least 6 characters long.";
            return;
        }

        if (password !== confirmPassword) {
            message.className = "error";
            message.innerText = "Passwords do not match.";
            return;
        }

        message.className = "success";
        message.innerText = "Password reset successful! Redirecting...";

        setTimeout(() => {
            window.location.href = "login.php";
        }, 2000);
    });
</script>

</body>
</html>
