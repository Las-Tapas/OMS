<?php
// Database connectie gegevens
$host = "localhost";
$user = "root";
$pass = "";
$db = "order_management";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Zoeklogica
if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];
    $query = $pdo->prepare("SELECT id, name, image_url FROM products WHERE name LIKE :search");
    $query->execute(['search' => "%$searchTerm%"]);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // Retourneer als JSON
    echo json_encode($products);
}
?>
