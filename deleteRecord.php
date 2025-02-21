<?php
include "database.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $studentId = $_POST['studentId'];
    $sql = "DELETE FROM student WHERE id = $studentId;";
    $result =  mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            echo "success";
        }
}else{
    echo "error";
}
