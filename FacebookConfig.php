<?php
if(!session_id())
    session_start();

require_once "Facebook/autoload.php";


$app_id= "2845528639104872";
$app_secret="cfd5f216e64c5a660b771108e686d542";
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