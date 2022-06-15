<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
// schreibeMonitor();
/** Check, ob diese Seite geöffnet werden darf, wenn nicht ab zur Loginseite */

if (!isset($_GET["refUserId"])) {
    header("Location: " . $GLOBALS["userForwardPages"]["logIn"]);
    die();
}
$partnerData =  json_decode(isUserPartner($_GET["refUserId"]));
if (!$partnerData->isUserPartner) {
    header("Location: " . $GLOBALS["userForwardPages"]["logIn"]);
    die();
}


$Titel = "BestPrime | Registrierung";
$keywords = "";
$description = "Dein Eingang in eine finanziell sichere Zukunft";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/welcome"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "welcome"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>
<script src="<?php echo $root; ?>js/semantic.min.js"></script>
<link rel="stylesheet" href="<?php echo $root; ?>css/semantic.min.css">
<script src="<?php echo $root; ?>node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>

<body class="<?php echo $site; ?>">
    <header class="main-header">
        <?php include $root . "welcomeCustomer/welcomeHeader.php" ?>
    </header>

    <div class="ui text container">
        <?php include "content.php" ?>
    </div>
    <section id="footer" class="footer">
        <?php include $root . "footer.php" ?>
    </section>
</body>

</html>