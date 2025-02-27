<?php

$to = "yameki4361@bnsteps.com";
$subject = "Test Email";
$message = "Hello, this is a test email sent from PHP.";
$headers = "From: sender@example.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";

    error_log("Mail function failed!", 0);
}
