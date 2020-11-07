<?php
require_once "Config/Data.php";
if(!isset($_SESSION)){
    session_start();
}

require(ROOT."/vendor/autoload.php");

$fb = new Facebook\Facebook([
    'app_id' => '429674224576137',
    'app_secret' => 'd8c3df0dd28220a92df2ce0df3e921b9',
    'default_graph_version' => 'v2.7'
]);

$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/MoviePass2");

try{
    $accessToken = $helper->getAccessToken();
    if(isset($accessToken)){
        
        $_SESSION['access_token'] = (string)$accessToken;
        
    }
} catch (Exception $exc){
    
    var_dump(  $exc->getTraceAsString() );
}
?>