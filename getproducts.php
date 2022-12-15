<?php
// headers ekana
//session_start();
require('./admin_user_controller.php');

// haetaan tietoa
try {
    $db = createSqliteConnection('./ceramicshop.db');
    $sql = "SELECT product_name FROM product";
    // valmistellaan haku ja kutsutaan
    $statement = $db->prepare($sql);

    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json = json_decode($products);

    foreach ($json as $product) {
        echo $product->product_name."<br>";
    }
    echo "häh eka";
}
catch (PDOException $pdoex) {
    echo $error->getMessage();
    echo "häh";
}



    // palautetaan tuotteet json-muodossa takaisin
//     $json = json_encode($products);
// header('Content-type: application/json');
// echo $json;

// foreach ($dataObject as $game){
//     echo $game->title."<br>";
// }