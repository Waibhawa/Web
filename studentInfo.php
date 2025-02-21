<?php
include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Info</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="studentInfo.css">
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
      >
</head>
<body>
<?php
include_once "sidebar.php";
?>
<div class="main-content">
    <div class="student-info-container">
        <h1>Student Information</h1>
        <table>
            <thead>
                <tr>
                    <th>Symbol No</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Date of Birth</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch student data
                $sql = "SELECT * FROM student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr class='student-details-row' data-id = '$row[id]' data-year = '$row[year]'>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[year]</td>
                            <td>$row[dob]</td>
                            <td><button id='deleteRecord' data-studentid='$row[id]'><i class='fa-solid fa-trash-xmark'></i></button></td>
                        </tr>
                         ";

                        
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <button id="backBtn">Back</button>
    <div id="result">

    </div>
</div>
<script src="student.js"></script>
</body>
</html>
