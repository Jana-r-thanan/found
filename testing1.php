<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .feedback-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            height: 120px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 14px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .feedback-container {
                margin: 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>

<div class="feedback-container">
    <h2>Feedback Form</h2>
    <form>
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        
        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" id="website" name="website">
        </div>
        
        <div class="form-group">
            <label for="comment">Comment *</label>
            <textarea id="comment" name="comment" required></textarea>
        </div>
        
        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

</body>
</html>
