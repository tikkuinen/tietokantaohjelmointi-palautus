<?php

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
// Parametrit erotetaan slashilla (/)
$parameters = explode('/',$uri);
// Category id is first parameter so it follows after address separated with slash (/)
$phrase = $parameters[1];


// ON VAAN copypastettu

try {
    $db = openDb();
    $sql = "select * from product where artist like '%$phrase%' or album_name like '%$phrase%'";
    selectAsJson($db,$sql);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}