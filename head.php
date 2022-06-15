<?php
$robotHead = "index"; // globale Einstellung: index, follow oder none
if (isset($_SERVER['HTTPS'])) {
    $ssl = 'https://';
} else {
    $ssl = 'http://';
}
$server = $ssl . $_SERVER['SERVER_NAME'] . '/BestPrimeDev';
if ($robots == "off") {
    $robotHead = "none";
}
?>
<!DOCTYPE html>
<html lang="de" xmlns:Last-Modified="http://www.w3.org/1999/xhtml" xmlns:20="http://www.w3.org/1999/xhtml">
<!-- HTML 5 -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="expires" content="0"><!--  Neuladen der Seite erzwingen -->
    <title><?php echo $Titel; ?></title>
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="description" content="<?php echo $description; ?>">
    <meta Last-Modified: <?php echo $lastModified; ?> GMT>
    <meta name="robots" content="<?php echo $robotHead; ?>">
    <meta name="audience" content="">
    <meta name="language" content="deutsch, de">
    <meta name="distribution" content="global">
    <meta name="author" content="Markus König">
    <meta property="og:title" content="<?php echo $Titel; ?>" />
    <meta property="og:description" content="<?php echo $description; ?>" />
    <meta property="og:image" content="<?php echo $server; ?>/media/webseite/images/logo-BestPrime-Social.jpeg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="800" />
    <meta property="og:url" content="<?php echo $server . $canonical; ?>">
    <link rel="canonical" href=<?php echo $server . $canonical; ?> />
    <script src="<?php echo $root; ?>node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
    <!-- <script src="<?php echo $root; ?>js/semantic.min.js.js"></script>
    <link rel="stylesheet" href="<?php echo $root; ?>css/semantic.min.css"> -->
    <link href="<?php echo $root ?>css/system.css" rel="stylesheet" />
    <script src="<?php echo $root ?>js/jquery.js"></script>
    <script src="<?php echo $root ?>js/system.js"></script>
    <link rel="shortcut icon" href="<?php echo $server; ?>/media/webseite/icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $server; ?>/media/webseite/icons/favicon.png">
    <link rel="icon" type="image/png" href="<?php echo $server; ?>/media/webseite/icons/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $server; ?>/media/webseite/icons/apple-touch-icon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $server; ?>/media/webseite/icons/mstile-144x144.png">
</head>