<!DOCTYPE html>
<html>
<head>
    <title>Post Lost or Found Item</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function showVerificationFields() {
            let category = document.getElementById("category").value;
            let fieldsDiv = document.getElementById("verificationFields");
            fieldsDiv.innerHTML = "";

            if (category === "electronics") {    
                fieldsDiv.innerHTML = `
                    <label for="imei">IMEI/Serial Number:</label>
                    <input type="text" id="imei" name="imei">
                    <label for="lastIP">Last Connected IP:</label>
                    <input type="text" id="lastIP" name="lastIP">
                    <label for="loginProof">Google/Apple ID Login Proof:</label>
                    <input type="text" id="loginProof" name="loginProof">
                    <label for="pairedDevices">Paired Devices:</label>
                    <input type="text" id="pairedDevices" name="pairedDevices">
                `;
            } else if (category === "transportation") {
                fieldsDiv.innerHTML = `
                    <label for="regNumber">Registration Number:</label>
                    <input type="text" id="regNumber" name="regNumber">
                    <label for="engineNumber">Engine Number:</label>
                    <input type="text" id="engineNumber" name="engineNumber">
                    <label for="vehicleType">Vehicle Type:</label>
                    <input type="text" id="vehicleType" name="vehicleType">
                `;
            } else if (category === "jewel") {
                fieldsDiv.innerHTML = `
                    <label for="jewelType">Jewel Type:</label>
                    <input type="text" id="jewelType" name="jewelType">
                    <label for="weight">Weight (grams):</label>
                    <input type="text" id="weight" name="weight">
                    <label for="receipt">Receipt:</label>
                    <input type="file" id="receipt" name="receipt" multiple>
                    <label for="hallmarks">Hallmarks:</label>
                    <input type="text" id="hallmarks" name="hallmarks">
                `;
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Post Lost or Found Item</h1>
    </header>
    
    <form id="lostFoundForm">
        <label>Type:</label>
        <input type="radio" name="type" value="Lost" required> Lost
        <input type="radio" name="type" value="Found" required> Found

        <label for="category">Category:</label>
        <select id="category" name="category" onchange="showVerificationFields()" required>
            <option value="">Select Category</option>
            <option value="electronics">Electronics</option>
            <option value="transportation">Transportation</option>
            <option value="jewel">Jewel (Gold, Silver)</option>
        </select>

        <label for="item">Item Name:</label>
        <input type="text" id="item" name="item" required>

        <div id="verificationFields"></div>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="number" id="phonenumber" name="phonenumber" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>

    <script src="scripts.js"></script>
</body>
</html>
