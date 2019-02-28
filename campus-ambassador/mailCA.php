<?php
	//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if (isset($_POST) && count($_POST)>0 )
{
	$fullName = $_POST['fullName'];
	$custEmail = $_POST['custEmail'];

		//Create a new PHPMailer instance
	$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
	$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
	$mail->SMTPDebug = 0;

//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "regdesk.srijan@iitism.ac.in";

//Password to use for SMTP authentication
	$mail->Password = "Srij@n2O19";

//Set who the message is to be sent from
	$mail->setFrom('regdesk.srijan@iitism.ac.in', 'SRIJAN 2019');

//Set an alternative reply-to address
	$mail->addReplyTo('regdesk.srijan@iitism.ac.in', 'Registration Desk');

//Set who the message is to be sent to
	$mail->addAddress($custEmail, $fullName);

	$mail->Subject = '[SRIJAN 2019] Campus Ambassador - '.$fullName;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
 	$mail->msgHTML(file_get_contents('contents.html'), __DIR__);

//Replace the plain text body with one created manually
	$mail->AltBody = 'Welcome to the Campus Ambassador Programme fro SRIJAN 2019.';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
	if (!$mail->send()) {
    	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
    echo "Message sent!";
	}

}

?>
