<?php
$conn = mysqli_connect("localhost", "root", "", "quanlydathang");
mysqli_set_charset($conn, "utf8");
if ($conn->connect_errno) {
    echo "Kết nối lỗi" . $conn->connect_error;
    exit();
}


// Facebook
require '../TONGQUAT/vendor/autoload.php';

$facebook = new Facebook\Facebook([
    'app_id' => '306351439064429',
    'app_secret' => 'aef7d41638a94266759cd1c70ffb0bdd',
    'default_graph_version' => 'v12.0',
]);
$helper = $facebook->getRedirectLoginHelper();
$fbPermissions = ['email'];

try {
    if (isset($_SESSION['fb_token'])) {
        $accessToken = $_SESSION['fb_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Lỗi Graph: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Lỗi SDK của Facebook: ' . $e->getMessage();
    exit;
}
