<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password); // or, can use mysqli_connect which is a method, 
                                                           // therefore no ew keyword also required to use it

    if ($conn -> connect_error) 
    {
        die("Connection failure: ". $conn -> connect_error);
    }

    $sql = "CREATE DATABASE hrms_db";

    if ($conn -> query($sql) === TRUE) 
    {
        echo "Database with name hrms_db created.";
    } 
    else 
    {
        echo "Error: " . $conn -> error;
    }

    $conn -> close();
    
?>
