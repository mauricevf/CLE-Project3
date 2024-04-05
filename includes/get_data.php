<?php

require_once 'actions.php';
require_once  '../config/database.php';
require_once '../config/settings.php';

if (isset($_GET['action'])){
    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USER;
    $password = DB_PASS;

    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $action = $_GET['action'];
    switch($action) {
        case 'getDishes':
            $data = getDishes($db);
            break;
        case 'getDrinks':
            $data = getDrinks($db);
            break;
        case 'getDesserts':
            $data = getDesserts($db);
            break;
        case 'getBestelling':
            $data = getBestelling($db);
            break;
        default:
            http_response_code(400); // Bad request
            echo json_encode(array("error" => "Invalid action"));
            exit;
    }

    header('Content-Type: application/json');

    echo json_encode($data);

}else{
    http_response_code(400); // Bad request
    echo json_encode(array("error" => "Action parameter is required"));
}
