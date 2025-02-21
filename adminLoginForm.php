<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="adminForm.css">

</head>
<body>
    <?php
    include_once "sidebar.php";
    ?>
    <div class="main-content">
    <div class="form-section">
        <form id="adminForm" method="POST" action="#">
            <h1>Admin Login</h1>
            <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" id="username" name = "username" required>
            </div>
            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            </div>
         
            <button type="submit">Login</button>
        </form>
    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>