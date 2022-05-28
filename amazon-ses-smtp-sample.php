<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$sender = "nuuuukemw@gmail.com";
$senderName = "Kenshiro KING Ata";

$recipient = "bugattiveyroooone@icloud.com";

$userNameSmtp = "AKIA3XURWB5YWEV5LGVG";
$passwordSmtp = "BMPFpWoJf/lG9A9c3uJ2PECcPNUsklVVV0c8+CAYuECu";

// $configuretionSet = "ConfigSet";

$host = "email-smtp.us-east-1.amazonaws.com";
$port = 587;

$subject = 'Amazon SES test (SMTP interface accessed using PHP)';

$bodyText =  "Email Test\r\nThis email was sent through the
    Amazon SES SMTP interface using the PHPMailer class.";

$bodyHtml = '<h1>Email Test</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>';

$mail = new PHPMailer(true);

try {
    // specify the smtp setting
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username = $userNameSmtp;
    $mail->Password = $passwordSmtp;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configuretionSet);

    $mail->addAddress($recipient);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $bodyHtml;
    $mail->AltBody = $bodyText;
    $mail->Send();
    echo 'Email sent!', PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error ocurred. {$e->errorMessage()}", PHP_EOL;
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL;
}

?>




