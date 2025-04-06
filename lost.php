<?php
// lost.php — Post Lost Item Form and PHP logic

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "janarthanan");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $category = $_POST["category"];
    $description = $_POST["description"];
    $phone = $_POST["phone"];
    $date = $_POST["date_lost"];
    $location = $_POST["location"];
    $model = $_POST["model"] ?? null;
    $imei = $_POST["imei"] ?? null;
    $regNumber = $_POST["reg_number"] ?? null;
    $engineNumber = $_POST["engine_number"] ?? null;
    $jewelType = $_POST["jewel_type"] ?? null;

    $photoPath = null;
    $receiptPath = null;

    // Handle photo upload
    if (!empty($_FILES["photo"]["name"])) {
        $photoPath = "uploads/" . time() . "_" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
    }

    // Handle receipt upload
    if (!empty($_FILES["receipt"]["name"])) {
        $receiptPath = "uploads/" . time() . "_" . basename($_FILES["receipt"]["name"]);
        move_uploaded_file($_FILES["receipt"]["tmp_name"], $receiptPath);
    }

    $stmt = $conn->prepare("INSERT INTO lost_items 
        (category, model, imei, reg_number, engine_number, jewel_type, description, phone, date_lost, location, photo_path, receipt_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssss", 
        $category, $model, $imei, $regNumber, $engineNumber, $jewelType, $description, $phone, $date, $location, $photoPath, $receiptPath);

    if ($stmt->execute()) {
        echo "<script>alert('Lost item posted successfully!'); window.location.href='view.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Lost Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        header h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input, select, button {
            display: block;
            width: 100%;
            margin: 5px 0 15px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #3b82f6;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2563eb;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<header><h1>Post Lost Item</h1></header>

<form method="POST" enctype="multipart/form-data" onsubmit="return validateLostForm()">
    <label for="category">Category:</label>
    <select id="category" name="category" onchange="showVerificationFields()" required>
        <option value="">Select Category</option>
        <option value="electronics">Electronics</option>
        <option value="transportation">Transportation</option>
        <option value="jewel">Jewel</option>
    </select>

    <div id="verificationFields"></div>

    <label for="description">Description:</label>
    <input type="text" name="description" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" name="phone" required pattern="[6-9]{1}[0-9]{9}">

    <label for="date_lost">Date:</label>
    <input type="date" name="date_lost" required>

    <label for="location">Location:</label>
    <input type="text" name="location" required>

    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<script>
    function showVerificationFields() {
        const category = document.getElementById("category").value;
        const container = document.getElementById("verificationFields");
        container.innerHTML = "";

        if (category === "electronics") {
            container.innerHTML = `
                <label>Model and Type:</label>
                <input type="text" name="model" required>

                <label>IMEI/Serial Number:</label>
                <input type="text" name="imei" required>

                <label>Photo:</label>
                <input type="file" name="photo" accept="image/*" required>
            `;
        } else if (category === "transportation") {
            container.innerHTML = `
                <label>Model and Type:</label>
                <input type="text" name="model" required>

                <label>Registration Number:</label>
                <input type="text" name="reg_number" required>

                <label>Engine Number:</label>
                <input type="text" name="engine_number" required>

                <label>Photo:</label>
                <input type="file" name="photo" accept="image/*" required>
            `;
        } else if (category === "jewel") {
            container.innerHTML = `
                <label>Jewel Type:</label>
                <input type="text" name="jewel_type" required>

                <label>Receipt (photo/pdf):</label>
                <input type="file" name="receipt" accept="image/*,application/pdf" required>

                <label>Jewellery Photo:</label>
                <input type="file" name="photo" accept="image/*" required>
            `;
        }
    }

    function validateLostForm() {
        const phone = document.querySelector('input[name="phone"]').value;
        if (!/^[6-9]\d{9}$/.test(phone)) {
            alert("Invalid phone number. It must be a 10-digit Indian number.");
            return false;
        }

        const photo = document.querySelector('input[name="photo"]');
        if (photo && photo.files[0] && photo.files[0].size > 10 * 1024 * 1024) {
            alert("Photo size should not exceed 10MB.");
            return false;
        }

        const receipt = document.querySelector('input[name="receipt"]');
        if (receipt && receipt.files[0] && receipt.files[0].size > 10 * 1024 * 1024) {
            alert("Receipt size should not exceed 10MB.");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
