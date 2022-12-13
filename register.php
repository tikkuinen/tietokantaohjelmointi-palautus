<?php
session_start();
require('./user_controller.php');

$body = file_get_contents('php://input');
$user = json_decode($body);

if(!isset($user->uname) || !isset($user->pw)) {
    http_response_code("400");
    echo "ei toimi";
}

registerUser($user->uname, $user->pw);

$_SESSION['username'] = $user->uname;

http_response_code('200');
echo "User $user->uname register succesful";