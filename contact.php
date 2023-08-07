<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Simple spam prevention by limiting the number of messages sent from a single user to 3
    $userEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $messageCount = (int) (isset($_COOKIE[$userEmail]) ? $_COOKIE[$userEmail] : 0);

    if ($messageCount >= 3) {
        http_response_code(400);
        echo "You have reached the message limit. Please contact us through a different method.";
        exit;
    }

    // Increment the message count
    $messageCount++;
    setcookie($userEmail, $messageCount, time() + 86400 * 365); // Store the message count for a year

    // Set up PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'jcytfchurch92@gmail.com';
        $mail->Password = 'txncdnjbiolxvxvs';
        $mail->setFrom('jcytfchurch92@gmail.com', 'JCYTF');
        $mail->addAddress($email); // Replace with the receiver's email address
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nSubject: $subject\n\n$message";

        // Send the email
        $mail->send();

        http_response_code(200);
        echo "success";
    } catch (Exception $e) {
        http_response_code(500);
        echo "An error occurred while sending the email. Please try again later.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>
