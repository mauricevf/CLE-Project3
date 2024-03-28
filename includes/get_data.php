<?php

require_once 'actions.php';

switch ($_GET['action']) {
    case 'getDishes':
        echo json_encode(getDishes());
        break;
    case 'getDishDetails':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo json_encode(getDishDetails($id));
        } else {
            // Handle case where 'id' parameter is missing
            echo json_encode(array('error' => 'No ID specified for dish details.'));
        }
        break;
    case 'getDrinks':
        echo json_encode(getDrinks());
        break;
    case 'getDrinkDetails':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo json_encode(getDrinkDetails($id));
        } else {
            // Handle case where 'id' parameter is missing
            echo json_encode(array('error' => 'No ID specified for drink details.'));
        }
        break;
    case 'getDesserts':
        echo json_encode(getDesserts());
        break;
    case 'getDessertDetails':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo json_encode(getDessertDetails($id));
        } else {
            // Handle case where 'id' parameter is missing
            echo json_encode(array('error' => 'No ID specified for drink details.'));
        }
        break;
    default:
        // Handle case where 'action' parameter is invalid
        echo json_encode(array('error' => 'Invalid action.'));
        break;
}
