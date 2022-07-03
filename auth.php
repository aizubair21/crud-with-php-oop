<?php
include "function.php";

// function get_client(){
//     $client = new Google_Client();
//     $client->setClientId("330988549444-f0fqe3n2iql1qcsutc331u1d7b3i079v.apps.googleusercontent.com");
//     $client->setClientSecret('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');
//     $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email'));
//     $client->setRedirectUri("http://localhost/php_projects/login_and_registration/auth.php");
//     return $client;
// }


//code don't work prooperly
// function get_auth_url(){
//     $client = get_client();
//     return $client->createAuthUrl();
// }

// function get_user_info_object( $authCode ){
//     $client = get_client();
//     $token = $client->fetchAccessTokenWithAuthCode($authCode);
//     $client->setAccessToken($token);
//     $oauth = new Google_Service_Oauth2($client);
//     return $oauth;

    
// }

// if(isset($_GET["code"])){

//     $_SESSION["key"] = $_GET["code"];

//     $user = get_user_info_object($_SESSION["key"]);
//     $userData = $user->userinfo->get();
//     $email = $userData["email"];
//     $picture =  $userData["picture"];
//     print_r($_SESSION);
// }






if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {

  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $google_service = new Google_Service_Oauth2($google_client);

  $data = $google_service->userinfo->get();

  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
  
  $_SESSION["Auth_key"] = $_GET["code"];
  echo "Auth data :<pre>";
    print_r($data);
  echo "<br></br>session data :<pre><br>";
    print_r($_SESSION);
  echo "<pre><br>";
  

 }
}
