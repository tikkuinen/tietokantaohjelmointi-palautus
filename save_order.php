<?php
require('./admin_user_controller.php');

$db = null;

// $input = json_decode(file_get_contents('php://input'));
// // tarkastetaan annetut tiedot
// $fname = filter_var($input->firstname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $lname = filter_var($input->lastname,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $address = filter_var($input->address,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $postcode = filter_var($input->postcode,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $city = filter_var($input->city,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $tel = filter_var($input->tel,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// // jos olis ostoskori, niin sekin tulisi tähän
// $cart = $input->cart;

$fname = "Tiia";
$lname = "Liukko";
$address = "Simps";
$postcode = "90530";
$city = "Oulu";
$tel = "0501234567";


try {
    $db = createSqliteConnection();
    $db->beginTransaction();

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

    // tää toimii
    $sql = "INSERT INTO orders (customer_id) VALUES ($customer_id)";
    $order_id = executeInsert($db,$sql);

    // foreach ((array)$cart as $product_id) {
    //     $sql = "insert into order_specs (order_id, product_id) values ("
    //     .
    //         $order_id . "," .
    //         $product_id->product_id
    //     . ")";
    //     executeInsert($db,$sql);
    // }

    // pitäiskö olla amount tuolta cartista kans?
    $db->commit();


    // tätä pitää siivota
    header('HTTP/1.1 200 OK');
    $data = array('id' => $customer_id, 'name' => $fname);
    echo json_encode($data);
}

catch (PDOException $error) {
    $db->rollback();
    echo $error->getMessage();
}

