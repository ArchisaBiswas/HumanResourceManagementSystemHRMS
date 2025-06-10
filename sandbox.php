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

    $department = trim($_POST['department']);
    //$department="IT";
    //echo $department;
    // echo $department;
    //$department = "IT";
    //$department = "IT";
    // $sql_department_query = "SELECT department_id FROM departments WHERE name = ?";
    $sql_department_query = "SELECT department_id FROM departments WHERE name = $department";

    $sql_department = $conn -> prepare($sql_department_query);
    // echo var_dump($sql_department);
    // $sql_department -> bind_param('s', $department);
    //$sql_department -> bind_param('s', $department);
    // echo var_dump($sql_department);
    // echo $sql_department;
    $sql_department -> execute();
    $result_department = $sql_department -> get_result();

    //echo $sql_department_query_substituted;
    //echo $sql_department_query;
    
    $row = $result_department -> fetch_assoc();
    echo $row['department_id'];
    // echo $row['name_2'].'<br>';
    // echo var_dump($sql_department);
    // echo json_encode($row);
    // echo $result_department -> num_rows;
    //$department_id = $row["department_id"];

    //echo $department_id;
    $sql_department -> close();
    $conn -> close();
?>