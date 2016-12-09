<?php
    require "zxcd9.php";
    require_once 'fbsdk/src/Facebook/autoload.php';
    $fb = new Facebook\Facebook([
      'app_id' => '549469675232922',
      'app_secret' => '1ef3769dd214f7083128f3504b9649fd',
      'default_graph_version' => 'v2.6',
    ]);
    $helper = $fb->getRedirectLoginHelper();
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
    if (isset($accessToken)) {
      // Logged in!
      $_SESSION['facebook_access_token'] = (string) $accessToken;
      echo "success";
      // Now you can redirect to another page and use the
      // access token from $_SESSION['facebook_access_token']
      //Post property to Facebook
    $linkData = [
     'link' => 'www.slp.ph',
     'message' => 'Hi vina im posting from SLP.ph'
    ];
    $pageAccessToken = EAAHzvWDOnpoBAL4M1ylrzSEwVZAlZCdBNZCgsxsOZBJp4sybZCziAZAnRKB8FZAXZBltIE4JQeoViEH79br6BY7pT0mj4JahGzQZBLZBsu0QZBwcCUnmcqX3c9ysoxYJD2n3MJDKv7imkIc1cIaRxik1jJywVyvJ7JosdbhWvapVRucpQZDZD;
    try {
     $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
     echo 'Graph returned an error: '.$e->getMessage();
     exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
     echo 'Facebook SDK returned an error: '.$e->getMessage();
     exit;
    }
    $graphNode = $response->getGraphNode();
    } elseif ($helper->getError()) {
      // The user denied the request
      exit;
    }
?>
