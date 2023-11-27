<?php

use Facebook\Authentication\OAuth2Client;

include '../TONGQUAT/config.php';
// Sign in Facebook
include '../TONGQUAT/config_facebook.php';

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Lỗi Graph: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Lỗi SDK của Facebook: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    header('Location: dang-nhap.php'); // Chuyển hướng về trang chủ nếu không có AccessToken
    exit;
}
try {
    // Get the user's profile
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    $user = $response->getGraphUser();
    $userId = $user->getId();
    $userName = $user->getName();
    echo 'ID: ' . $userId . '<br>';
    echo 'Username: ' . $userName . '<br>';
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// Chưa xài file này