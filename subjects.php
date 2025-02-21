<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects Information</title>
    <link rel="stylesheet" href="subjects.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php
    include_once "sidebar.php";
    ?>
    <div class="main-content">

    <div class="container">
        <h1>Subjects Information</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th colspan="2">Full Marks</th>
                    <th colspan="2">Pass Marks</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Theory</th>
                    <th>Practical</th>
                    <th>Theory</th>
                    <th>Practical</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Cryptography</td>
                    <td>
                        The study of techniques for secure communication in the presence of adversaries. Topics include encryption, 
                        decryption, digital signatures, and cryptographic protocols to ensure data integrity and confidentiality.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Web Technology</td>
                    <td>
                        Covers modern web development techniques and tools for creating interactive websites. Focuses on HTML, CSS, 
                        JavaScript, backend programming, and frameworks like React or Node.js for full-stack development.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Design Analysis and Algorithm</td>
                    <td>
                        Explores advanced algorithm design and analysis techniques, including dynamic programming, divide-and-conquer, 
                        graph algorithms, and complexity analysis for solving computational problems efficiently.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Simulation and Modelling</td>
                    <td>
                        Focuses on building and analyzing models to simulate real-world systems. Applications include performance 
                        evaluation, system behavior analysis, and decision-making using software tools.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Image Processing</td>
                    <td>
                        Covers methods for processing and analyzing digital images. Topics include image enhancement, segmentation, 
                        feature extraction, and applications in computer vision and multimedia systems.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>System Analysis and Development</td>
                    <td>
                        Introduces methodologies for analyzing, designing, and developing efficient information systems. Focuses on 
                        requirements gathering, system design principles, and software development life cycles.
                    </td>
                    <td>80</td>
                    <td>20</td>
                    <td>32</td>
                    <td>8</td>
                </tr>
            </tbody>
        </table>
        </table>
    </div>
    </div>

</body>

</html>
