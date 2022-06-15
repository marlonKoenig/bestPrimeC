<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
$image_path = $root . "media/webseite/";
checkIfUserLoggedIn(["partner", "administrator"], true);
$userData = '{"user_ID": "' . $_SESSION['user_id'] . '", "role": "' . $_SESSION['user_role'] . '"}';
$Titel = "BestPrime | Partnerbereich-Backoffice";
$keywords = "";
$description = "Ihr Bereich für eine finanzielle sichere Zukunft";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/partnerbereich"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "dashboard"; // Seitenklasse fürs CSS

$showRankUp = $_SESSION['user_rank_up_notification'];
$_SESSION['user_rank_up_notification'] = 0;





//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>
<script src="<?php echo $root; ?>node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>

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
<script>
  /** sweet-alert /////auf startseite Partnert
   *
   */
  if (<?php echo $showRankUp; ?>) {
    Swal.fire({
      html: `<video controls draggable="true" src="https://code2025.de/BestPrimeDev/media/webseite/videos/werbevideo.mp4" type="video/mp4" style="
    object-fit: cover;
    max-width: 100%;
    max-height: 100%;
">
</video>`,
      confirmButtonText: 'Zertifikat herunterladen',
    }).then(res => {
      $.post(api, {
        funktion: "resetRankUpPopUp",
        userId: <?php echo $_SESSION["user_id"]; ?>
      }, function(res) {
        console.log(res);
      });
      if (res.isConfirmed) {
        window.open('https://code2025.de/BestPrimeDev/media/webseite/documents/AGB.pdf', '_blank').focus();
      }
      // $.post(api, {
      //   funktion: "resetRankUpPopUp",
      //   userId: <?php //echo $_SESSION['user_id'];
                    //           
                    ?>
      // })
    });
  }
</script>

</html>