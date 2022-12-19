<?php

function createSqliteConnection($filename) {
    try {
        $dbcon = new PDO("sqlite:".$filename);
        return $dbcon;
        echo "toimii";

    }catch(PDOException $error){
        http_response_code(505);
        echo "Palvelu ei ole käytettävissä.";
    }

    return null;
}

// palauttaa edellisen lisätyn id:n, tämä tilauksen tallentamista varten
function executeInsert(object $db,string $sql): int {
    $query = $db->query($sql);  
    return $db->lastInsertId();
  }