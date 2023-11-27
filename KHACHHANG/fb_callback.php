<?php
session_start();
include '../TONGQUAT/config.php';
// Sign in Facebook
require '../TONGQUAT/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '306351439064429',
    'app_secret' => 'aef7d41638a94266759cd1c70ffb0bdd',
    'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
    $response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
    $userData = $response->getGraphNode()->asArray();

    // Lấy URL hình ảnh của người dùng
    $pictureUrl = $userData['picture']['url'];

    if (isset($userData['picture']['url'])) {
        $pictureUrl = $userData['picture']['url'];
        echo '<img src="' . $pictureUrl . '" alt="User Profile Picture">';
    } else {
        echo 'Không có thông tin về hình ảnh của người dùng.';
    }

    // Xử lý thông tin người dùng khác nếu cần
    print_r($userData);
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}