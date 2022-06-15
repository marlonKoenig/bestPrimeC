<?php
// Initialisierung der Session.
// Wenn Sie session_name("irgendwas") verwenden, vergessen Sie es
// jetzt nicht!
session_start();

// Löschen aller Session-Variablen.
$_SESSION = array();


// Zum Schluß, löschen der Session.
session_destroy();
// echo "test";
header('Location: https://code2025.de/BestPrimeDev/logIn/');
// or die();
exit();
