<?php
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Get POST data
    $symbolno = $_POST['symbolNo'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $dob = $_POST['dob'];

    $cryptography = $_POST['cryptography'];
    $sad = $_POST['sad'];
    $sam = $_POST['sam'];
    $webtech = $_POST['webtech'];
    $ip = $_POST['ip'];
    $daa = $_POST['daa'];

    $cryptographyP = $_POST['cryptographyP'];
    $sadP = $_POST['sadP'];
    $samP = $_POST['samP'];
    $webtechP = $_POST['webtechP'];
    $ipP = $_POST['ipP'];
    $daaP = $_POST['daaP'];

    $marks = [
        $cryptography, $webtech, $daa, $sam, $ip, $sad,
        $cryptographyP, $webtechP, $daaP, $samP, $ipP, $sadP
    ];

    // Check if student is already registered
    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $symbolno);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "The student's data is already registered";
    } else {
        // Insert student data
        $sql = "INSERT INTO student (id, name, year, dob) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'isss', $symbolno, $name, $year, $dob);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Insert marks data
            $sql = "INSERT INTO marks (student_id, subject_id, marks) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            for ($i = 0; $i < count($marks); $i++) {
                $subject_id = $i + 1; // Assuming subjects have IDs 1-12
                $mark = $marks[$i];

                mysqli_stmt_bind_param($stmt, 'iii', $symbolno, $subject_id, $mark);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Success";
                } else {
                    echo "Error inserting marks: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error inserting student: " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid request method";
}
?>
