<?php


// Create connection
include('db_connect.php');

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
$email = $_POST['email'];
$username = $_POST['username'];
$block = $_POST['blockName'];
$floor = $_POST['floorNumber'];
$room = $_POST['roomNumber'];
$paymentMode = $_POST['payment-mode'];
$productData = json_decode($_POST['product-data'], true);
$quantity = $_POST['quantity'];


//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                          //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'c2ccampus2campus@gmail.com';                     //SMTP username
    $mail->Password   = 'jkqd fwtm snms dlos';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('c2ccampus2campus@gmail.com',);
    $mail->addAddress($email);     //Add a recipient
   
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'confirmation';
    $mail->Body    = "SENDER NAME:".$username." <br>USER- EMAIL:".$email."<br> PRODUCT DETAILS :<br> PRODUCT-NAME::".$productData['name']."PRODUCT-PRICE".$productData['price']."<br>your order is confirmed<br> your order will be delivered within 15 min";
    

    $mail->send();
    echo"mail sent";
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$email = $_POST['email'];
$username = $_POST['username'];
$block = $_POST['blockName'];
$floor = $_POST['floorNumber'];
$room = $_POST['roomNumber'];
$paymentMode = $_POST['payment-mode'];
$productData = json_decode($_POST['product-data'], true);
$quantity = $_POST['quantity'];

// Calculate total price


// Insert order details into the database, including the product image
$sql = "INSERT INTO orderdetails (email, username, blocks, floor, room, product_name, price, quantity, total_price, payment_mode, product_image)
        VALUES ('$email', '$username', '$block', '$floor', '$room', '{$productData['name']}', '{$productData['price']}', '$quantity', '$totalPrice', '$paymentMode', '{$productData['image']}')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    header("Location: total_orders.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
