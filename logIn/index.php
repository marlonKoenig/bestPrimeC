<?php
session_start();
$root = "../"; // Pfad zum Wurzelverzeichnis
include_once $root . "php/inc_functions.php";
// checkIfUserLoggedIn([], false, true);
$image_path = $root . "media/webseite/";
$Titel = "BestPrime | Login";
$keywords = "";
$description = "Ihr Bereich für eine finanzielle sichere Zukunft";
$lastModified = 'Tue, 03 Aug 2021 20:30 GMT';
$canonical = "/login"; // Canonical für <head>
$robots = "off"; // Nur für diese Seite! Default ist on, versteckte Seiten erhalten "off"
$site = "logIn"; // Seitenklasse fürs CSS
//Seitenbeginn
include $root . "head.php"; // Head-Bereich einbinden
?>

<script src="<?php echo $root; ?>js/semantic.min.js"></script>
<link rel="stylesheet" href="<?php echo $root; ?>css/semantic.min.css">
<script src="<?php echo $root; ?>node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>

<body class="<?php echo $site; ?>">
    <?php include "content.php" ?>
</body>

</html>