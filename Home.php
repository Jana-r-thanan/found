<html>
<head>
<title>Lost&Found</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .navbar {  
      display: flex;
      justify-content: space-between;
      background:black;
      padding: 15px;
      color: white;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    .nav-links {
      display: flex;
      gap: 20px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      padding: 8px 12px;
    }

    .nav-links a:hover {
      background: #555;
      border-radius: 5px;
    }
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      min-width: 120px;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 5px;
    }

    .dropdown-content a {
      color: black;
      padding: 10px;
      display: block;
      text-decoration: none;
    }

    .dropdown-content a:hover {
      background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
    .image-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: url('homeimage.jpg') no-repeat center center/cover;
      z-index: -1;
    }

</style>
</head>
<body>
  <div class="navbar">
    <div class="nav-links">
      <a href="Home.php">Home</a>
      <a href="contact.php">Contact</a>
      <a href="About.php">About</a>
      <a href="feedback.php">Feedback</a>
    </div>
    <div class="dropdown">
      <span style="cursor:pointer;">Login</span>
      <div class="dropdown-content">
        <a href="login.php" target="_blank">Login</a>
        <a href="register.php" target="_blank">Register</a>
      </div>
    </div>
  </div>
  <div class="image-container"></div>
</body>
</html>
