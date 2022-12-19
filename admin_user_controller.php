<?php
require('dbconnection.php');

//Rekisteröinti
function registerUser($uname, $pw) {
    try {
        $db = createSqliteConnection('./ceramics.db');

        $pw = password_hash($pw, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO user (username, passwd) VALUES (?,?)";
        $statement = $db->prepare($sql);
        $statement->execute(array($uname, $pw));
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

// tarkistaa onko käyttäjän tiedot oikein, palauttaa null jos käyttäjää ei ole
function checkUser($uname, $pw) {
    $db = createSqliteConnection('./ceramics.db');
    // etsii taulusta onko tuolla käyttäjänimellä olemassa salasanaa, jos on, niin on validi
    $sql = "SELECT passwd FROM user WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));
    $hashed = $statement->fetchColumn();

    if(isset($hashed)){
        return password_verify($pw, $hashed) ? $uname : null;
    }

    return null;
}