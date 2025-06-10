<?php

  // Connect to MySQL database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hrms_db";
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Execute query to retrieve data
  $sql1 = "SELECT first_name, last_name, email_id FROM applicants WHERE expertise = 'Programming'";
  $result = $conn->query($sql);

  print_r($result);

  // Convert query result to JSON and return it
  $data = array();
  
  if ($result->num_rows > 0) 
  {
    while($row = $result->fetch_assoc()) 
    {
      $data[] = $row;
    }
  }
  
  echo json_encode($data);

?>
