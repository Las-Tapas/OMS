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

// Zoeklogica: controleer of er een zoekopdracht is ingediend
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    // Zoek producten die overeenkomen met de zoekterm
    $query = $pdo->prepare("SELECT id, name, description, price, image_url FROM products WHERE name LIKE :search OR description LIKE :search");
    $query->execute(['search' => "%$searchTerm%"]);
} else {
    // Haal alle producten op als er geen zoekopdracht is
    $query = $pdo->query("SELECT id, name, description, price, image_url FROM products");
}

$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Las Tapas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/lastapas.png" type="image/x-icon">
</head>
<body>

<header>
    <div class="navbar">
        <img src="images/lastapas.png" alt="Las Tapas Logo" class="logo">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div class="header-text">
        <h1>Welcome to Las Tapas</h1>
        <p>Experience the best Mediterranean cuisine right here. Enjoy delicious meals prepared with fresh ingredients. Come dine with us and feel the true taste of Spain!</p>
    </div>
</header>

<!-- Zoekbalk -->
<div class="search-container">
    <form method="POST" action="index.php">
        <input type="text" name="search" placeholder="Search for food..." value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="container">
    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
                <p><strong>Price:</strong> €<?php echo number_format($product['price'], 2); ?></p>
                <button onclick="alert('Order placed for <?php echo $product['name']; ?>')">Order Now</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found. Try another search.</p>
    <?php endif; ?>
</div>


</body>
</html>
