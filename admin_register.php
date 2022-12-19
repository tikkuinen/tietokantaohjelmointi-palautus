<?php
require('headers.php');
session_start();
require('admin_user_controller.php');

// haetaan tieto json-muodossa ja dekoodataan ja tallennetaan muuttujaan
$body = file_get_contents('php://input');
$user = json_decode($body);

// tallennetaan käyttäjätunnus ja salasana muuttujiin
$uname = $user->uname;
$pw = $user->pw;

// tarkistaa onko niitä syötteitä edes asetettu, eli onko jsonissa kenttää uname tai pw
if(!isset($uname) || !isset($pw)){
    http_response_code(400);
    echo "Virhe, käyttäjätunnus tai salasana puuttuu!";
    return;
}

// pitäisi tutkia mitkä merkit sallittuja, ja ilmoittaa käyttäjälle
//$uname = strip_tags($user->uname);

// käyttäjä on olemassa, niin siihen ei reagoida

registerUser($uname, $pw);

$_SESSION['username'] = $uname;

http_response_code(200);
echo "Käyttäjän $uname rekisteröinti onnistui!";