<?php

session_start();

//include '../../../../check_activity.php';

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

$user_id = intval($_SESSION['user_id']);
$sql_employee_id = $conn -> prepare("SELECT employee_id FROM employees WHERE user_id = ?");
$sql_employee_id -> bind_param("i", $user_id);
$sql_employee_id -> execute();
$result_employee_id = $sql_employee_id -> get_result();
$row_employee_id = $result_employee_id -> fetch_assoc();
$employee_id = $row_employee_id['employee_id'];

$sql = $conn -> prepare("SELECT employees.*, departments.name, designations.designation
                         FROM ((employees INNER JOIN departments ON employees.department_id = departments.department_id)
                         INNER JOIN designations ON employees.designation_id = designations.designation_id)
                         WHERE employees.employee_id = ?");

$sql -> bind_param("i", $employee_id);

$sql_manager = $conn -> prepare("SELECT first_name, last_name
                                 FROM employees 
                                 WHERE employee_id = (SELECT manager_id FROM employees WHERE employee_id = ?);");

$sql_manager -> bind_param("i", $employee_id);

$sql -> execute();

$result = $sql -> get_result();

if (($result -> num_rows) > 0) 
{
    $pre_data = array();

    while($row = $result -> fetch_assoc()) 
    {
        $pre_data[] = $row;
    }

    $sql_manager -> execute();

    $result_manager = $sql_manager -> get_result();

    $manager_data = array();

    while($row = $result_manager -> fetch_assoc()) 
    {
        $manager_data[] = $row;
    }

    $data = array('information' => $pre_data, 'manager' => $manager_data);

    echo json_encode($data);
} 
else 
{
    echo "Error.";
}

$sql -> close();
$sql_manager -> close();
$conn -> close();

?>