<?php
require('headers.php');
session_start();
require('admin_user_controller.php');

// jos sessio on jo olemassa tuolla nimellä, niin palautetaan nimi, ja lopetetaan jotta ei kirjaudu uudestaan
if(isset($_SESSION['username'])){
    http_response_code(200);
    echo $_SESSION['username'];
    return;
}

if(!isset($_POST['uname']) || !isset($_POST['pw'])){
    http_response_code(401);
    echo "Anna käyttäjätunnus ja salasana.";
    return;
}

$uname = $_POST['uname'];
$pw = $_POST['pw'];

// tarkastetaan tietokannasta
$verified_uname = checkUser($uname,$pw);

if($verified_uname){
    $_SESSION['username'] = $verified_uname;
    http_response_code(200);
    echo $verified_uname;
}else{
    http_response_code(401);
    echo "Väärä käyttäjätunnus tai salasana.";
}
