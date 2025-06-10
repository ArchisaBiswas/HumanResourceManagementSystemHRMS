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
    
    $skills = $_GET['skills'];
    $experience = $_GET['experience'];
    $qualifications = $_GET['qualifications'];
    $offering_salary = $_GET['offering_salary'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    
    $num_qualifications = str_word_count($qualifications);

    $qualifications_array = array();

    for ($i = 0; $i < $num_qualifications; $i++)
    {
        if ($i == ($num_qualifications - 1))
        {
            $qualifications_array[] = "'".$qualifications."'";
        }
        else
        {
            $index_of_whitespace = strpos($qualifications, " ");
            $qualifications_array[] = "'".substr($qualifications, 0, ($index_of_whitespace - 1))."'";

            $qualifications = substr($qualifications, ($index_of_whitespace + 1), strlen($qualifications));
        }
    }
    
    if (($from == "") && ($to == ""))
    {
        $sql1 = $conn -> prepare("SELECT first_name, last_name, email_id, phone_no 
                                  FROM benched
                                  WHERE skills = ? AND experience >= ? AND expected_salary <= ? 
                                  AND qualifications IN (".implode(",", $qualifications_array).")");

        $sql1 -> bind_param("sid", $skills, $experience, $offering_salary);

        $sql1 -> execute();

        $result1 = $sql1 -> get_result();

        if (($result1 -> num_rows) > 0) 
        {
            $data = array();

            while($row = $result1 -> fetch_assoc()) 
            {
                $data[] = $row;
            }

            echo json_encode($data);

            $sql1 -> close();
        }
        else
        {
            echo "None available that match the provided filters at the moment.";
        }
    }
    else
    {
        $sql1 = $conn -> prepare("SELECT first_name, last_name, email_id, phone_no 
                                  FROM benched
                                  WHERE skills = ? AND experience >= ? AND expected_salary >= ? AND expected_salary <= ?
                                  AND qualifications IN (".implode(",", $qualifications_array).")");

        $sql1 -> bind_param("sidd", $skills, $experience, $from, $to);

        $sql1 -> execute();

        $result1 = $sql1 -> get_result();

        if (($result1 -> num_rows) > 0) 
        {
            $data = array();

            while($row = $result1 -> fetch_assoc()) 
            {
                $data[] = $row;
            }

            echo json_encode($data);

            $sql1 -> close();
        }
        else
        {
            echo "None available that match the provided filters at the moment.";
        }
    }
?>