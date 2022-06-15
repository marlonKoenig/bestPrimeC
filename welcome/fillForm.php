<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
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

<body class="<?php echo $site; ?>">
    <header class="main-header">
        <?php include $root . "welcome/welcomeHeader.php" ?>
    </header>

    <article class="" id="top">
        <?php include "fillFormContent.php" ?>
    </article>
    <section id="footer" class="footer">
        <?php include $root . "footer.php" ?>
    </section>
</body>

</html>