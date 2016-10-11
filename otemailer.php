<?php
// If you are using Composer
require 'vendor/autoload.php';

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

// Send email? Set to false if you just want to test the collection of the callback data.
$bool_sendemail = true;

// Get email config from querystring
$config_emailaddress = htmlspecialchars($_GET["emailaddress"]);

// Get data from OneTouch callback
$onetouch_putdata = json_decode(file_get_contents("php://input"));

// Setup email body.
$emailcontent = "Here is the content of the OneTouch callback.\r\n";
$emailcontent .= "\r\n";
$emailcontent .= json_encode($onetouch_putdata, JSON_PRETTY_PRINT);

// Email setup
$content = new SendGrid\Content("text/plain", $emailcontent);
$subject = "OneTouch callback received.";

$from = new SendGrid\Email(null, $config_emailaddress);
$to = new SendGrid\Email(null, $config_emailaddress);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

// Send OneTouch callback data via email.
if ($bool_sendemail) {
    $response = $sg->client->mail()->send()->post($mail);
} else {
    echo $emailcontent;
}

?>
