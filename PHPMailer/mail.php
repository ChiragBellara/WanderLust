<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($otp,$email){
    
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function


    //Load Composer's autoloader
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        //Server settings
        $mail->SMTPDebug = false;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '2016.rajpreetsingh.bhengura@ves.ac.in';                 // SMTP username
        $mail->Password = '`';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('2016.rajpreetsingh.bhengura@ves.ac.in', 'WanderLust');

        $mail->addAddress($email, 'Wanderer');     // Add a recipient
        
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'WanderLust Code';
        $mail->Body    = "Your Code Is <b>$otp</b>";
        // $mail->SMTPDebug  = 2; 
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
        if(!$mail->send()){
            echo "<script>
                alert('Please Enter Vaild Email');
                window.location.href='login.php';
                </script>";
        
    } 
    
}

?>