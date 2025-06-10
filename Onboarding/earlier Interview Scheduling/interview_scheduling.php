    <?php

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

        $sql_applicants = $conn -> prepare("SELECT first_name, last_name, email_id FROM applicants WHERE expertise = ?");

        $expertise = $_GET['expertise'];
        $interviewing_experience = $_GET['interviewing_experience'];
        $num_interviewers = $_GET['num_interviewers'];

        $sql_applicants -> bind_param("s", $expertise);

        $sql_applicants -> execute();

        $result1 = $sql_applicants -> get_result();

        if (($result1 -> num_rows) > 0) 
        {
            $sql2 = $conn -> prepare("SELECT employees.first_name, employees.last_name, employees.email_id, employees.experience_in_company, employees.qualifications
                                      FROM employees INNER JOIN interviewers 
                                      ON employees.employee_id = interviewers.employee_id
                                      WHERE expertise = ?");

            // Applicant SQL executing
            $sql2 -> bind_param("s", $expertise);

            $sql2 -> execute();

            $result2 = $sql2 -> get_result();

            if (($result2 -> num_rows) > $num_interviewers)
            {
                $applicants_data = array();

                while($row = $result1 -> fetch_assoc()) 
                {
                    $applicants_data[] = $row;
                }
                
                $sql3 = $conn -> prepare("SELECT employees.first_name, employees.last_name, employees.email_id, employees.experience_in_company, employees.qualifications
                                          FROM employees INNER JOIN interviewers 
                                          ON employees.employee_id = interviewers.employee_id
                                          WHERE expertise = ? AND interviewing_experience >= ?
                                          LIMIT ?");

                $sql3 -> bind_param("sii", $expertise, $interviewing_experience, $num_interviewers);

                $sql3 -> execute();

                $result3 = $sql3 -> get_result();
                        
                $interviewers_data = array();
  
                if (($result3 -> num_rows) > 0) 
                {
                    while($row = $result3 -> fetch_assoc()) 
                    {
                        $interviewers_data[] = $row;
                    }
                }

                $data = array('applicants' => $applicants_data, 'interviewers' => $interviewers_data);

                echo json_encode($data);

                $sql3 -> close();
            }
            else if (($result2 -> num_rows) == $num_interviewers)
            {
                $applicants_data = array();

                while($row = $result1 -> fetch_assoc()) 
                {
                    $applicants_data[] = $row;
                }
                
                $interviewers_data = array();
                
                while($row = $result2 -> fetch_assoc()) 
                {
                    $interviewers_data[] = $row;
                }
                
                $data = array('applicants' => $applicants_data, 'interviewers' => $interviewers_data);

                echo json_encode($data);
                
                $sql2 -> close();
            }
            else
            {
                $output = "Desired Number of Interviewers unavailable.";
                echo $output;
            }      
        } 
        else 
        {
            $output = "Sorry, no Applicants of the desired Expertise have applied at the moment.";
            echo $output;
        }

        $sql_applicants -> close();
        $conn -> close();
    ?>