<?php
// found.php - Page to display and handle the found item form

// Connect to DB
$conn = new mysqli("localhost", "root", "", "janarthanan");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // Optional category-specific fields
    $model = $_POST['model'] ?? null;
    $regNumber = $_POST['regNumber'] ?? null;
    $engineNumber = $_POST['engineNumber'] ?? null;
    $jewelType = $_POST['jewelType'] ?? null;

    // Handle file upload
    $photoName = $_FILES["photo"]["name"];
    $photoTmp = $_FILES["photo"]["tmp_name"];
    $photoPath = "uploads/" . basename($photoName);
    move_uploaded_file($photoTmp, $photoPath);

    $stmt = $conn->prepare("INSERT INTO found_items (category, model, regnumber, engine_number, jewel_type, description, phone, date, location, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $category, $model, $regNumber, $engineNumber, $jewelType, $description, $phone, $date, $location, $photoPath);

    if ($stmt->execute()) {
        echo "<script>alert('Item submitted successfully!'); window.location.href='view.php';</script>";
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
    <title>Post Found Item</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { max-width: 500px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 10px; }
        label, input, select, button { display: block; width: 100%; margin: 10px 0; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Post Found Item</h2>
    <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="category">Category:</label>
        <select name="category" id="category" onchange="showFields()" required>
            <option value="">Select</option>
            <option value="electronics">Electronics</option>
            <option value="transportation">Transportation</option>
            <option value="jewel">Jewel</option>
        </select>

        <div id="extraFields"></div>

        <label>Description:</label>
        <input type="text" name="description" required>

        <label>Phone Number:</label>
        <input type="tel" name="phone" pattern="[6-9]{1}[0-9]{9}" required>

        <label>Date:</label>
        <input type="date" name="date" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Photo:</label>
        <input type="file" name="photo" accept="image/*" required>

        <button type="submit">Submit</button>
    </form>

    <script>
        function showFields() {
            const category = document.getElementById("category").value;
            const container = document.getElementById("extraFields");
            container.innerHTML = "";

            if (category === "electronics") {
                container.innerHTML += `<label>Model and Type:</label><input type="text" name="model" required>`;
            } else if (category === "transportation") {
                container.innerHTML += `<label>Model and Type:</label><input type="text" name="model" required>`;
                container.innerHTML += `<label>Registration Number:</label><input type="text" name="regNumber" required>`;
                container.innerHTML += `<label>Engine Number:</label><input type="text" name="engineNumber" required>`;
            } else if (category === "jewel") {
                container.innerHTML += `<label>Jewel Type:</label><input type="text" name="jewelType" required>`;
            }
        }

        function validateForm() {
            const fileInput = document.querySelector('input[name="photo"]');
            const file = fileInput.files[0];
            if (file && file.size > 10 * 1024 * 1024) {
                alert("Image too large! Max size 10MB.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
