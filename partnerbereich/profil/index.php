<?php
session_start();
$root = "../../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | User-Profil";
$keywords = "";
$description = "Dein persönlicher Bereich";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/partnerbereich/profil"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "profil"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<body class="<?php echo $site; ?>">
    <header class="main-header">
        <?php include $root . "topSection.php" ?>
    </header>
    <?php include $root . "nav.php" ?>

    <article class="" id="top">
        <?php include "content.php" ?>
    </article>
    <section id="footer" class="footer" data-array='<?php echo $userData; ?>'>
        <?php include $root . "footer.php" ?>
    </section>
</body>

</html>