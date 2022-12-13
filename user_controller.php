<?php
require('./dbconnection.php');

function registerUser($uname, $pw) {
    $db = createSqliteConnection('./ceramicshop.db');

    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, passwd) VALUES (?,?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname, $pw));
}

// olis hyvä olla try catch