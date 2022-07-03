<?php

require 'vendor/autoload.php';


//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('330988549444-f0fqe3n2iql1qcsutc331u1d7b3i079v.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/php_projects/login_and_registration/auth.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');




// function get_client(){
//     $client = new Google_Client();
//     $client->setClientId("330988549444-f0fqe3n2iql1qcsutc331u1d7b3i079v.apps.googleusercontent.com");
//     $client->setClientSecret('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');
//     $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email'));
//     $client->setRedirectUri("http://localhost/php_projects/login_and_registration/auth.php");
//     return $client;
// }
