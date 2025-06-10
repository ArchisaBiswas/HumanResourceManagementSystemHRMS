<?php

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "hrms_db";

    // Connect to the database
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check for errors
    if ($conn -> connect_error) 
    {
        die('Failed to connect to MySQL: ' . $conn -> connect_error);
    }

    // Retrieve the form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $phno = trim($_POST['phno']);
    $homeno = trim($_POST['homeno']);
    $startdate = trim($_POST['startdate']);
    $role = trim($_POST['role']);
    $qualifications = trim($_POST['qualifications']);
    $skills = trim($_POST['skills']);
    $building_name = trim($_POST['building_name']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $zipcode = trim($_POST['zipcode']);
    $department = trim($_POST['department']);
    $designation = trim($_POST['designation']);
    $manager_fname = trim($_POST['manager_fname']);
    $manager_lname = trim($_POST['manager_lname']);
    $password = trim($_POST['password']);

    $sql_department_query = "SELECT department_id FROM departments WHERE name = ?";
    $sql_department = $conn -> prepare($sql_department_query);
    $sql_department -> bind_param('s', $department);
    $sql_department -> execute();
    $result_department = $sql_department -> get_result();
    $row = $result_department -> fetch_assoc();
    $department_id = $row["department_id"];

    $sql_designation_query = "SELECT designation_id FROM designations WHERE designation = ?";
    $sql_designation = $conn -> prepare($sql_designation_query);
    $sql_designation -> bind_param('s', $designation);
    $sql_designation -> execute();
    $result_designation = $sql_designation -> get_result();
    $row = $result_designation -> fetch_assoc();
    $designation_id = $row["designation_id"];

    $sql_manager_query = "SELECT employee_id FROM employees WHERE first_name = ? AND last_name = ?";
    $sql_manager = $conn -> prepare($sql_manager_query);
    $sql_manager -> bind_param('ss', $manager_fname, $manager_lname);
    $sql_manager -> execute();
    $result_manager = $sql_manager -> get_result();
    $row = $result_manager -> fetch_assoc();
    $manager_id = $row["employee_id"];
    
    $formatted_startdate = date('Y-m-d', strtotime($startdate));
    $formatted_dob = date('Y-m-d', strtotime($dob));

    $birthdate = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($dob)));
    $today = new DateTime();
    $interval = $today -> diff($birthdate);
    $age = $interval -> y;

    $start_date = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($startdate)));
    $today = new DateTime();
    $interval = $today -> diff($start_date);
    $experience = $interval -> y;

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role_id;

    if($role == "Admin")
    {
        $role_id = 1;
    }
    else if($role == "Managers")
    {
        $role_id = 4;
    }
    else if($role == "Employees")
    {
        $role_id = 5;
    }

    $sql_credentials = $conn -> prepare("INSERT INTO credentials (username, pass_word, role_id) VALUES (?, ?, ?)");
    $sql_credentials -> bind_param('ssi', $username, $hashed_password, $role_id);
    $sql_credentials -> execute();

    // Insert the data into the database
    $sql = "INSERT INTO `employees` (`employee_id`, `department_id`, `designation_id`, `first_name`, `last_name`, 
                                     `email_id`, `ph_no`, `home_ph_no`, `qualifications`, `skills`, `start_date`, 
                                     `experience_in_company`, `date_of_birth`, `age`, `building_name`, `city`, 
                                     `country`, `zipcode`, `gender`, `manager_id`) 
            VALUES 
            (NULL, '$department_id', '$designation_id', '$fname', '$lname', '$email', '$phno', '$homeno', 
             '$qualifications', '$skills', '$formatted_startdate', '$experience', '$formatted_dob', '$age',
             '$building_name', '$city', '$country', '$zipcode', '$gender', '$manager_id')";

    if ($conn -> query($sql) === true)
    {
        echo 'Data inserted successfully';
    } 
    else 
    {
        echo 'Error: ' . $conn->error;
    }

    // Close the database connection
    $conn -> close();

?>
