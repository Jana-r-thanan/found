<?php
$conn = new mysqli("localhost", "root", "", "janarthanan");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'], $_POST['table'])) {
    $id = intval($_POST['delete_id']);
    $table = $_POST['table'] === 'lost' ? 'lost_items' : 'found_items';
    $conn->query("DELETE FROM $table WHERE id = $id");
}

// Fetch data
$lostItems = [];
$foundItems = [];

$lostResult = $conn->query("SELECT * FROM lost_items");
if ($lostResult) {
    while ($row = $lostResult->fetch_assoc()) {
        $lostItems[] = $row;
    }
}

$foundResult = $conn->query("SELECT * FROM found_items");
if ($foundResult) {
    while ($row = $foundResult->fetch_assoc()) {
        $foundItems[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Items - Lost & Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        select {
            display: block;
            margin: 0 auto 30px;
            padding: 10px;
            font-size: 16px;
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 320px;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: relative;
        }

        .lost {
            background-color: #ffe5e5;
            border-left: 6px solid #e53935;
        }

        .found {
            background-color: #e6ffed;
            border-left: 6px solid #34a853;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .field {
            margin-bottom: 8px;
        }

        form {
            margin-top: 10px;
        }

        .removeBtn {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .removeBtn:hover {
            background-color: #dc2626;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<h1>Remove Lost or Found Items</h1>

<select id="categorySelect" onchange="toggleCategory()">
    <option value="lost">Lost Items</option>
    <option value="found">Found Items</option>
</select>

<div id="lostItems" class="items-container">
    <?php foreach ($lostItems as $item): ?>
        <div class="card lost">
            <h3>Lost: <?= htmlspecialchars($item['category']) ?></h3>
            <div class="field"><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></div>
            <div class="field"><strong>Phone:</strong> <?= htmlspecialchars($item['phone']) ?></div>
            <div class="field"><strong>Location:</strong> <?= htmlspecialchars($item['location']) ?></div>
            <form method="POST">
                <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                <input type="hidden" name="table" value="lost">
                <button type="submit" class="removeBtn" onclick="return confirm('Delete this lost item?')">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<div id="foundItems" class="items-container hidden">
    <?php foreach ($foundItems as $item): ?>
        <div class="card found">
            <h3>Found: <?= htmlspecialchars($item['category']) ?></h3>
            <div class="field"><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></div>
            <div class="field"><strong>Phone:</strong> <?= htmlspecialchars($item['phone']) ?></div>
            <div class="field"><strong>Location:</strong> <?= htmlspecialchars($item['location']) ?></div>
            <form method="POST">
                <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                <input type="hidden" name="table" value="found">
                <button type="submit" class="removeBtn" onclick="return confirm('Delete this found item?')">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function toggleCategory() {
        const selected = document.getElementById("categorySelect").value;
        document.getElementById("lostItems").classList.toggle("hidden", selected !== "lost");
        document.getElementById("foundItems").classList.toggle("hidden", selected !== "found");
    }
</script>

</body>
</html>
