<?php
if(!session_id())
    session_start();

require_once "Facebook/autoload.php";


$app_id= "582974342470057";
$app_secret="b954d993169651c447407183a8169b22";
$permissions = ['email']; // Optional permissions
$callbackUrl="http://localhost/MoviePass2/callback.php";

$fb = new Facebook\Facebook([
	'app_id' => $app_id, 
	'app_secret' => $app_secret,
	'default_graph_version' => 'v3.2',
	]);

	$helper = $fb->getRedirectLoginHelper();

    $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

	

?>