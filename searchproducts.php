<?php
require('./admin_user_controller.php');

// $uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
// // Parametrit erotetaan slashilla (/)
// $parameters = explode('/',$uri);
// // Category id is first parameter so it follows after address separated with slash (/)
// $phrase = $parameters[1];

//'%$phrase%'

// testaa toimiiko selaimella kun osoitteeseen laittaa sen osan

try {
    $db = createSqliteConnection();
    $sql = "SELECT * FROM product WHERE product_name LIKE '%rsu%'";
    //$sql = "SELECT * FROM product";
    $statement = $db->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode($results);
}
catch (PDOException $pdoex) {
    echo "Tuotetta ei valitettavasti löytynyt.";
}