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

    $quarter_1 = array();
    $quarter_2 = array();
    $quarter_3 = array();
    $quarter_4 = array();

    $name_labels_1 = array();
    $name_labels_2 = array();
    $name_labels_3 = array();
    $name_labels_4 = array();

    $sql = "SELECT departments.name, department_performances.performance_rate
            FROM departments INNER JOIN department_performances
            ON departments.department_id = department_performances.department_id";

    $result = $conn -> query($sql);

    $department_performances_data = array();
    $department_name_labels = array();

    while($row = $result -> fetch_assoc()) 
    {
        $department_performances_data[] = $row["performance_rate"];
        $department_name_labels[] = $row["name"];
    }

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
        $sql = $conn -> prepare("SELECT employees.first_name, employees.last_name, employee_performances.performance_rate
                                 FROM employees INNER JOIN employee_performances 
                                 ON employees.employee_id = employee_performances.employee_id
                                 WHERE employee_performances.quarter_number = ? 
                                 AND employee_performances.employee_id 
                                 IN (SELECT employee_id FROM employees WHERE manager_id = ?)");

        $quarter_number = $i + 1;

        $sql -> bind_param("ii", $quarter_number, $employee_id);

        $sql -> execute();

        $result = $sql -> get_result();

        if ($i == 0) // Quarter 1
        {
            while($row = $result -> fetch_assoc()) 
            {
                $quarter_1[] = $row["performance_rate"];
                $name_labels_1[] = $row["first_name"] . " " . substr($row["last_name"], 0, 1) . ".";
            }
        }
        else if ($i == 1) // Quarter 2
        {
            while($row = $result -> fetch_assoc()) 
            {
                $quarter_2[] = $row["performance_rate"];
                $name_labels_2[] = $row["first_name"] . " " . substr($row["last_name"], 0, 1) . ".";
            }
        }
        else if ($i == 2) // Quarter 3
        {
            while($row = $result -> fetch_assoc()) 
            {
                $quarter_3[] = $row["performance_rate"];
                $name_labels_3[] = $row["first_name"] . " " . substr($row["last_name"], 0, 1) . ".";
            }
        }
        else // Quarter 4
        {
            while($row = $result -> fetch_assoc()) 
            {
                $quarter_4[] = $row["performance_rate"];
                $name_labels_4[] = $row["first_name"] . " " . substr($row["last_name"], 0, 1) . ".";
            }
        }

        $sql -> close();
    }

    $data = array('quarter1_area_data' => $quarter_1,
                  'quarter2_area_data' => $quarter_2,
                  'quarter3_area_data' => $quarter_3,
                  'quarter4_area_data' => $quarter_4,
                  'labels1_area_data' => $name_labels_1,
                  'labels2_area_data' => $name_labels_2,
                  'labels3_area_data' => $name_labels_3,
                  'labels4_area_data' => $name_labels_4,
                  'doughnut_data' => $department_performances_data,
                  'doughnut_labels' => $department_name_labels);

    echo json_encode($data);

    $conn -> close();
?>