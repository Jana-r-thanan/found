<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0f7fa, #e8eaf6); /* soft gradient background */
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 220px;
            text-align: center;
            position: relative;
            border-top: 4px solid #3b82f6; /* blue default */
        }

        .card img {
            width: 80px;
            margin-bottom: 10px;
        }

        .card h2 {
            margin: 10px 0;
            font-size: 1.2em;
        }

        .arrow-button {
            margin-top: 10px;
            padding: 10px;
            background: #3b82f6;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        .card.yellow { border-top-color: #eab308; } /* yellow */
        .card.green { border-top-color: #16a34a; }  /* green */
        .card.sky { border-top-color: #0ea5e9; }    /* sky blue */

        .arrow-button i {
            font-size: 1em;
        }
    </style>
</head>
<body>
    <h1>Lost and Found</h1>

    <div class="card-container">
        <div class="card">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Lost">
            <h2>Post Lost Item</h2>
            <button class="arrow-button" onclick="location.href='lost.php'">
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </div>

        <div class="card yellow">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135823.png" alt="Found">
            <h2>Post Found Item</h2>
            <button class="arrow-button" style="background:#eab308" onclick="location.href='found.php'">
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </div>

        <div class="card green">
            <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="Items">
            <h2>View Items</h2>
            <button class="arrow-button" style="background:#16a34a" onclick="location.href='view.php'">
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </div>

        <div class="card sky">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png" alt="Remove">
            <h2>Remove Items</h2>
            <button class="arrow-button" style="background:#0ea5e9" onclick="location.href='remove.php'">
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </div>
    </div>
</body>
</html>
