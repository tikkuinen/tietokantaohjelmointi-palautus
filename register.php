<?php
// headers ekana
session_start();
require('./user_controller.php');

//haetaan tieto json-muodossa ja dekoodataan ja tallennetaan muuttujaan
$body = file_get_contents('php://input');
$user = json_decode($body);

// tallennetaan käyttäjätunnus ja salasana muuttujiin
$uname = $user->uname;
$pw = $user->pw;

//onko niitä syötteitä edes asetettu, onko jsonisse kenttää uname tai pw
if(!isset($uname) || !isset($pw)){
    http_response_code(400);
    echo "Virhe, käyttäjätunnus tai salasana puuttuu!";
    //tähän lopetetaan, kun ei saatu mitään järkevää aikaiseksi
    return;
}

// pitäisi tutkia mitkä merkit sallittuja, ja ilmoittaa käyttäjälle
//$uname = strip_tags($user->uname);

// käyttäjä on olemassa, niin siihen ei reagoida

registerUser($uname, $pw);


$_SESSION['username'] = $uname;

http_response_code(200);
echo "User $uname register succesful";