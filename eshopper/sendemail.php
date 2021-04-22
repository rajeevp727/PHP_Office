<?php
use PHPMailer\PHPMailer;
use PHPMailer\Exception;
require_once "PHPMailer/PHPMailerAutoload.php";

$mail= new PHPMailer(true);
$mail->isSMTP();
$ail->SMTPAuth =    true;
$mail->SMTPSecure = "tls";
$mail->Host="smtp.gmail.com";
$mail->Port="587";
$mail->isHTML();
$mail->Username= @trim(stripslashes($_POST['email']));
$mail->Password = "Raj@eev_727";
$mail->SetFrom("no-reply@helloWorld.com");
$mail->Subject = "demo mail";
$mail->Body = "This is a demo mail";
$mail->AddAddress("mrrajeev18@gmail.com");
$mail->Send();
	// header('Content-type: application/json');
	// $status = array(
	// 	'type'=>'success',
	// 	'message'=>'Thank you for contact us. As early as possible  we will contact you '
	// );

    // $name       = @trim(stripslashes($_POST['name'])); 
    // $email      = @trim(stripslashes($_POST['email'])); 
    // $subject    = @trim(stripslashes($_POST['subject'])); 
    // $message    = @trim(stripslashes($_POST['message'])); 

    // $email_from = $email;
    // $email_to = 'mrrajeev18@email.com';//replace with your email

    // $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

    // $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    // echo json_encode($status);
    // die;