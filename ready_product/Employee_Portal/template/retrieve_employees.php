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

    $user_id = intval($_SESSION['user_id']);

    $data = array();

    $sql = $conn -> prepare("SELECT employee_id, first_name, last_name FROM employees WHERE manager_id 
                            = (SELECT employee_id FROM employees WHERE user_id = $user_id)");

    $sql -> execute();

    $result = $sql -> get_result();

    while($row = $result -> fetch_assoc()) 
    {
        $data[] = $row;
    }

    echo json_encode($data);
    
    $sql -> close();
    $conn -> close();
?>