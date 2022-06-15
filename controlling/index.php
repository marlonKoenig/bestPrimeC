<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
$controller_path = $root . "controlling/";
checkIfUserLoggedIn(["partner", "costumer", "administrator"], true);
// loadTestController();
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "customer_dealerID": "' . $_SESSION['customer_dealerID'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | Backoffice";
$keywords = "";
$description = "Dein Bereich für eine finanzielle sichere Zukunft";
$lastModified = 'Tue, 12 Oct 2021 12:30 GMT';
$canonical = "controlling"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "dashboard"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<body class="<?php echo $site; ?>">
  <header class="main-header">
    <?php include $controller_path . "topSectionController.php" ?>
  </header>
  <?php include $controller_path . "navController.php" ?>
  <article class="" id="top">
    <?php include "content.php" ?>
  </article>
  <section id="footer" class="footer" data-array='<?php echo $userData; ?>'>
    <?php include $root . "footer.php" ?>
  </section>
</body>

</html>