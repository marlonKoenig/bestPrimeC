<?php
session_start();
$root = "../../"; // Pfad zum Wurzelverzeichnis
$image_path = $root . "media/webseite/";
include_once $root . "php/inc_functions.php";
checkIfUserLoggedIn(["partner", "administrator"], true);
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | Downloadcenter";
$keywords = "";
$description = "Deine Übersicht über die aktuellen Provisionen";
$lastModified = 'Sun, 07 Nov 2021 15:30 GMT';
$canonical = "/partnerbereich/downloadcenter"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "downloads"; // Seitenklasse fürs CSS
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