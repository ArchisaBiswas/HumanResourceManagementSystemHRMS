<?php

    //session_start();

    //include '../../check_activity.php';

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

    $quarter = $_POST['quarter'];

    $ratings_array = explode(";", $_POST['ratings']);
    $ratings = array();

    foreach ($ratings_array as $ratings_string)
    {
        $ratings = array_merge($ratings, explode(",", $ratings_string));
    }

    $sql = $conn -> prepare("SELECT employee_id FROM employees");

    $sql -> execute();

    $result = $sql -> get_result();

    $i = 0;

    $check = true;

    while($row = $result -> fetch_assoc()) 
    {
        $sql_insertion = $conn -> prepare("INSERT INTO employee_performances (employee_id, quarter_number, performance_rate) VALUES (?, ?, ?)");

        $sql_insertion -> bind_param("iii", $row['employee_id'], $quarter, $ratings[$i]);
        
        if($sql_insertion -> execute())
        {
            $check = true;
        }
        else
        {
            $check = false;
        }
        
        $i++;
    }

    echo json_encode($check);
    
    $sql -> close();
    $sql_insertion -> close();
    $conn -> close();
?>