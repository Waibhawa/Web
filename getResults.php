<?php
include_once "database.php";


$symbolNo = $_POST['symbolNo'];
$year = $_POST['year'];
$resultStatus = "Pass";
$resultClass = "pass";
$isPercentageShown = false;

$sql = "
SELECT 
    student.*,
    student.name AS student_name,
    subjects.name AS subject_name,
    subjects.*,
    marks.*
FROM 
    marks
JOIN 
    student ON marks.student_id = student.id
JOIN 
    subjects ON marks.subject_id = subjects.id
WHERE 
    student.id = ? AND student.year = ?; 
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $symbolNo, $year);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Prepare for student data and subjects
    $studentDetails = null;
    $subjects = [];
    $totalTheory = 0;
    $totalPractical = 0;

    while ($row = $result->fetch_assoc()) {
        if (!$studentDetails) {
            $studentDetails = [
                'id' => $row['id'],
                'name' => $row['student_name'],
                'year' => $row['year']
            ];
        }

        // Initialize or update marks for the subject
        $subjectName = $row['subject_name'];
        if (!isset($subjects[$subjectName])) {
            $subjects[$subjectName] = [
                'theory' => 0,
                'practical' => 0,
            ];
        }

        if (strtolower($row['mode']) === 'theory') {
            $subjects[$subjectName]['theory'] = $row['marks'];
            $totalTheory += $row['marks'];
        } elseif (strtolower($row['mode']) === 'practical') {
            $subjects[$subjectName]['practical'] = $row['marks'];
            $totalPractical += $row['marks'];
        }
    }

    // Display student details once
    // echo '<div class="container">';
    // echo '<h2>Student Details</h2>';
    // echo '<table>';
    // echo '<tr><th>Student ID</th><td>' . $studentDetails['id'] . '</td></tr>';
    // echo '<tr><th>Name</th><td>' . $studentDetails['name'] . '</td></tr>';
    // echo '<tr><th>Year</th><td>' . $studentDetails['year'] . '</td></tr>';
    // echo '</table>';

    echo "
    <div class='student-details'>
        <table>
            <tr><th>Student ID</th><td>".$studentDetails['id']."</td></tr>
            <tr><th>Name</th><td>".$studentDetails['name']."</td></tr>
            <tr><th>Year</th><td>".$studentDetails['year']."</td></tr>
        </table>
    </div>
    <h2>Subjects and Marks</h2>
    <table>
    <tr>
        <th>Subject Name</th>
        <th>Theory</th>
        <th>Practical</th>
        <th>Total Marks</th>
        <th>Result</th>
    </tr>";

    foreach ($subjects as $subjectName => $marks) {
        $totalMarks = $marks['theory'] + $marks['practical'];
        if($marks['theory'] < 24 || $marks['practical'] < 8){
            $resultStatus = "Fail";
            $resultClass = "fail";
        }
        $theoryClass = $marks['theory'] < 24 ? 'fail' : '';
        $practicalClass = $marks['practical'] < 8 ? 'fail' : '';
        $percantage = number_format(floatval(($totalTheory + $totalPractical)/6),2);
   

        echo "
        <tr>
            <td>$subjectName</td>
            <td class='$theoryClass'>" . $marks['theory'] . "</td>
            <td class='$practicalClass'>".$marks['practical']."</td>
            <td>$totalMarks</td>";
            if(!$isPercentageShown){
                global $isPercentageShown;
                $isPercentageShown = true;
            echo "<td rowspan='6'>$percantage %</td>";
            }
        echo "</tr>";
    }

    // Add total theory and practical marks at the bottom
    echo "
    <tr style='font-weight: bold; background-color: #f9f9f9;'>
    <td>Total</td>
    <td>$totalTheory</td>
    <td>$totalPractical</td>
    <td>".($totalTheory + $totalPractical)."</td>
    <td class='$resultClass' rowspan='4'>$resultStatus</td>
    </tr>
    </table>
    <button class='download-result' data-studentid='$symbolNo' data-year='$year'>Download</button>
    </div>";
} else {
    echo "404";
}

$stmt->close();
$conn->close();
?>
