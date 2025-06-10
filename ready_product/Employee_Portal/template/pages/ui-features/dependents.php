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

$sql = $conn -> prepare("SELECT * FROM dependents WHERE dependent_id = ?;");

$sql -> bind_param("i", $employee_id);

$sql_employee = $conn -> prepare("SELECT first_name, last_name FROM employees WHERE employee_id = ?;");

$sql_employee -> bind_param("i", $employee_id);

$sql -> execute();

$result = $sql -> get_result();

if (($result -> num_rows) > 0) 
{
    $pre_data = array();

    while($row = $result -> fetch_assoc()) 
    {
        $pre_data[] = $row;
    }

    $sql_employee -> execute();

    $result_employee = $sql_employee -> get_result();

    $employee_name = array();

    while($row = $result_employee -> fetch_assoc()) 
    {
        $employee_name[] = $row;
    }

    $data = array('information' => $pre_data, 'employee_name' => $employee_name);

    echo json_encode($data);
} 
else 
{
    echo "Error.";
}

$sql -> close();
$sql_employee -> close();
$conn -> close();

?>