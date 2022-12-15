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