<?php
// headers ekana
session_start();
require('./user_controller.php');

if(isset($_SESSION['username'])){
    http_response_code(200);
    echo $_SESSION['username'];
    return;
}