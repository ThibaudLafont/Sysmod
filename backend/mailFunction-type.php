<?php
function envoiMail($senderMail, $senderName, $content){
	//SMTP needs accurate times, and the PHP time zone MUST be set
	//This should be done in your php.ini, but this is how to do it if you don't have access to that
	date_default_timezone_set('Etc/UTC');

	require '../plugin/phpmailer/PHPMailerAutoload.php';

	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "smtp-relay.gmail.com";
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 587;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "noreply@sysmod.fr";
	//Password to use for SMTP authentication
	$mail->Password = "XXXX";
	//Set who the message is to be sent from
	$mail->setFrom('noreply@sysmod.fr', 'Sysmod');
	//Charset
	$mail->CharSet = 'UTF-8';
	//Set who the message is to be sent to
	$mail->addAddress($mailto, $prenom.' '.$nom);
	//Set the subject line
	$mail->Subject = 'Test';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML('
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>Inscription au Famous Ultimate Crash Karaoke</title>
		</head>
		<body>
			Test
		</body>
		</html>
		');
	//Replace the plain text body with one created manually
	$mail->AltBody = 'Test';
	//Attach an image file
	// $mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		//Pb d'envoi du mail
		return false;
		// header('Location: /page/incription_reussie.php?inscri=15');
		// exit();
	} else {
		//redirection si tout s'est bien déroulé
		return true;
		// header('Location: /page/incription_reussie.php?inscri=0');
		// exit();
	}
} //Fin fonction

?>
