 <?php
include "database.php";
?>
<!-- qoylmycumwgcewqo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include_once "sidebar.php";
    ?>

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Dashboard</h1>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-container">
            <a href="adminLoginForm.php">

                <div class="category category-blue">
                    <div>
                        <h2>Admin</h2>
                        <p></p>
                    </div>
                    <span>👤</span>
                </div>
            </a>
            <a href="subjects.php">

            <div class="category category-red">
                <div>
                    <h2>Subjects </h2>
                    <p></p>
                </div>
                <span>📚</span>            
            </div>
            </a>
            <a href="studentInfo.php">

            <div class="category category-orange">
                <div>
                    <h2>Student Information </h2>
                    <p></p>
                </div>
                <span>🏛️</span>
            </div>
            </a>
            <a href="studentportal.php">

            <div class="category category-green">
                <div>
                    <h2>Results </h2>
                    <p></p>
                </div>
                <span>📄</span>
            </div>
            </a>
        </div>
    </div>
</body>
</html>