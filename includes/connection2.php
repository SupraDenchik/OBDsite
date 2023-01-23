<?php 

    $servername = "localhost";
    $database = "apteka_es";
    $username = "root";
    $password = "";


    $conn = mysqli_connect("$servername", $username, $password, $database);

    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    } 
    
?>