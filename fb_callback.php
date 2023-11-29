<?php
session_start();
include './TONGQUAT/config.php';
include './TONGQUAT/fb_config.php';

if (!$accessToken) {
    header('Location: /dang-nhap.php');
    exit;
}

// Get user profile data
try {
    $response = $fb->get('/me?fields=id,name', $accessToken);
    $user = $response->getGraphUser();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// Save user data to session
$_SESSION['facebook_access_token'] = (string) $accessToken;
$_SESSION['facebook_user_id'] = $user->getId();
$_SESSION['facebook_user_name'] = $user->getName();

header('Location: index.php');
exit;
