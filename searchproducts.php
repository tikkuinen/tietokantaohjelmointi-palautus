<?php
require('headers.php');
require('admin_user_controller.php');

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
// parametrit erotetaan osoiterivistä
$parameters = explode('/',$uri);
// otetaan se ensimmäinen parametri
$phrase = $parameters[1];

// Haku toimii kun selaimessa lisää osoitteeseen haettavan parametrin.

try {
    $db = createSqliteConnection('./ceramics.db');

    $sql = "SELECT * FROM product WHERE product_name LIKE '%$phrase%'";
    $statement = $db->prepare($sql);
    $statement->execute();
    
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode($results);
}
catch (PDOException $pdoex) {
    echo "Tuotetta ei valitettavasti löytynyt.";
}