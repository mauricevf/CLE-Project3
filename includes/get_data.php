<?php

require_once 'actions.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'getDishes') {
        echo json_encode(getDishes());
    } else if ($_GET['action'] === 'getDishDetails' && isset($_GET['id'])) {
        $id = $_GET['id'];
        echo json_encode(getDishDetails($id));
    } else if ($_GET['action'] === 'getDrinks') {
        echo json_encode(getDrinks());
    }
}