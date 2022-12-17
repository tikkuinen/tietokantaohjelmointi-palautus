<?php
// headers ekana
// session_start();
require('./admin_user_controller.php');
// jos sessio ei ole päällä eli jos ei ole käyttäjänimeä siellä, ei päästetä mihkään
// if(!isset($_SESSION['username'])){
//     http_response_code(403);
//     echo "Ei tarvittavia oikeuksia.";
//     return;
// }
//haetaan lisättävät tiedot
$input = json_decode(file_get_contents('php://input'));
// siivotaan lisättävät tiedot ennen kuin ne lisätään
$name = filter_var($input->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_var($input->price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// tehdään se lisäys
try {
    $db = createSqliteConnection();

    $sql = "INSERT INTO product (product_name, price) VALUES (?, ?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($name, $price));

} catch (PDOException $pdoex) {
    http_response_code(500);
    echo "Tuotteen lisäys ei onnistunut.";
    return;
}
