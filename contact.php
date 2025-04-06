<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $conn = new mysqli("localhost", "root", "", "janarthanan");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<p>Message sent successfully.</p>";
    } else {
        echo "<p>Error sending message.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        form {
            max-width: 500px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        input, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #10b981;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <input type="text" name="subject" placeholder="Subject" required />
        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
        <button type="submit">Send Message</button>
        
    </form>
    <h5 style="color:red">Copyright © 2025 lost and found</h5><br>
    <h5>RUDHRAJENMAN.V</h5>
    <h5>SREEVAHSAN.M</h5>
    <h5>JANARTHANAN.R</h>
</body>
</html>
