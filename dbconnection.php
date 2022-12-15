<?php

function createSqliteConnection($filename) {
    try {
        $dbcon = new PDO("sqlite:".$filename);
        return $dbcon;

    }catch(PDOException $error){
        http_response_code(505);
        echo "Palvelu ei ole käytettävissä.";
    }

    return null;
}