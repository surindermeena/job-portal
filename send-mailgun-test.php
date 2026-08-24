<?php
require __DIR__ . '/vendor/autoload.php';

use Mailgun\Mailgun;

// Replace with your real, full API key from step 1
$mg = Mailgun::create('key-0ab26ad92bdcdd61ffa693e8c864cfd4-97129d72-50dd3086');

// Replace with your real domain from step 2
$domain = 'sandboxca5d0364b8cf42f3a023618b9e11232b.mailgun.org';

$result = $mg->messages()->send($domain, [
    'from'    => 'Mailgun Sandbox <postmaster@' . $domain . '>',
    'to'      => 'Surinder Meena <surinder321992@gmail.com>',
    'subject' => 'Hello from Mailgun',
    'text'    => 'Hi Surinder, this is a test email from Mailgun API using PHP!',
]);

echo $result->getMessage();
