<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Function to set data and send email
function setData($subject, $body, $toEmail, $toName)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        // Your Gmail credentials
        $mail->Username = 'pugaromanagementsystem@gmail.com';
        $mail->Password = 'bhelwroaouuhhzyi';


        // Sender and recipient settings
        $mail->setFrom('pugaromanagementsystem@gmail.com', 'Pugaro Management');

        $mail->addAddress($toEmail, $toName);
        
        $mail->addReplyTo('pugaromanagementsystem@gmail.com', 'Pugaro Management'); // Set the reply-to address


        // Setting the email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send email
        $mail->send();
    } catch (Exception $e) {
        // Log the error instead of echoing it
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        echo "Error: {$mail->ErrorInfo}";
    }
}

// Call the function with test data
setData('Test', 'Test Email', 'recipient-email@gmail.com', 'Recipient Name');

