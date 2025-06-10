<?php

    // Include PHPMailer library
    require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

    // Instantiate PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Set SMTP host, username, password, and port
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'archisa.biswas@bca.christuniversity.in';
    $mail->Password = 'biswas123';
    $mail->Port = 587;

    // Set email content
    $mail->setFrom('archisa.biswas@bca.christuniversity.in', 'Archisa Biswas');
    $mail->Subject = 'Email subject';
    $mail->Body = 'Email content';
    $mail->isHTML(true);

    // Add recipients
    $recipients = array('archisa.biswas@bca.christuniversity.in', 'archisab02@gmail.com');
    foreach ($recipients as $recipient) 
    {
        $mail->addBCC($recipient);
    }

    // Send the email
    if(!$mail->send()) 
    {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else 
    {
        echo 'Message sent!';
    }

?>