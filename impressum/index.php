<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
$Titel = "Impressum | BestPrime";
$keywords = "Impressum";
$description = "Du möchtest wissen, wer ich bin? Na klar, gerne,";
$lastModified = 'Wed, 05 May 2021 20:30 GMT';
$canonical = "/impressum"; // Canonical für <head>
$robots = "on"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "impressum"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<body class="<?php echo $site ?>">
    <?php include "content.php" ?>
    <section class="footer">
        <?php include $root . "footer.php" ?>
    </section>
</body>

</html>