<?php
session_start(); // Start de sessie om de winkelmand bij te houden

// Database connectie
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
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $query = $pdo->prepare("SELECT id, name, description, price, image_url FROM products WHERE name LIKE :search OR description LIKE :search");
    $query->execute(['search' => "%$searchTerm%"]);
} else {
    $query = $pdo->query("SELECT id, name, description, price, image_url FROM products");
}

$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Product toevoegen aan de winkelmand
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $query = $pdo->prepare("SELECT id, name, price, image_url FROM products WHERE id = :id");
    $query->execute(['id' => $productId]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check of product al in winkelmand zit
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $product['quantity'] = $quantity;
            $_SESSION['cart'][] = $product;
        }

        // Sla een bericht op in de sessie om een melding te tonen
        $_SESSION['success_message'] = "Product '{$product['name']}' is toegevoegd aan de winkelmand!";
    }
}
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
            <a href="index.php"><img src="images/lastapas.png" alt="Las Tapas Logo" class="logo"></a>
            <nav>
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="cart.php"><img src="images/cart-icon.png" alt="Cart" class="cart-icon"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Meldingsbalk -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div id="message-box">
            <p><?php echo $_SESSION['success_message']; ?></p>
        </div>
        <script>
            setTimeout(function() {
                const messageBox = document.getElementById('message-box');
                messageBox.style.opacity = '0'; // Fade out
                setTimeout(function() {
                    messageBox.style.display = 'none'; // Hide after fading out
                }, 1000);
            }, 5000);
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

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
                    <form method="POST" action="index.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <div class="quantity-selector">
                            <button type="button" onclick="this.nextElementSibling.stepDown()" class="quantity-button">-</button>
                            <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-input">
                            <button type="button" onclick="this.previousElementSibling.stepUp()" class="quantity-button">+</button>
                        </div>
                        <button type="submit" class="add-to-cart-button">Zet in winkelmand</button>
                    </form>


                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found. Try another search.</p>
        <?php endif; ?>
    </div>

</body>

</html>