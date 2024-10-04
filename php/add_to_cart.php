<?php
// Database verbinding
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

// Voeg product toe aan de winkelmand
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Query om product toe te voegen
    $stmt = $pdo->prepare("INSERT INTO cart (product_id, product_name, price) VALUES (?, ?, ?)");
    $stmt->execute([$product_id, $product_name, $price]);

    // Terug naar winkelmand
    header("Location: order.php");
    exit();
}
?>
