<?php

    /*
    Team Number: 11

    Team Members: Anshaj Ahuja (2141109)
                  Archisa Biswas (2141145)
                  Umaima Parveen Kakamari (2141162)

    Web Technology Program: 5
    Web Technology Program: 7
    */


    // Demonstration of GET:

    // Demonstration of Sessions:

    // Demonstration of Cookies:

    if (isset($_GET['logout']))
    {
        session_destroy();

        setcookie('login_status', '', time() - 3600, '/');

        header('Location: login.html');

        exit;
    }

?>