<?php
// Controleer of het formulier met een POST-verzoek is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Controleer of er items zijn geselecteerd
    if (!empty($_POST['items'])) {
        $selected_items = $_POST['items'];

        // Array met prijzen voor de geselecteerde items
        $prices = [
            "Patatas Bravas" => 5.00,
            "Gambas al Ajillo" => 8.00,
            "Croquetas" => 6.00,
            "Paella" => 12.00,
            "Pollo a la Plancha" => 10.00,
            "Sangria" => 4.00,
            "Tinto de Verano" => 3.00,
            "Agua" => 2.00,
            "Churros" => 5.00,
            "Flan" => 4.00
        ];

        // Variabelen voor de berekening
        $total_price = 0;

        echo "<h1>Bedankt voor je bestelling!</h1>";
        echo "<p>Je hebt de volgende items besteld:</p>";
        echo "<ul>";

        // Loop door de geselecteerde items en toon ze samen met de prijs
        foreach ($selected_items as $item) {
            echo "<li>" . htmlspecialchars($item) . " - €" . number_format($prices[$item], 2) . "</li>";
            $total_price += $prices[$item]; // Tel de prijzen bij elkaar op
        }

        echo "</ul>";
        echo "<h3>Totaal: €" . number_format($total_price, 2) . "</h3>";
    } else {
        echo "<h1>Geen items geselecteerd!</h1>";
        echo "<p>Keer terug naar het menu en selecteer items om te bestellen.</p>";
    }
} else {
    echo "<h1>Ongeldige toegang!</h1>";
    echo "<p>Je kunt deze pagina alleen bezoeken na het plaatsen van een bestelling.</p>";
}
?>

<!-- Terug naar de bestelpagina -->
<a href="order.php" style="display: inline-block; padding: 10px 15px; background-color: #d9534f; color: white; text-decoration: none; border-radius: 5px;">Terug naar bestellen</a>