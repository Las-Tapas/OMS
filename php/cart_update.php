<?php
session_start();

// Check of de product-ID en de hoeveelheid zijn doorgegeven in de POST-request
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = intval($_POST['quantity']);

    // Controleer of de nieuwe hoeveelheid groter is dan 0
    if ($newQuantity > 0) {
        // Update de hoeveelheid van het product in de winkelwagen als het product bestaat
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
        }
    } else {
        // Verwijder het product als de hoeveelheid 0 of lager is
        unset($_SESSION['cart'][$productId]);
    }
}

// Redirect terug naar de winkelwagenpagina
header("Location: ../cart.php");
exit;
