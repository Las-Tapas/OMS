<?php
session_start();

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    $cartEmptyMessage = "Je winkelmand is leeg.";
} else {
    $cartItems = $_SESSION['cart'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Las Tapas - Winkelmand</title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="shortcut icon" href="../images/lastapas.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="navbar">
        <a href="../index.php"><img src="../images/lastapas.png" alt="Las Tapas Logo" class="logo"></a>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="cart.php" class="active"><img src="../images/cart-icon.png" alt="Cart" class="cart-icon"></a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="cart-container">
    <h2>Jouw winkelmand</h2>
    
    <?php if (isset($cartEmptyMessage)): ?>
        <p><?php echo $cartEmptyMessage; ?></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>€<?php echo number_format($item['price'], 2); ?></td>
                        <td>1</td> <!-- Dit kan worden uitgebreid voor hoeveelheidaanpassingen -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
