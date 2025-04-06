<?php
$conn = new mysqli("localhost", "root", "", "janarthanan");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch lost and found data
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
    <title>View Lost and Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        select {
            display: block;
            margin: 20px auto;
            padding: 10px;
            font-size: 16px;
        }

        .item-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 320px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            background-color: white;
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
            color: #333;
        }

        .field {
            margin-bottom: 8px;
        }

        .field span {
            font-weight: bold;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<h1>View Lost and Found Items</h1>

<select id="categorySelect" onchange="toggleCategory()">
    <option value="lost">Lost Items</option>
    <option value="found">Found Items</option>
</select>

<div class="item-container" id="lostItems">
    <?php foreach ($lostItems as $item): ?>
        <div class="card lost">
            <h3>Lost: <?= htmlspecialchars($item['category']) ?></h3>
            <?php if ($item['photo_path']) echo "<img src='{$item['photo_path']}' style='width:100%;border-radius:8px;margin-bottom:10px;'>"; ?>
            <div class="field"><span>Model:</span> <?= htmlspecialchars($item['model']) ?></div>
            <div class="field"><span>IMEI:</span> <?= htmlspecialchars($item['imei']) ?></div>
            <div class="field"><span>Reg No:</span> <?= htmlspecialchars($item['reg_number']) ?></div>
            <div class="field"><span>Engine No:</span> <?= htmlspecialchars($item['engine_number']) ?></div>
            <div class="field"><span>Jewel Type:</span> <?= htmlspecialchars($item['jewel_type']) ?></div>
            <div class="field"><span>Description:</span> <?= htmlspecialchars($item['description']) ?></div>
            <div class="field"><span>Phone:</span> <?= htmlspecialchars($item['phone']) ?></div>
            <div class="field"><span>Date:</span> <?= htmlspecialchars($item['date_lost']) ?></div>
            <div class="field"><span>Location:</span> <?= htmlspecialchars($item['location']) ?></div>
        </div>
    <?php endforeach; ?>
</div>

<div class="item-container hidden" id="foundItems">
    <?php foreach ($foundItems as $item): ?>
        <div class="card found">
            <h3>Found: <?= htmlspecialchars($item['category']) ?></h3>
            <?php if ($item['photo']) echo "<img src='{$item['photo']}' style='width:100%;border-radius:8px;margin-bottom:10px;'>"; ?>
            <div class="field"><span>Model:</span> <?= htmlspecialchars($item['model']) ?></div>
            <div class="field"><span>Reg No:</span> <?= htmlspecialchars($item['regNumber']) ?></div>
            <div class="field"><span>Engine No:</span> <?= htmlspecialchars($item['engine_number']) ?></div>
            <div class="field"><span>Jewel Type:</span> <?= htmlspecialchars($item['jewel_type']) ?></div>
            <div class="field"><span>Description:</span> <?= htmlspecialchars($item['description']) ?></div>
            <div class="field"><span>Phone:</span> <?= htmlspecialchars($item['phone']) ?></div>
            <div class="field"><span>Date:</span> <?= htmlspecialchars($item['date']) ?></div>
            <div class="field"><span>Location:</span> <?= htmlspecialchars($item['location']) ?></div>
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
