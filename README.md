# OneTouchCallbackEmailer
A simple way to get emails for OneTouch request callbacks. Every time a OneTouch request is responded to,
a callback is sent to the URL where this code is running and it sends you an email with the details of the callback.

# Requirements
This code uses the SendGrid API to send the emails. You can create a free account (for up to 12k per month) at https://app.sendgrid.com/signup

* Account with SendGrid
* API key from SendGrid
* PHP v5.6+
* Composer

# Installation

1. Clone code to a local folder
2. Run Composer Install to install SendGrid libraries
3. Configure PHP to host file (or run using the CLI below)

# Use

1. Put your SendGrid API key into sendgrid.env (https://github.com/sendgrid/sendgrid-php)
2. Serve the PHP file. A quick way to do this;
   * php -S localhost:8000
   * ngrok http 8000
3. In your Authy dashboard (dashboard.authy.com) go to Settings and scroll down to the OneTouch Settings section. Enter in your URL in the following format for the Endpoint/URL.

http://yourhost.yourdomain.com/otemailer.php?emailaddress=name@domain.com