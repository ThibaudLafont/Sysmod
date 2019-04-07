<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'mailFunction.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
sendMail($mail, 'thibaudlafont@gmail.com', 'Thibaud Lafont', 'Lalala');