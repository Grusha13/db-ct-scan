<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id = $_POST['form_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $mail = new PHPMailer(true);

    try {
        // //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication

        $mail->Host = 'smtp.zoho.in';                     //Set the SMTP server to send through
        $mail->Username = 'support@simirahealthcare.com';                     //SMTP username
        $mail->Password = 'NeRqPKwJf0aP';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@simirahealthcare.com', 'Simira');
        $mail->addAddress('support@simirahealthcare.com', 'Appointment Form');     //Add a recipient

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Simi Appointment';

        switch ($form_id) {
            case 'form1':
                $mail->Body = '<h3>Hello you received a new appointment</h3>
                    <p><strong>Name:</strong> ' . $name . '<p>
                    <p><strong>Email:</strong> ' . $email . '</p>
                    <p><strong>Phone Number:</strong> ' . $phone . '</p>
                    <p><strong>Country:</strong> ' . $location . '</p>
                ';
                break;
            case 'form2':
                $mail->Body = '<h3>Hello you received a new appointment</h3>
                    <p><strong>Name:</strong> ' . $name . '<p>
                    <p><strong>Email:</strong> ' . $email . '</p>
                    <p><strong>Phone Number:</strong> ' . $phone . '</p>
                    <p><strong>Country:</strong> ' . $location . '</p>
                ';
                break;
            case 'form3':
                $mail->Body = '<h3>Hello you received a new appointment</h3>
                    <p><strong>Name:</strong> ' . $name . '<p>
                    <p><strong>Email:</strong> ' . $email . '</p>
                    <p><strong>Phone Number:</strong> ' . $phone . '</p>
                    <p><strong>Country:</strong> ' . $location . '</p>
                ';
                break;
        }

        if ($mail->send()) {
            header('Location: thank-you.html');
            exit(0);
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header('Location: index.html');
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }
} else {
    header('Location: index.html');
    exit(0);
}

?>