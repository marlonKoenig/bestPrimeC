<?php
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}

$GLOBALS['domain'] = 'https://code2025.de/BestPrimeDev';
$GLOBALS['api'] = $GLOBALS["domain"] . '/php/api.php';

$GLOBALS["userForwardPages"] = array("logIn" => $GLOBALS["domain"] . "/logIn", "partner" => $GLOBALS['domain'] . "/partnerbereich", "customer" => $GLOBALS['domain'] . "/kundenbereich", "controller" => $GLOBALS['domain'] . "/controlling");
$GLOBALS["gender"] = array("Herr", "Frau", "Herr/Frau");
$GLOBALS["userDatabase"] = "usr_web1200_1";
$GLOBALS['dbUser'] = 'web1200';
$GLOBALS['dbPassword'] = 'Mark0815Cod';
/** Hier werden alle Parameter für die DB hinterlegt
 * Dieses Objekt wird systemweit für Datenbankzugriffe verwendet
 * Tabellen müssen in der Zielanwendung benannt werden
 * @param string $dbName   der Name der Datenbank, auf die zugegriffen werden soll
 */
function DbConNew($dbName = "usr_web1200_1")
{
    $host = "alfa3102.alfahosting-server.de";
    $name = $dbName;
    $user = $GLOBALS['dbUser'];
    $password = $GLOBALS['dbPassword'];
    $dbName = $dbName ? $dbName : "usr_web1200_1";

    try {
        $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"']);
        return $mysql;
    } catch (PDOException $e) {
        // return $e->getMessage();
        // $message = "Funktion: " . __FUNCTION__ . "\n\nDateiname: " . basename(__FILE__, "") . "\n\nFehlermeldung: \nSQL Error: " . $e->getMessage();
        // mailToAdmin($message);
        //echo $message;
    }
}
