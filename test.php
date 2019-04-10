<?php
require '../config/keys.php';
# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun(MG_KEY);
$domain = MG_DOMAIN;

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
          array('from'    => "Mailgun Sandbox <postmaster@{$domain}>",
                'to'      => 'Michael <jsnider@microtrain.net>',
                'subject' => 'Hey Mike!',
                'text'    => 'Congrats Mike, you just sent an email with Mailgun! You are truly awesome! '));

$result = $mgClient->sendMessage(
    $domain,
    array('from'    => $from,
            'to'      => $to,
            'subject' => $subject,
            'text'    => $text
        )
    );