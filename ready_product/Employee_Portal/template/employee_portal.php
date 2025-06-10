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

    $average_quarterly_performances = array();

    for($i = 0; $i < 4; $i++)
    {
        $sql = $conn -> prepare("SELECT performance_rate FROM employee_performances WHERE quarter_number = ".strval($i + 1));

        $sql -> execute();

        $result = $sql -> get_result();

        $sum = 0;
        $number_of_records = 0;

        while($row = $result -> fetch_assoc()) 
        {
            $sum = $sum + $row["performance_rate"];
            $number_of_records = $number_of_records + 1;
        }

        $average_quarterly_performances[] = round(($sum / $number_of_records), 1);

        $sql -> close();
    }

    $average_employee_quarterly_performances = array();

    session_start();

    $user_id = intval($_SESSION['user_id']);
    $sql_employee_id = $conn -> prepare("SELECT employee_id FROM employees WHERE user_id = ?");
    $sql_employee_id -> bind_param("i", $user_id);
    $sql_employee_id -> execute();
    $result_employee_id = $sql_employee_id -> get_result();
    $row_employee_id = $result_employee_id -> fetch_assoc();
    $employee_id = $row_employee_id['employee_id'];    

    for($i = 0; $i < 4; $i++)
    {
        $sql = $conn -> prepare("SELECT performance_rate FROM employee_performances WHERE employee_id = ? AND quarter_number = ".strval($i + 1));

        $sql -> bind_param("i", $employee_id);

        $sql -> execute();

        $result = $sql -> get_result();

        while($row = $result -> fetch_assoc()) 
        {
            $average_employee_quarterly_performances[] = $row["performance_rate"];
        }

        $sql -> close();
    }

    $data = array('bar_data' => $average_quarterly_performances, 'line_data' => $average_employee_quarterly_performances);

    //echo $data;

    echo json_encode($data);

    $conn -> close();
?>