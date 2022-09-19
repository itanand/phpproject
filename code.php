<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function sendemail_verify($name, $email, $verify_token)
  {
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;              //Enable SMTP authentication

    $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
    $mail->Username   = "webshilla141@gmail.com";                     //SMTP username
    $mail->Password   = "Anandm8877";


    $mail->SMTPSecure = "tls";        //Enable implicit TLS encryption
    $mail->Port = 587;

    $mail->setFrom("webshilla141@gmail.com", $name);
    $mail->addAddress($email);


    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Email Verification From Webshilla";

    $email_template =
    "<h2>You have Registered with Webshilla</h2>
    <h5>Verify Your email address to login with the below given link</h5>
    <br/><br/>
    <a href='http://127.0.0.1/phpproject/verify-email.php?token=$verify_token'>Click Me</a>";

    $mail->Body = $email_template;
    $mail->send();

    echo 'Message has been sent';
  }

  if(isset($_POST['register_btn']))
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $verify_token = md5(rand());

    sendemail_verify("$name", "$email", "$verify_token");



    // //Email Exist or Not
    // $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    // $check_email_query_run= mysqli_query($con, $check_email_query);

    // if(mysqli_num_rows($check_email_query_run)>0)
    // {
    //     $_SESSION['status'] = "Email Id Already Exists";
    //     header("location: register.php");
    // }
    // else
    // {
    //    $query = "INSERT INTO users (name, email, phone, password, verify_token) VALUES ('$name', '$email', '$phone', '$password', '$verify_token')";
    //    $query_run = mysqli_query($con, $query);

    //    if($query_run)
    //    {

    //     sendemail_verify("$name", "$email", "$verify_token");

    //     $_SESSION['status'] = "Registration Successful.! Please Verify Your Email Address ";
    //     header("location: register.php");
    //    }
    //    else
    //    {
    //     $_SESSION['status'] = "Registration Failed";
    //     header("location: register.php");
    //    }
    // }
  }

?>