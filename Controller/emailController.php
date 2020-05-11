<?php

require_once 'vendor/autoload.php';
require_once 'Controller/constants.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
  ->setUsername(Email)
  ->setPassword(Password)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



       function sendVerificationEmail($userEmail,$token) {
         // Create a message
            global $mailer;
            $body = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>verify emaail</title>
            </head>
            <body>
            <div class="wrapper">
             <p>Thank you for signing up on our website. Please click on the link below to verify your email</p>
             <a href="http://localhost/Logsystem/index.php?token=' .$token.'">Verify your email address</a>
            </div>
            </body>
            </html>';
            $message = (new Swift_Message('Verify your email address'))
            ->setFrom(Email)
            ->setTo($userEmail)
            ->setBody($body,'text/html')
            ;

            // Send the message
            $result = $mailer->send($message);
   }
?>