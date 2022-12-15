<?php
require('./dbconnection.php');

//Rekisteröinti
function registerUser($uname, $pw) {
    try {
        if (isset($uname)) {
            echo "Käyttäjänimi oli jo olemasssa";
            return;
        }
        // tässä katottais onko ne oikeanlaisia ennen kuin kutsutaan
        $db = createSqliteConnection('./ceramicshop.db');

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
    $db = createSqliteConnection('./ceramicshop.db');
    // etsii taulusta onko tuolla käyttäjänimellä olemassa salasanaa, jos on, niin on validi
    $sql = "SELECT passwd FROM user WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));
    // jos ei löydy niin tulee virhe, jos käyttäjää ei ole koska ei ole virheenhallintaa
    $hashed = $statement->fetchColumn();

    if(isset($hashed)){
        return password_verify($pw, $hashed) ? $uname : null;
    }

    return null;
}