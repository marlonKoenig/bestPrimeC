<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
include_once $root . "php/license.php";
$image_path = $root . "media/webseite/";

if (!isset($_GET["refUserId"])) {
    header("Location: " . $GLOBALS["userForwardPages"]["logIn"]);
    die();
}
$partnerData =  json_decode(isUserPartner($_GET["refUserId"]));
if (!$partnerData->isUserPartner) {
    header("Location: " . $GLOBALS["userForwardPages"]["logIn"]);
    die();
}
// die();
// schreibeMonitor();
$availableRegionLicenses = getAvailableLicensesForCountry();
$Titel = "BestPrime | Welcome als Partner";
$keywords = "";
$description = "Dein Eingang in eine finanziell sichere Zukunft";
$lastModified = 'Tue, 02 Nov 2021 20:30 GMT';
$canonical = "/welcome"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "welcome"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<script src="<?php echo $root; ?>js/autoComplete/autocomplete.js"></script>
<link rel="stylesheet" href="<?php echo $root; ?>js/autoComplete/autocomplete.min.css">

<body class="<?php echo $site; ?>">
    <header class="main-header">
        <?php include $root . "welcome/welcomeHeader.php" ?>
    </header>

    <article class="" id="top">
        <?php include "selectCityContent.php" ?>
    </article>
    <section id="footer" class="footer">
        <?php include $root . "footer.php" ?>
    </section>
</body>

</html>

<script>
    var availableRegionLicenses = JSON.parse(`<?php echo $availableRegionLicenses; ?>`);


    /** checkCity
     * wird aufgerufen durch onclick und übergibt die eingegebene Stadt zur Prüfung
     * Für die Prüfung muss noch eine Tabelle implementiert und abdefragt werden!
     * Aktuell wird die Abfrage bewusst umgangen, da die Prüfung erst in der Phase 2 vorgesehen ist
     */
    function checkCity() {
        let inputValue = document.getElementById("targetCity").value.trim();
        console.log("checkCity", inputValue);

        const regionAvailable = availableRegionLicenses.some(function(region) {
            if (region.label == inputValue) {
                console.log(region.zip);
                document
                    .getElementById("targetCity")
                    .dataset.zip = region.zip;
                console.log(region.available_region_licenses)
                return region.available_region_licenses > 0;
            }
            return false;
        })


        if (regionAvailable) {
            // bewusster Fehler um die Funktion auszuhebeln!
            let answer = document.getElementById("inputTableAnswer");
            let loadButton = document.getElementById("loadButton");
            answer.innerHTML = "noch verfügbar &#128522;";
            answer.classList.add("green");
            answer.classList.remove("red");
            answer.classList.remove("none");
            loadButton.classList.remove("none");
            let checkButton = document.getElementById("checkButton");
            checkButton.classList.add("none");
        } else {
            let answer = document.getElementById("inputTableAnswer");
            answer.innerHTML = "bitte gib eine Stadt an &#128577;";
            answer.classList.add("red");
            answer.classList.remove("none");
        }
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        var input = document.getElementById("targetCity");

        autocomplete({
            input: input,
            fetch: function(text, update) {
                text = text.toLowerCase();
                // you can also use AJAX requests instead of preloaded data
                var suggestions = availableRegionLicenses.filter(function(n) {
                    if (n.label.toLowerCase().includes(text)) {
                        return true;
                    }
                    return false;
                })
                update(suggestions);
            },
            onSelect: function(item) {
                input.value = item.label;
                input.dataset.zip = item.zip
            }
        });

    });

    document.getElementById("checkButton").addEventListener("click", checkCity);
</script>