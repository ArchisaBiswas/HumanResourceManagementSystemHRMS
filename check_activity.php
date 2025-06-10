<?php

    session_start();

    // Check for a GET request
    if (($_SERVER['REQUEST_METHOD'] == 'GET') || ($_SERVER['REQUEST_METHOD'] == 'POST'))
    {
        // Update the last activity time in the session
        $_SESSION['last_activity'] = time();

        // Check if the user has been inactive for 1 hour
        $inactive_timeout = 60 * 60; // 1 hour in seconds
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] >= $inactive_timeout)) 
        {
            // Destroy the session and redirect the user to the login page
            session_unset();
            session_destroy();
            header("Location: index.html");
            exit();
        }
    }

?>