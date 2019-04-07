<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'mailFunction.php';
require 'templates/templates.php';

$content = 'lorem teauygauza zaiudhiza ud';

// Mail à admin
$mail2 = new PHPMailer(true);
sendMail(
	$mail2,
	'contact@sysmod.fr',
	'Sysmod',
	'Demande de contact - sysmod.fr',
	generateAdminHtmlContent('Thibaud Lafont', 'thibaudlafont@gmail.com', '06 77 61 25 26', $content),
	generateAdminRawContent('Thibaud Lafont', 'thibaudlafont@gmail.com', '06 77 61 25 26', $content));

// Confirmation d'envoi
$mail = new PHPMailer(true);
sendMail(
	$mail, 
	'thibaudlafont@gmail.com', 
	'Thibaud Lafont', 
	'Merci pour votre mail!', 
	generateClientHtmlContent($content), 
	generateClientRawContent($content));
