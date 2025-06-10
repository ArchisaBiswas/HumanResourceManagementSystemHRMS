<?php

    /*
    Team Number: 11

    Team Members: Anshaj Ahuja (2141109)
                  Archisa Biswas (2141145)
                  Umaima Parveen Kakamari (2141162)

    Web Technology Program: 5
    Web Technology Program: 7
    */


    // Demonstration of Sessions:

    session_start();

    if (isset($_SESSION['username']))
    {
        header('Location: home.html');
        exit;
    }

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

    // Demonstration of POST:

    if (isset($_POST['submit']))
    {
        if (isset($_POST['username']))
        {
            // Demonstration of Built in Objects in PHP:
                //
                //      Here, PDO is the Built in Object. 
                //      It is used to have an interface to hash the provided passwords for the respective usernames.

            $pdo = new PDO('mysql:host=localhost;dbname=hrms_db', $entrance_username, $entrance_password);

            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM credentials WHERE username = ?";

            $result = $pdo -> prepare($sql);
            $result -> bindParam(1, $username);
            $result -> execute();

            // Demonstration of Arrays: 
            //
            //      Here, Assosciative Array is returned and stored in the variable called $username_matched_row_data
            //      and then referenced accordingly to verify the given password with the database.

            $username_matched_row_data = $result -> fetch();

            if (password_verify($password, $username_matched_row_data['pass_word']))
            {
                echo "Thanks for Logging In. ".$dateString;

                $_SESSION['username'] = $username;

                // Demonstration of Cookies:

                setcookie('login_status', 'logged_in', time() + 3600, '/');

                header('Location: play_area/interview_scheduling.html');

                exit;
            }
            else
            {
                echo "Unsuccessful Log In. ".$dateString;
            }
        }
    }
    
    $conn -> close();

?>