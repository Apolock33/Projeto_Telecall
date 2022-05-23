<?php
use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $nome_email, $mensagemHTML) {
    require_once("vendor/autoload.php");
    $email_padrao = 'carlos_martins_75@hotmail.com';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.office365.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = $email_padrao;
    $mail->Password = 'Bio6971@@';

    $mail->SMTPSecure = false;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($email_padrao, $nome_email);
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;


    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        echo "Email enviado com suscesso!";
        return true;
    } else {
        echo "Falha ao envar Email";
        return false;
    }
}
?>