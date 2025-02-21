<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="Student.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="adminForm.css">


</head>
<body>

    <?php
    include_once "sidebar.php";
    ?>
    <div class="main-content">
     <div class="form-section">
        <form id="studentForm" method="POST" action="#">
            <div class="form-group">
            <label for="studentSymbolNo">Symbol No:</label>
            <input type="text" id="studentSymbolNo" name = "symbolNo" required>
            </div>
            <div class="form-group">
            <label for="studentYear">Year:</label>
            <input type="text" id="studentYear" name="year" required>
            </div>


            <!-- <label for="email">Year:</label>
            <input type="text" id="email" name="email" required><br><br> -->
            
            <button type="submit">Check Marks</button>
        </form>
    </div>
    <div id="result">

    </div>
    </div>
    <script src="student.js"></script>
</body>
</html>
