<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $conn = new mysqli("localhost", "root", "", "janarthanan");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<p>Feedback submitted successfully.</p>";
    } else {
        echo "<p>Error submitting feedback.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
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
            background-color: #3b82f6;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <h1>Send Us Feedback</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="message" placeholder="Your Feedback" rows="5" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
</body>
</html>
