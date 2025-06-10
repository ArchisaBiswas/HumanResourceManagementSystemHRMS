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

    // Create sessions/remember username and fetch employee id? fix that for this WHERE filter below:

    $sql = $conn -> prepare("SELECT paid_leaves_permitted, salary_per_day FROM leaves WHERE employee_id = 5");

    $GLOBALS['number_of_days'] = $_GET['number_of_days'];

    $sql -> execute();

    $result = $sql -> get_result();

    if (($result -> num_rows) > 0) 
    {
        $row = $result -> fetch_assoc();

        if ($GLOBALS['number_of_days'] > $row['paid_leaves_permitted'])
        {
            echo "This leave application crosses your number of paid leaves permitted. The salary that will be deducted 
                  on taking this leave will be Rs. " . 
                  ($row['salary_per_day'] * ($GLOBALS['number_of_days'] - $row['paid_leaves_permitted'])) . 
                  ". If you agree to take this leave, please click yes below. Otherwise, please click no. Thank you.";
        }
        else
        {
            echo "Granted";
        }
    }

    $sql -> close();
    $conn -> close();

    if (isset($_GET['function']) && $_GET['function'] === 'updateLeaves') 
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hrms_db";
      
        $number_of_days = $_GET['number_of_days'];
      
        $conn = new mysqli($servername, $username, $password, $dbname);
      
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn -> connect_error);
        }

        $sql_update = $conn -> prepare("UPDATE leaves SET leaves_taken = ? WHERE employee_id = 5");

        $sql_update -> bind_param("i", $number_of_days);

        if ($sql_update -> execute() === TRUE) 
        {
            echo "1";
        } 
        else 
        {
            echo "Error updating leaves taken: " . $conn -> error;
        }

        $sql_update->close();
        $conn->close();
    }
?>