<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'jessrcormier97@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_htmlbody = "<p>You have received a new message from your website contact form.</p><p>Here are the details:</p><p>Name: $name</p><p>Email: $email_address</p><p>Phone: $phone</p><p>Message:</p><p>$message</p>";
$email_textbody = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";

require 'sendmail.php';

$mail = new sendmail('jess.devetest@gmail.com', 'InClassDemo', $email_subject, 
                    $email_htmlbody, $email_textbody, 'jess.devetest@gmail.com', 
                    'InClassDemo', $to, 'Jessica Cormier');

//send it
$result=$mail->SendMail();

if($result){
    return true;
}else{
    return false;
}
