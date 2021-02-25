<?php error_reporting(E_ALL); ini_set('display_errors', 1);
// configure
$from = 'Con Ilan a la India <conilanalaindia@gmail.com>';
$sendTo = 'khangnpq@gmail.com';
$subject = 'Contact from github-page';
$fields = array();
$fields["name"] = "HR";
$fields["email"] = "E-mail";
$fields["message"] = "Message"; // array variable name => Text to appear in the email
$okMessage = 'Your message has been sent successfully!';
$errorMessage = 'Failed to send your message';

// let's do the sending

try
{
$emailText = "Hello there, it's really nice to meet you!";

foreach ($_POST as $key => $value) {

    if (isset($fields[$key])) {
        $emailText .= "$fields[$key]: $value\n";
    }
}

$headers = array('Content-Type: text/html; charset="UTF-8";',
    'From: ' . $from,
    'Reply-To: ' . $from,
    'Return-Path: ' . $from,
);

mail($sendTo, $subject, $emailText, implode("\n", $headers));

$responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
$responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
$encoded = json_encode($responseArray);

header('Content-Type: application/json');

echo $encoded;
}
else {
echo $responseArray['message'];
}