<?php

    //session_start();

    //include '../../../../check_activity.php';

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

    $data = array();

    session_start();

    $user_id = intval($_SESSION['user_id']);
    $sql_employee_id = $conn -> prepare("SELECT employee_id FROM employees WHERE user_id = ?");
    $sql_employee_id -> bind_param("i", $user_id);
    $sql_employee_id -> execute();
    $result_employee_id = $sql_employee_id -> get_result();
    $row_employee_id = $result_employee_id -> fetch_assoc();
    $employee_id = $row_employee_id['employee_id'];    

    // manager_id filter below will be whoever is currently logged in
    $sql = $conn -> prepare("SELECT employee_id, first_name, last_name, email_id FROM employees WHERE manager_id = ?");

    $sql -> bind_param("i", $employee_id);

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