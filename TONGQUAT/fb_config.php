<?php
require './TONGQUAT/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '306351439064429',
    'app_secret' => 'aef7d41638a94266759cd1c70ffb0bdd',
    'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
