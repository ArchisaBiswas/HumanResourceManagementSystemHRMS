<?php

    /*
    Team Number: 11

    Team Members: Anshaj Ahuja (2141109)
                  Archisa Biswas (2141145)
                  Umaima Parveen Kakamari (2141162)

    Web Technology Program: 5
    Web Technology Program: 7
    */


    // Demonstration of Assignment Operator:

    session_start();

    $servername = "localhost";
    $entrance_username = "root";
    $entrance_password = "";
    $dbname = "hrms_db";

    // Demonstration of Built in Objects in PHP:
    //
    //      Here, mysqli is the Built in Object. It is used to establish a connection with the database.

    $conn = new mysqli($servername, $entrance_username, $entrance_password, $dbname);

    // Demonstration of Arrow Operator:

    if ($conn -> connect_error) 
    {
        die("Connection failed: " . $conn -> connect_error);
    }

    // Demonstration of Built in Objects in PHP:
    //
    //      Here, DateTime is the Built in Object. 
    //      It is used to represent a date and time and 
    //      provides methods for working with dates and times, such as setTimezone and format methods here.

    //$date = new DateTime();

    // Demonstration of Built in Objects in PHP:
    //
    //      Here, DateTimeZone is the Built in Object. 
    //      It is used to represent a time zone and provides methods for working with time zones. 
    //      The Built in Object is passed as a parameter to the setTimezone method here.

    //$date -> setTimezone(new DateTimeZone('Asia/Kolkata'));
    //$dateString = $date -> format('Y-m-d H:i:s');

    // Demonstration of POST:

    if (isset($_POST['submit']))
    {
        if (isset($_POST['user_id']))
        {
            // Demonstration of Built in Objects in PHP:
                //
                //      Here, PDO is the Built in Object. 
                //      It is used to have an interface to hash the provided passwords for the respective usernames.

            $pdo = new PDO('mysql:host=localhost;dbname=hrms_db', $entrance_username, $entrance_password);

            $user_id = $_POST['user_id'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM credentials WHERE user_id = ?";

            $result = $pdo -> prepare($sql);
            $result -> bindParam(1, $user_id);
            $result -> execute();

            // Demonstration of Arrays: 
            //
            //      Here, Assosciative Array is returned and stored in the variable called $username_matched_row_data
            //      and then referenced accordingly to verify the given password with the database.

            $user_id_matched_row_data = $result -> fetch();

            if (password_verify($password, $user_id_matched_row_data['pass_word']))
            {
                $sql_username = "SELECT first_name FROM employees WHERE user_id = ?";
                $result_username = $pdo -> prepare($sql_username);
                $result_username -> bindParam(1, $user_id);
                $result_username -> execute();
                $username_row_data = $result_username -> fetch();

                $_SESSION['user_id'] = $user_id;
                $_SESSION['in_time'] = date("Y-m-d H:i:s");
                $_SESSION['username'] = $username_row_data['first_name']; // Store username in session variable
                $_SESSION['last_activity'] = time();

                if ($user_id_matched_row_data['role_id'] == 1) // Admin
                {
                    header("Location: Admin_Redirect/admin_redirect.php");
                    exit();
                }
                else if ($user_id_matched_row_data['role_id'] == 5) // Employee
                {
                    header("Location: Employee_Portal/template/employee_portal_index.php"); 
                    exit();
                }
                else if ($user_id_matched_row_data['role_id'] == 4) // Manager
                {
                    header("Location: Employee_Portal/template/manager_portal_index.php");
                    exit();
                }

                //echo "Thanks for Logging In. ".$dateString;
            }
            else
            {
                header("Location: index.html");
                echo "Unsuccessful Log In. ".$dateString;
            }
        }
    }
    
    $conn -> close();

?>