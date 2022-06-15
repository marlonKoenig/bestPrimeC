<?php
session_start();
$root ="../../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
// schreibeMonitor();
/** Check, ob diese Seite geöffnet werden darf, wenn nicht ab zur Startseite */
if ($_SESSION['user_authNumber']<=120){
  echo '<meta http-equiv="refresh" content="0; url=' . $root .'">';
  echo 'Aktuelle Stufe: ' . $_SESSION['user_authNumber'];// hjh
}
$Titel = "BestPrime | BPX-Backoffice";
$keywords = "";
$description = "Ihr Bereich für eine finanzielle sichere Zukunft";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/partnerbereich/bpx"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "dashboard"; // Seitenklasse fürs CSS
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
  <section id="footer" class="footer">
    <?php include $root . "footer.php" ?>
  </section>
</body>
<?php
/** Wenn PBX, dann wird hier das Counter-Modul mit Daten versorgt */
  if ($_SESSION['user_authGroup'] == 'BPX'){
    ?>
    
  <?php
  }
?>
</html>
