
<?php 

$info["name"] = $email;
$info["subject"] = $subject;
$info["message"] = $message;
$info["header"] = $headers;


$mail_template = file_get_contents("templates/resetpwd-template.php");

foreach ($info as $key => $value) {

   $mail_template = str_replace('{{'.$key.'}}', $value, $mail_template);

}

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//require '../vendor/autoload.php';

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 3;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;



//Whether to use SMTP authentication
$mail->SMTPAuth = true;
$mail->Username = 'travo.edward@gmail.com';
$mail->Password = file_get_contents("../../password.txt");
$mail->setFrom('travo.edward@gmail.com', 'Travis Laptop');
$mail->addAddress('traviszedward@gmail.com', 'Travis Edward');
$mail->Subject = ' TESTING PHPMailer GMail SMTP test';
$mail->msgHTML($mail_template);



$mail->AltBody = 'This is a plain-text message body';
$mail->addAttachment('images/phpmailer_mini.png');
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
