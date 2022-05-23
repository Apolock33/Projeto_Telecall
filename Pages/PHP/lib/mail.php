<?php
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'carlos_martins_75@hotmail.com';
$mail->Password = 'Bio6971@@';

$mail->SMTPSecure = false;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

$mail->setFrom('carlos_martins_75@hotmail.com', "Teste Carlos Mailer");
$mail->addAddress("carlosammgomes@gmail.com");
$mail->Subject = 'E-mail de teste';


$mail->Body = "<h1>Email enviado com suscesso!</h1>";

if ($mail->send()) {
    echo "Email enviado com suscesso!";
} else {
    echo "Falha ao envar Email";
}
?>