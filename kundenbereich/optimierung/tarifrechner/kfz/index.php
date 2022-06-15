<?php
session_start();
$root = "../../../../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
$customer_path = $root . "kundenbereich/";
checkIfUserLoggedIn(["customer", "administrator"], true);
loadTestCustomer();
// User-Daten für Übergabe im Footer
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "customer_dealerID": "' . $_SESSION['customer_dealerID'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | Optimierung";
$keywords = "";
$description = "Ihr Bereich für eine finanzielle sichere Zukunft";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/kundenbereich/optimierung/kfz"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "kfzRechner"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<body class="<?php echo $site; ?>">
  <header class="main-header">
    <?php include $customer_path . "topSectionCustomer.php" ?>
  </header>
  <?php include $customer_path . "navCustomer.php" ?>

  <article class="" id="top">
    <?php include "content.php" ?>
  </article>
  <section id="footer" class="footer" data-array='<?php echo $userData; ?>'>
    <?php include $customer_path . "footerCustomer.php" ?>
  </section>
</body>

</html>