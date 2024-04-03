<?php

require_once 'actions.php';
require_once  '../config/database.php';
require_once '../config/settings.php';

//switch ($_GET['action']) {
//    case 'getDishes':
//        echo json_encode(getDishes());
//        break;
//    case 'getDishDetails':
//        if (isset($_GET['id'])) {
//            $id = $_GET['id'];
//            echo json_encode(getDishDetails($id));
//        } else {
//            // Handle case where 'id' parameter is missing
//            echo json_encode(array('error' => 'No ID specified for dish details.'));
//        }
//        break;
//    case 'getDrinks':
//        echo json_encode(getDrinks());
//        break;
//    case 'getDrinkDetails':
//        if (isset($_GET['id'])) {
//            $id = $_GET['id'];
//            echo json_encode(getDrinkDetails($id));
//        } else {
//            // Handle case where 'id' parameter is missing
//            echo json_encode(array('error' => 'No ID specified for drink details.'));
//        }
//        break;
//    case 'getDesserts':
//        echo json_encode(getDesserts());
//        break;
//    case 'getDessertDetails':
//        if (isset($_GET['id'])) {
//            $id = $_GET['id'];
//            echo json_encode(getDessertDetails($id));
//        } else {
//            // Handle case where 'id' parameter is missing
//            echo json_encode(array('error' => 'No ID specified for drink details.'));
//        }
//        break;
//    default:
//        // Handle case where 'action' parameter is invalid
//        echo json_encode(array('error' => 'Invalid action.'));
//        break;
//}

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
            error_log(print_r($data, true));
            break;
        case 'getDrinks':
            $data = getDrinks($db);
            break;
        case 'getDesserts':
            $data = getDesserts($db);
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
