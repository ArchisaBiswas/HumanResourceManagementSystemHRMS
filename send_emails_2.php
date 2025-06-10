<?php

    require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';

    // Wrapped PHPMailer.php into phpMailer folder
    require_once 'phpMailer/PHPMailer.php';

    // Using PHPMailer Namespace as specified PHPMailer developers
    use PHPMailer\PHPMailer\PHPMailer;

    $mail = new PHPMailer;

    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = 'true';
    $mail -> Username = 'archisa.biswas@bca.christuniversity.in';
    $mail -> Password = 'biswas123';

    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;

    $mail -> SetFrom('archisa.biswas@bca.christuniversity.in', 'Archisa Biswas');
    $mail -> addAddress('archisab02@gmail.com');

    $mail -> Subject = 'Plis Work, Maybe?';
    $mail -> Body = 'Plis T_T T_T T_T';

    if ($mail -> send())
    {
        echo 'Mail Sent';
    }
    else
    {
        echo "Error";
    }

?>