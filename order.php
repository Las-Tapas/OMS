<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Terminal - Las Tapas</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function openTab(evt, tabName) {
            // Verberg alle tab-content secties
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Verwijder de 'active' klasse van alle tablinks
            tablinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Toon de huidige tab en markeer de link als 'active'
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Stel standaard de eerste tab in als geopend
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("defaultOpen").click();
        });
    </script>
</head>
<body>
    <header>
        <h1>Las Tapas - Order Terminal</h1>
    </header>

    <main>
        <section class="menu-section">
            <h2>Kies je Gerechten en Dranken</h2>

            <!-- Tablinks -->
            <div class="tabs">
                <button class="tab-link" id="defaultOpen" onclick="openTab(event, 'tapas')">Tapas</button>
                <button class="tab-link" onclick="openTab(event, 'hoofdgerechten')">Hoofdgerechten</button>
                <button class="tab-link" onclick="openTab(event, 'dranken')">Dranken</button>
                <button class="tab-link" onclick="openTab(event, 'toetjes')">Toetjes</button>
            </div>

            <!-- Tab content -->
            <form action="submit_order.php" method="POST" id="order-form">
                <div id="tapas" class="tab-content">
                    <h3>Tapas</h3>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Patatas Bravas"> 
                            Patatas Bravas - €5.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Gambas al Ajillo"> 
                            Gambas al Ajillo - €8.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Croquetas"> 
                            Croquetas - €6.00
                        </label>
                    </div>
                </div>

                <div id="hoofdgerechten" class="tab-content">
                    <h3>Hoofdgerechten</h3>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Paella"> 
                            Paella - €12.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Pollo a la Plancha"> 
                            Pollo a la Plancha - €10.00
                        </label>
                    </div>
                </div>

                <div id="dranken" class="tab-content">
                    <h3>Dranken</h3>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Sangria"> 
                            Sangria - €4.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Tinto de Verano"> 
                            Tinto de Verano - €3.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Agua"> 
                            Agua - €2.00
                        </label>
                    </div>
                </div>

                <div id="toetjes" class="tab-content">
                    <h3>Toetjes</h3>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Churros"> 
                            Churros - €5.00
                        </label>
                    </div>
                    <div class="menu-item">
                        <label>
                            <input type="checkbox" name="items[]" value="Flan"> 
                            Flan - €4.00
                        </label>
                    </div>
                </div>

                <div class="submit-section">
                    <button type="submit">Plaats Bestelling</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Las Tapas Restaurant</p>
    </footer>
</body>
</html>
