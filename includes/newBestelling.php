<?php
require_once('../config/database.php');
require_once('../config/settings.php');

$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASS;

$tafel = 1;

try {
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if any tafel is free
    $stmt = $db->prepare("SELECT tafel FROM bestellingen");
    $stmt->execute();
    $occupiedTafels = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Find the next available tafel
    while (in_array($tafel, $occupiedTafels)) {
        $tafel++;
    }

    // Make new Bestelling
    if (count($occupiedTafels) < 3) {
        $stmt = $db->prepare("INSERT INTO bestellingen (tafel) VALUES (:tafel)");
        $stmt->bindParam(':tafel', $tafel);
        $stmt->execute();

        $newId = $db->lastInsertId();

        // Return the new ID as JSON
        echo json_encode(['newId' => $newId]);
    } else {
        // If all tafels are occupied, return an error message
        http_response_code(400);
        echo json_encode(['error' => 'Alle tafels zijn bezet']);
    }
} catch (PDOException $e) {
    // If an error occurs, return an error message
    http_response_code(500);
    echo json_encode(['error' => 'Er trad een fout op bij het aanmaken van een id: ' . $e->getMessage()]);
}
