<?php

require_once 'actions.php';

//if (isset($_GET['action'])) {
//    if ($_GET['action'] === 'getDishes') {
//        echo json_encode(getDishes());
//    } else if ($_GET['action'] === 'getDishDetails' && isset($_GET['id'])) {
//        $id = $_GET['id'];
//        echo json_encode(getDishDetails($id));
//    } else if ($_GET['action'] === 'getDrinks') {
//        echo json_encode(getDrinks());
//    }
//}

switch (isset($_GET['action'])) {
    case 'getDishes':
        echo json_encode(getDishes());
        break;
    case 'getDishDetails':
    case isset($_GET['id']):
        $id = $_GET['id'];
        echo json_encode(getDishDetails($id));
        break;
    case 'getDrinks':
        echo json_encode(getDrinks());
        break;
}