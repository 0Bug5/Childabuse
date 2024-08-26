<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";


function emailSend($receiver, $subject, $body, $project = "INFORMATION SYSTEM FOR HUMAN RIHGT BASED ORGANISATION")
{

    try{
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Mailer = "smtp";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth   = true;
        $mail->Username = "nafiumohammed370@gmail.com";
        $mail->Password = "fkzrdoycnaxzhnvb";
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;

        $mail->setFrom("hris@gmail.com");
        $mail->addAddress($receiver);
    
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body."<br><br><center><code>".$project."</code></center>";
    
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }catch(Exception $exception){
        return false;
    }
    
}
