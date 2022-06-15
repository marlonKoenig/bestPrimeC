<?php
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}
/** Hier werden alle Parameter für die DB hinterlegt
 * Dieses Objekt wird systemweit für Datenbankzugriffe verwendet
 * Tabellen müssen in der Zielanwendung benannt werden
 * @param string $dbName   der Name der Datenbank, auf die zugegriffen werden soll
 */
function DbConNew($dbName)
{
    $host = "alfa3102.alfahosting-server.de";
    $name = $dbName;
    $user = $_SESSION['dbUser'];
    $password = $_SESSION['dbPassword'];

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
