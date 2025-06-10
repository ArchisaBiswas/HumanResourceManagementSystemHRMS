<?php

    /*
    Team Number: 11

    Team Members: Anshaj Ahuja (2141109)
                  Archisa Biswas (2141145)
                  Umaima Parveen Kakamari (2141162)

    Web Technology Program: 5
    */
    

    // Demonstration of Assignment Operator:

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

    $username = $_POST['username'];
    $password_proposed = $_POST['password2'];
    $password = $_POST['password'];

    // Demonstration of Built in Objects in PHP:
    //
    //      Here, DateTime is the Built in Object. 
    //      It is used to represent a date and time and 
    //      provides methods for working with dates and times, such as setTimezone and format methods here.

    $date = new DateTime();

    // Demonstration of Built in Objects in PHP:
    //
    //      Here, DateTimeZone is the Built in Object. 
    //      It is used to represent a time zone and provides methods for working with time zones.
    //      The Built in Object is passed as a parameter to the setTimezone method here.

    $date -> setTimezone(new DateTimeZone('Asia/Kolkata'));
    $dateString = $date -> format('Y-m-d H:i:s');

    // Demonstration of Inequality Operator:

    if ($password_proposed != $password)
    {
        $output = "Passwords don't match. Try again.";
    }
    else
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $output = "Thanks for Registering. ".$dateString;

        try
        {
            // Demonstration of Built in Objects in PHP:
            //
            //      Here, PDO is the Built in Object. 
            //      It is used to have an interface to hash the provided passwords for the respective usernames.

            $pdo = new PDO('mysql:host=localhost;dbname=hrms_db', $entrance_username, $entrance_password);

            // Demonstration of Arrays: 
            //
            //      Here, Indexed Array is passed as a parameter into the execute method, 
            //      in order to run the MySQL query based on the elements of the passed array.

            $sql = "INSERT INTO credentials (username, pass_word, role_id) VALUES (?, ?, ?)";
            
            $result = $pdo -> prepare($sql);

            $result -> execute(array($username, $hashed_password, "1"));
        }

        // Demonstration of Built in Objects in PHP:
        //
        //      Here, PDOException is the Built in Object. 
        //      It is used to handle any exceptions that might occur with respect to operations that 
        //      utilise the PDO Built in Object in the try block above.

        catch (PDOException $e)
        {
            // Demonstration of Equality Operator:

            if ($e -> getCode() == 23000)
            {
                $output = "Bad. ".$dateString;
            }

            // Demonstration of Less Than Operator:

            // Demonstration of More Than Operator:

            else if (($e -> getCode() < 23000) || ($e -> getCode() > 23000))
            {
                $output = $e -> getMessage();
            }
        }
        finally
        {
            echo $output;
        }
    }

    $conn -> close();

?>