<?php
include "database.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."';";
    $result =  mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            echo "success";
        }
}else{
    echo "error";
}
