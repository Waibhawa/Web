<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "result";

$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "Error ". mysqli_connect_error();
}