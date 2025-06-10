<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hrms_db";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn -> connect_error) 
    {
        die("Connection failed: " . $conn -> connect_error);
    } 

    /*$sql_1 = "CREATE TABLE roles (
        role_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        role_name VARCHAR(30) NOT NULL,
        permissions VARCHAR(70) NOT NULL
        )";*/

    $sql_2 = "CREATE TABLE applicants (
    application_id INT NOT NULL AUTO_INCREMENT , 
    cv VARCHAR(50) NOT NULL , 
    first_name VARCHAR(100) NOT NULL , 
    last_name VARCHAR(100) NOT NULL , 
    qualifications VARCHAR(150) NOT NULL ,
    skills VARCHAR(80) NOT NULL ,
    expertise VARCHAR(90) NOT NULL ,
    experience INT NULL , 
    email_id VARCHAR(80) NOT NULL , 
    phone_no VARCHAR(20) NOT NULL , 
    application_date DATE NULL , 
    PRIMARY KEY (application_id))";

    if (/*($conn -> query($sql_1) === TRUE) &&*/ ($conn -> query($sql_2) === TRUE))
    {
        echo "Table created successfully";
    } 
    else 
    {
        echo "Error creating tables: " . $conn -> error;
    }

    $conn -> close();

?>