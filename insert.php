<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hrms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn -> connect_error) 
    {
        die("Connection failed: " . $conn -> connect_error);
    }

    $fname="Archisa";
    $sname="Biswas";
    $email="archisa.biswas@bca.christuniversity.in";
    
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