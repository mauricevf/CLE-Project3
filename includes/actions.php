<?php

require_once '../config/database.php';
function getDishes(\PDO $db): array
{
     $stmt = $db->query("SELECT * FROM menu WHERE type = 'dishes'");
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDrinks(\PDO $db): array
{
    $stmt = $db->query("SELECT * FROM menu WHERE type = 'drinks'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDesserts(\PDO $db): array
{
    $stmt = $db->query("SELECT * FROM menu WHERE type = 'desserts'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBestelling(\PDO $db): array
{
//    $id = $_GET['id'];
//    $stmt = $db->query("SELECT * FROM bestelling WHERE id = $id");
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $db->query("SELECT * FROM menu");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDishDetails(): array
{
    return [
        [
            "id" => 1,
            "description" => "-"
        ],
        [
            "id" => 2,
            "description" => "-"
        ],
        [
            "id" => 3,
            "description" => "-"
        ],
        [
            "id" => 4,
            "description" => "-"
        ],
    ];
}

function getDrinkDetails(): array
{
    return [
        [
            "id" => 1,
            "description" => "-"
        ],
        [
            "id" => 2,
            "description" => "-"
        ],
        [
            "id" => 3,
            "description" => "-"
        ],
        [
            "id" => 4,
            "description" => "-"
        ],

    ];
}

function getDessertDetails(): array
{
    return [
        [
            "id" => 1,
            "description" => "-"
        ],
        [
            "id" => 2,
            "description" => "-"
        ],
        [
            "id" => 3,
            "description" => "-"
        ],
        [
            "id" => 4,
            "description" => "-"
        ],

    ];
}