<?php
require('headers.php');
require('admin_user_controller.php');

$db = null;

$input = json_decode(file_get_contents('php://input'));

if(!isset($input)) {
    http_response_code(400);
    echo "Syötetyt tiedot ovat puutteelliset.";
    return;
}

// tarkastetaan annetut tiedot
$fname = filter_var($input->fname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lname = filter_var($input->lname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address = filter_var($input->address,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$postcode = filter_var($input->postcode,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$city = filter_var($input->city,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$tel = filter_var($input->tel,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// jos olis ostoskori, niin sekin tuotaisiin tähän
// $cart = $input->cart;

try {
    $db = createSqliteConnection('./ceramics.db');
    $db->beginTransaction();

    // lisätään asiakastiedot
    $sql = "INSERT INTO customer (firstname,lastname,address,postcode,city,tel) VALUES
    ('" .
        filter_var($fname,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
        filter_var($lname,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
        filter_var($address,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
        filter_var($postcode,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
        filter_var($city,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
        filter_var($tel,FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    .   "')";

    $customer_id = executeInsert($db,$sql);

    // lisätään tilaustieto
    $sql = "INSERT INTO orders (customer_id) VALUES ($customer_id)";
    $order_id = executeInsert($db,$sql);

    // tilausriville ei mene nyt mitään, koska ostoskoria ei ole määritelty

    $db->commit();

    // palautetaan asiakasnumero ja etunimi
    http_response_code(200);
    $data = array('id' => $customer_id, 'name' => $fname);
    echo json_encode($data);
}

catch (PDOException $error) {
    $db->rollback();
    echo $error->getMessage();
}