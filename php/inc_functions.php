<?php
checkIfSessionsExists();

/** Initialisierung */
date_default_timezone_set("Europe/Berlin"); // setzt die Zeitzone auf Deutschland
$_SESSION['sessionId'] = session_id();
$_SESSION['emailAdresse'] = 'info@bestPrime.com'; // fürs Impressum etc.

/** Weiche für Hot- oder DEV-Server */
$domain = $_SERVER['HTTP_HOST'];

// DEV-Server
$_SESSION['domain'] = 'https://code2025.de/BestPrimeDev';
$_SESSION['dbUser'] = 'web1200';
$_SESSION['dbPassword'] = 'Mark0815Cod';
$_SESSION["dbData"] = "usr_web1200_1";
$_SESSION['dbName'] = 'usr_web1200_3'; // für Monitoring
$_SESSION['dbTableName'] = 'analyzer_bestPrime'; // für Monitoring


/** Andere Includes einbinden */
include_once "inc_bestPrime.php"; // für kundenspezifische Funktionen
// loadTestUser(); // Nur während der Testphase, um Spieldaten zu haben.
include_once "inc_useful.php";
include_once "inc_branchStatistics.php";

include_once "inc_userAdministration.php";
include_once "billing.php";
include_once "contractOffers.php";
// echo "test";
// increasePartnerAllCustomersNumber(1634658118720);
/** Hier werden alle Parameter für die DB hinterlegt
 * Dieses Objekt wird systemweit für Datenbankzugriffe verwendet
 * Tabellen müssen in der Zielanwendung benannt werden
 * @param string $dbName   der Name der Datenbank, auf die zugegriffen werden soll
 */
function DBCon($dbName)
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
        $message = "Funktion: " . __FUNCTION__ . "\n\nDateiname: " . basename(__FILE__, "") . "\n\nFehlermeldung: \nSQL Error: " . $e->getMessage();
        mailToAdmin($message);
        //echo $message;
    }
}
$data["userId"] = createUserId();



function getNewPartnerId($store)
{
    $db = DBCon($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT id FROM id_increments WHERE id_name=:store;UPDATE id_increments SET id = (id + 1) WHERE id_name = :store;");
    $stmt->bindParam(":store", $store);
    $stmt->execute();
    $dbData = $stmt->fetch();
    return $dbData["id"];
}

/** createUserFolders 
 * Erstellt die notwendigen Ordner für einen neuen User
 * @param int $userId = die übergeben UserId unter der die Ordner erstellt werden
 */
function createUserFolders($userId)
{
    $folderRoot = '../media/users/';
    $directory = $folderRoot . $userId;
    $documents = $directory . '/documents';
    mkdir($directory, 0777, true);
    mkdir($documents, 0777, true);
}

function createUserId()
{
    $userId = str_replace(".", "", microtime(true));
    return str_pad($userId, 13, "0");
}

function checkIfSponsorExists($sponsorId)
{
    $db = DBCon($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT user_id, partner_id FROM partner WHERE user_id = :sponsorId");
    $stmt->bindParam(":sponsorId", $sponsorId);
    $stmt->execute();
    $dbData = $stmt->fetch();
    return $dbData ? $dbData : false;
}



function checkIfSessionsExists()
{
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    }
}

/** clean wird in verschiedenen Funktionen aufgerufen
 * entfernt alle Zeichen die schädlich sein könnten und
 * via POST-Anfrage übermittelt wurden
 * @param string $y der Bezeichner im Array POST
 */
function clean($y)
{
    $x = $_POST["$y"];
    $x = trim($x);
    $search = array("<", ">", "\\");
    $replace = "?";
    $x = str_replace($search, $replace, $x);
    return $x;
}

/** mailToAdmin: Sendet eine E-Mail an die hinterlegten E-Mail-Adressen
 * @param string    $message            E-Mail-Nachricht
 * @param string    $receiver           E-Mail-Empfänger
 * @param string    $headerAddition     Optional / Falls zusätzliche Header eigenschaften benöigt werden
 */
function mailToAdmin($message, $headerAddition = NULL)
{
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= $headerAddition;
    $receiver = "webdesign@koenigs.one";
    $subject = "Admin | " . $_SESSION['domain'];
    mail($receiver, $subject, $message, $headers);
}


function validatePasswordStrength($password)
{
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    }
    return true;
}



// sendContractNotifyToPartner("Gas", 1634496327980, 1634415016290);
// echo "test";
// echo sendPartnerMailForNewCustomer(array("partnerEmail" => "knig.marlon@gmail.com", "partnerFirstName" => "Marlon", "customerLastName" => "König", "customerFirstName" => "Marlon", "customerUserId" => "1233"));
// exit();
// echo date('Y-m-d H:i:s', strtotime('2021-10-20 20:03:10 +7 day'));
// echo json_encode()

// echo date('Y-m-01 00:00:00', strtotime('-6 month', time()));
