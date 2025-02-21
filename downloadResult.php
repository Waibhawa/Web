<?php
include_once "database.php";
require 'dompdf/autoload.inc.php'; // Adjust the path to autoload.inc.php as needed

use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $symbolNo = isset($_POST['symbolNo']) ? intval($_POST['symbolNo']) : 0;
    $year = isset($_POST['year']) ? intval($_POST['year']) : 0;

    if ($symbolNo === 0 || $year === 0) {
        die("Invalid input.");
    }

    $sql = "
    SELECT 
        student.id AS student_id,
        student.name AS student_name,
        student.year,
        subjects.name AS subject_name,
        subjects.mode,
        marks.marks
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
        $studentDetails = null;
        $subjects = [];
        $totalTheory = 0;
        $totalPractical = 0;

        while ($row = $result->fetch_assoc()) {
            if (!$studentDetails) {
                $studentDetails = [
                    'id' => $row['student_id'],
                    'name' => $row['student_name'],
                    'year' => $row['year']
                ];
            }

            $subjectName = $row['subject_name'];
            if (!isset($subjects[$subjectName])) {
                $subjects[$subjectName] = ['theory' => 0, 'practical' => 0];
            }

            if (strtolower($row['mode']) === 'theory') {
                $subjects[$subjectName]['theory'] = $row['marks'];
                $totalTheory += $row['marks'];
            } elseif (strtolower($row['mode']) === 'practical') {
                $subjects[$subjectName]['practical'] = $row['marks'];
                $totalPractical += $row['marks'];
            }
        }

        $html = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
                th { background-color: #6f42c1; color: white; }
                .Pass { color: green; font-weight: bold; }
                .Fail { color: red; font-weight: bold; }
            </style>
            <title>Student Result</title>
        </head>
        <body>
            <h1>Student Result</h1>
            <table>
                <tr><th>Student ID</th><td>{$studentDetails['id']}</td></tr>
                <tr><th>Name</th><td>{$studentDetails['name']}</td></tr>
                <tr><th>Year</th><td>{$studentDetails['year']}</td></tr>
            </table>
            <h2>Subjects and Marks</h2>
            <table>
                <tr>
                    <th>Subject Name</th>
                    <th>Theory</th>
                    <th>Practical</th>
                    <th>Total Marks</th>
                    <th>Result</th>
                </tr>";

        $resultStatus = "Pass";
        $rowCount = count($subjects);
        $rowspanAdded = false;

        foreach ($subjects as $subjectName => $marks) {
            $totalMarks = $marks['theory'] + $marks['practical'];
            $theoryClass = $marks['theory'] < 24 ? 'fail' : 'pass';
            $practicalClass = $marks['practical'] < 8 ? 'fail' : 'pass';
            $percantage = number_format(floatval(($totalTheory + $totalPractical) / 6), 2);

            if ($marks['theory'] < 24 || $marks['practical'] < 8) {
                $resultStatus = "Fail";
            }

            $html .= "
                <tr>
                    <td>{$subjectName}</td>
                    <td class='$theoryClass'>" . $marks['theory'] . "</td>
                    <td class='$practicalClass'>".$marks['practical']."</td>
                    <td>{$totalMarks}</td>";

            // Add result percentage cell only once, spanning all rows except the last one
            if (!$rowspanAdded) {
                $html .= "<td class='{$resultStatus}' rowspan='{$rowCount}'>{$percantage}%</td>";
                $rowspanAdded = true;
            }

            $html .= "</tr>";
        }

        $html .= "
            <tr style='font-weight: bold;'><!-- Total row -->
                <td>Total</td>
                <td>{$totalTheory}</td>
                <td>{$totalPractical}</td>
                <td>" . ($totalTheory + $totalPractical) . "</td>
                <td class='$resultStatus'>{$resultStatus}</td>
            </tr>
            </table>
        </body>
        </html>";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Student_Result_{$studentDetails['id']}.pdf", ["Attachment" => true]);
        exit;
    } else {
        echo "No records found.";
    }

    $stmt->close();
    $conn->close();
}
?>
