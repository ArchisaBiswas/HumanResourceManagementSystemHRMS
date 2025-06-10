<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hrms_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn -> connect_error) 
    {
        die("Connection failed: " . $conn -> connect_error);
    }

    session_start();

    $sql = $conn -> prepare("INSERT INTO sessions (user_id, in_time, out_time) VALUES (?, ?, ?)");

    $out_time = date("Y-m-d H:i:s");

    $sql -> bind_param("iss", $_SESSION['user_id'], $_SESSION['in_time'], $out_time);

    $sql -> execute();
    
    session_unset();
    session_destroy();
    header("Location: ../../login_index.html"); // redirect to login page
    exit;

?>
