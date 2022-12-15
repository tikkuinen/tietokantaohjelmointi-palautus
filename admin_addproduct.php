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

// TOIMII, mutta ei lisaa tuotenumeroa, ja ei laita desimaalia kai oikein

// tehdään se lisäys
try {
    $db = createSqliteConnection('./ceramicshop.db');

    $sql = "INSERT INTO product (product_name, price) VALUES ('$name', '$price')";
    executeInsert($db, $sql);
    $data = array('product_no'=> $db ->lastInsertId(), 'name' => $name, 'price' => $price);
    echo json_encode($data);

    } catch (PDOException $pdoex) {
        http_response_code(500);
        echo "Tuotteen lisäys ei onnistunut.";
        // mitä exit tekee
        exit;
    }