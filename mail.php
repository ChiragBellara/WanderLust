<?php
$result ="";
require 'PHPMailer/PHPMailerAutoload.php';
$mail =  new PHPMailer;

$mail->Host = 'smtp.gmai.com';
$mail->Port = 587;
$mail->SMTPAuth =true;
$mail->SMTPSecure = 'tls';
$mail->Username = '2016.rajpreetsingh.bhengura@ves.ac.in';
$mail->Password = '##Clementine24033333333##';

$mail->setFrom('2016.rajpreetsingh.bhengura@ves.ac.in');
$mail->addAddress('2016.rajpreetsingh.bhengura@ves.ac.in');


$mail->isHTML(true);
$mail->Subject = 'WanderLust OTP';
$mail->Body = 'code';

if(!$mail->send()){
    $result = "Something went wrong";
    echo $result;
}
else{
    $result = "Done";
    echo $result;
}
?> 