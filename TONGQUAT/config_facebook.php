<?php
// session_start();
require '../TONGQUAT/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '306351439064429',
    'app_secret' => 'aef7d41638a94266759cd1c70ffb0bdd',
    'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; 