<?php
require_once "recaptcha/autoload.php";
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');

$Recipient = 'set_your_email_here@domain.com'; // <-- Set your email here

// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "";
$secret = "";

// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "en";

// Was there a reCAPTCHA response?
if (isset($_POST['g-recaptcha-response'])) {
	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
}

if($Recipient && $resp->isSuccess()) {

	$Name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$Email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$Subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
	$Message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	if (isset($_POST['guests'])) {
		$Guests = filter_var($_POST['guests'], FILTER_SANITIZE_STRING);
	} else {
		$Guests = "";
	}
	if (isset($_POST['events'])) {
		$Events = filter_var($_POST['events'], FILTER_SANITIZE_STRING);
	} else {
		$Events = "";
	}
	if (isset($_POST['category'])) {
		$Category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
	} else {
		$Category = "";
	}

	$Email_body = "";
	$Email_body .= "From: " . $Name . "\n" .
				   "Email: " . $Email . "\n" .
				   "Subject: " . $Subject . "\n" .
				   "Message: " . $Message . "\n" .
				   "No Of Guests: " . $Guests . "\n" .
				   "Event: " . $Events . "\n" .
				   "Category: " . $Category . "\n";

	$Email_headers = "";
	$Email_headers .= 'From: ' . $Name . ' <' . $Email . '>' . "\r\n".
					  "Reply-To: " .  $Email . "\r\n";

	$sent = mail($Recipient, $Subject, $Email_body, $Email_headers);

	if ($sent){
		$emailResult = array ('sent'=>'yes');
	} else{
		$emailResult = array ('sent'=>'no');
	}

	echo json_encode($emailResult);

} else {

	$emailResult = array ('sent'=>'no');
	echo json_encode($emailResult);

}
?>
