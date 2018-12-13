<?php
require 'mail/sendmail.php';

$messageHTML="<p>You have recieved a new message from <strong>InClassDemo</strong></p>
              <p>Here are the details: Hello</p>";

$messageText="You have recieved a new message from InClassDemo\n
              Here are the details: Hello";

/*
 string $replyToEmail, 
 string $replyToName,
 string $mailSubject, 
 string $messageHTML,
 string $messageText,
 string $fromEmail,
 string $fromName, 
 string $toEmail,
 string $toName
 */
$mail= new sendmail('jess.devetest@gmail.com', 'InClassDemo', 'Mail Test', 
                    $messageHTML, $messageText, 'jess.devetest@gmail.com', 
                    'InClassDemo', 'jessrcormier97@gmail.com', 'Jessica Cormier');

//send it
$result=$mail->SendMail();

if($result){
    echo "Message has been sent!";
}else{
    echo "Mail error!". $mail->ErrorInfo();
}
