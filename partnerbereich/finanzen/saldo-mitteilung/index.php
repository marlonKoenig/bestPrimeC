<?php
session_start();
$root = "../../../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
checkIfUserLoggedIn(["partner", "administrator"], true);
loadTestUser();
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | Saldo-Mitteilung";
$keywords = "";
$description = "Deine aktuelle Saldo-Mitteilung";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/partnerbereich/finanzen/saldo-mitteilung"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "saldoMitteilung"; // Seitenklasse fürs CSS
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