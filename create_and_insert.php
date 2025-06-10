<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password);

    if ($conn -> connect_error) 
    {
        die("Connection failure: ". $conn->connect_error);
    }

    $sql = "CREATE DATABASE university";

    if ($conn -> query($sql) === TRUE) 
    {
        echo "Database with name university created.";
    } 
    else 
    {
        echo "Error: " . $conn -> error;
    }

    $conn -> close();

    $dbname = "university";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn -> connect_error) 
    {
        die("Connection failed: " . $conn -> connect_error);
    } 

    $sql = "CREATE TABLE Student (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";

    if ($conn -> query($sql) === TRUE) 
    {
        echo "Table Student created successfully";
    } 
    else 
    {
        echo "Error creating table: " . $conn -> error;
    }

    $fname = $_GET["first_name"];
    $sname = $_GET["last_name"];
    $email = $_GET["email"];
    
    $sql = "INSERT INTO student (firstname, lastname, email)
            VALUES ('$fname', '$sname', '$email')";

    if ($conn -> query($sql) === TRUE) 
    {
        echo "New record created successfully";
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn -> error;
    }

    $conn -> close();

?>  