<?php
  require_once "FacebookConfig.php";
  require "Config/Autoload.php";
  require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in

try{
    //Return a Facebook\FacebookResponse object
    $response=$fb->get("/me?fields=id,name,email,first_name,last_name,picture,gender",$accessToken->getValue());
}catch(Facebook\Exceptions\FacebookResponseException $e){
    echo "Graph returned an error: " . $e->getMessage();
    exit;
}catch(Facebook\Exceptions\FacebookSDKException $e){
    echo "Facebook SDK returned an error: "  . $e->getMessage();
    exit;
}

/*Here is what I want to do by clicking log in facebook*/

use Controllers\UserController as UserController;
$accountController=new UserController();
$fbUserData=$response->getGraphUser()->asArray();
$fbUserData["password"]=$accessToken->getValue();
$accountController->loginWithFacebook($fbUserData);

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

require_once(VIEWS_PATH."footer.php");
//$_SESSION['fb_access_token'] = (string) $accessToken;

?>