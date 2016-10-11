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

// echo var_dump($onetouch_putdata);

// Setup email body.
$emailcontent = "Here is the content of the OneTouch callback.\r\n";
$emailcontent .= "\r\n";
$emailcontent .= json_encode($onetouch_putdata, JSON_PRETTY_PRINT);

// Email setup
$content = new SendGrid\Content("text/plain", $emailcontent);
//$subject = "Callback with status:" . $onetouch_status . " received.";
$subject = "OneTouch callback received.";

$from = new SendGrid\Email(null, $config_emailaddress);
$to = new SendGrid\Email(null, $config_emailaddress);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);


// Write back information about the post.
// echo $config_emailaddress;

// Send OneTouch callback data via email.
if ($bool_sendemail) {
    $response = $sg->client->mail()->send()->post($mail);

    echo $response->statusCode();
    //echo $response->headers();
    echo $response->body();
}

?>
