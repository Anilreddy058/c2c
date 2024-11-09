<?php
if(isset($_POST['send']))
{
    $email = $_POST['email'];
$username = $_POST['username'];
$block = $_POST['blockName'];
$floor = $_POST['floorNumber'];
$room = $_POST['roomNumber'];
$paymentMode = $_POST['payment-mode'];
$productData = json_decode($_POST['product-data'], true);
$quantity = $_POST['quantity'];
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                          //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'maxm67939@gmail.com';                     //SMTP username
    $mail->Password   = 'qolc pvtb jfxj cthq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('maxm67939@gmail.com', 'Mad Max');
    $mail->addAddress('anilkumarreddy.thatireddy@gmail.com', 'Anil kumar Reddy');     //Add a recipient
   
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'confirmation';
    $mail->Body    = 'sender Name-$name <br> sender email- $email<br> message-$msg';
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
