<?php

function createSqliteConnection() {
    try {
        $dbcon = new PDO("sqlite:".'./ceramicshop.db');
        return $dbcon;

    }catch(PDOException $error){
        http_response_code(505);
        echo "Palvelu ei ole käytettävissä.";
    }

    return null;
}

// TÄTÄ EI EHKÄ TARVII
// palauttaa edellisen lisätyn id:n, tämä tuotteen lisäystä varten
function executeInsert(object $db,string $sql): int {
    $query = $db->query($sql);  
    return $db->lastInsertId();
  }