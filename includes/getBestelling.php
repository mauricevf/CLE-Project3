<?php
if(isset($_GET['id'])){
    require_once '../config/settings.php';
    require_once '../config/database.php';

    $id = $_GET['id'];

    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USER;
    $password = DB_PASS;

    try {
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch data based on ID
        $stmt = $db->prepare("SELECT * FROM bestellingen WHERE id = ?");
        $stmt->execute([$id]);
        $bestellingData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the data as JSON
        echo json_encode($bestellingData);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Er trad een fout op bij het ophalen van bestellingsgegevens: ' . $e->getMessage()]);
    }
} else {
    header("index.php");
}
