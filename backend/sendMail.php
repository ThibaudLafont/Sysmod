<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check nessesary variables
if(!isset($_REQUEST['name']) || is_null($_REQUEST['name']) || empty($_REQUEST['name'])) {
	echo 'Veuillez renseigner un nom';
	die;
} else if(!isset($_REQUEST['mail']) || is_null($_REQUEST['mail']) || empty($_REQUEST['mail'])){
	echo 'Veuillez renseigner un mail';
	die;
} else if(!isset($_REQUEST['content']) || is_null($_REQUEST['content']) || empty($_REQUEST['content'])){
	echo 'Veuillez renseigner un contenu';
	die;
}

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'mailFunction.php';

$content = 'lorem teauygauza zaiudhiza ud';

// Mail à admin
$mail2 = new PHPMailer(true);
$return = sendMail(
	$mail2,
	'contact@sysmod.fr',
	'Sysmod',
	'Demande de contact - sysmod.fr',
	generateAdminHtmlContent($_REQUEST['name'], $_REQUEST['mail'], $_REQUEST['content']),
	generateAdminRawContent($_REQUEST['name'], $_REQUEST['mail'], $_REQUEST['content']));

// Confirmation d'envoi
if($return) {
	$mail = new PHPMailer(true);
	$return = sendMail(
		$mail, 
		$_REQUEST['mail'], 
		$_REQUEST['name'], 
		'Merci pour votre mail!', 
		generateClientHtmlContent($_REQUEST['content']), 
		generateClientRawContent($_REQUEST['content']));
} else {
	$return = 'Erreur serveur durant l\'envoi du mail. Veuillez réessayer plus tard ou nous appeler';
}

if(!$return) {
	$return = 'Erreur durant l\'envoi du mail. Votre mail est-il valide ?';
}

echo $return;
