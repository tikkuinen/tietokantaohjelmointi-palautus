<?php
require('headers.php');
require('admin_user_controller.php');

// haetaan kaikkien tuotteiden nimet ja hinnat tietokannasta
try {
    $db = createSqliteConnection('./ceramics.db');
    $sql = "SELECT * FROM product";
    // valmistellaan haku ja kutsutaan product-taulusta
    $statement = $db->prepare($sql);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
}
catch (PDOException $pdoex) {
    echo $error->getMessage();
}