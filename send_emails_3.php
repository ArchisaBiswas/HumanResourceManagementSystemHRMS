<?php

    require("phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php");
    require("phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php");

  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->IsSMTP(); // enable SMTP

  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; // or 587
  $mail->IsHTML(true);
  $mail->Username = "archisa.biswas@bca.christuniversity.in";
  $mail->Password = "biswas123";
  $mail->SetFrom("archisa.biswas@bca.christuniversity.in");
  $mail->Subject = "Test";
  $mail->Body = "hello";
  $mail->AddAddress("archisab02@gmail.com");

   if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   } else {
      echo "Message has been sent";
   }

?>