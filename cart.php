<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
}

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
    <link rel="stylesheet" href="css/cart.css">
    <link rel="shortcut icon" href="images/lastapas.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="navbar">
        <a href="index.php"><img src="images/lastapas.png" alt="Las Tapas Logo" class="logo"></a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="cart.php" class="active"><img src="images/cart-icon.png" alt="Cart" class="cart-icon"></a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="cart-container">
    <h2>Jouw winkelmand</h2>
    
    <?php if (isset($cartEmptyMessage)): ?>
        <p class="cart-empty-message"><?php echo $cartEmptyMessage; ?></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Afbeelding</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Subtotaal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cartItems as &$item): ?>
                    <?php $subtotal = $item['price'] * $item['quantity']; ?>
                    <?php $total += $subtotal; ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" class="cart-img"></td>
                        <td>€<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form method="POST" action="php/cart_update.php" class="quantity-form">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                <button type="submit" class="update-button">Update</button>
                            </form>
                        </td>
                        <td>€<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Totaal:</strong></td>
                    <td><strong>€<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <a href="cart.php?action=clear" class="clear-cart-button">Winkelmand leegmaken</a>
    <?php endif; ?>
</div>
</body>
</html>
